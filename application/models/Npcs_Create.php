<?php
class Npcs_Create extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = mongodb();
    }

    public function submit()
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
        if ($this->upload->do_upload('file-sprite') == false) {
            return $this->upload->display_errors('<div class="alert alert-warning">', '</div>');
        }
        $fileSprite = $this->upload->data();

        if ($this->upload->do_upload('file-sprite-meta') == false) {
            return $this->upload->display_errors('<div class="alert alert-warning">', '</div>');
        }
        $fileSpriteMeta = $this->upload->data();

        // check same file
        if ($fileSprite['file_size'] == $fileSpriteMeta['file_size']) {
            return '<div class="alert alert-warning">File same</div>';
        }

        $id = uuid();
        $path = 'resources/npcs/' . $id;

        mkdir($path);
        chmod($path, 0777);

        $this->db->data_npcs->insertOne([
            '_id' => $id,
            'tag' => $tag,
            'name' => $name == null ? 'No name' : $name,
            'type' => $type,
            'enabled' => $enabled == 'yes' ? true : false,
            'createdAt' => time(),
            'updatedAt' => time()
        ]);

        copy('resources/tmp/' . $fileSprite['file_name'], $path . '/sprite.png');
        copy('resources/tmp/' . $fileSpriteMeta['file_name'], $path . '/sprite.png.meta');

        unlink('resources/tmp/' . $fileSprite['file_name']);
        unlink('resources/tmp/' . $fileSpriteMeta['file_name']);

        $this->load->model('Npcs_Funcs');
        $this->Npcs_Funcs->refresh();

        return '<div class="alert alert-success">Success</div>';
    }
}
