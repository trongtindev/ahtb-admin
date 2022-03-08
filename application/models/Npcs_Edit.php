<?php
class Npcs_Edit extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = mongodb();
    }

    public function submit($id = '')
    {
        if (isset($_POST['submit']) == false) return;

        $tag = input('tag');
        $name = input('name');
        $type = input('type');
        $enabled = input('enabled');

        $config['upload_path'] = 'resources/tmp';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // upload sprite
        if (isset($_POST['file-sprite'])) {
            if ($this->upload->do_upload('file-sprite') == false) {
                return $this->upload->display_errors('<div class="alert alert-warning">', '</div>');
            }
            $fileSprite = $this->upload->data();
        }

        if (isset($_POST['file-sprite-meta'])) {
            if ($this->upload->do_upload('file-sprite-meta') == false) {
                return $this->upload->display_errors('<div class="alert alert-warning">', '</div>');
            }
            $fileSpriteMeta = $this->upload->data();
        }

        $path = 'resources/npcs/' . $id;
        $this->db->data_npcs->updateOne(['_id' => $id,], [
            '$set' => [

                'tag' => $tag,
                'name' => $name == null ? 'No name' : $name,
                'type' => $type,
                'enabled' => $enabled == 'yes' ? true : false,
                'updatedAt' => time()
            ]
        ]);

        if (isset($fileSprite)) {
            if (file_exists($path . '/sprite.png')) {
                unlink($path . '/sprite.png');
            }
            copy('resources/tmp/' . $fileSprite['file_name'], $path . '/sprite.png');
            unlink('resources/tmp/' . $fileSprite['file_name']);
        }

        if (isset($fileSpriteMeta)) {
            if (file_exists($path . '/sprite.png.meta')) {
                unlink($path . '/sprite.png.meta');
            }
            copy('resources/tmp/' . $fileSpriteMeta['file_name'], $path . '/sprite.png.meta');
            unlink('resources/tmp/' . $fileSpriteMeta['file_name']);
        }

        $this->load->model('Npcs_Funcs');
        $this->Npcs_Funcs->refresh();

        redirect('/npcs');
    }
}
