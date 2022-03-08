<?php
class Items_Create extends CI_Model
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
        $specs = isset($_POST['specs']) ? $_POST['specs'] : [];
        $enabled = input('enabled');

        $config['upload_path'] = 'resources/tmp';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // upload icon
        if ($this->upload->do_upload('file-icon') == false) {
            return $this->upload->display_errors('<div class="alert alert-warning">', '</div>');
        }
        $fileIcon = $this->upload->data();
        if ($this->upload->do_upload('file-icon-meta') == false) {
            return $this->upload->display_errors('<div class="alert alert-warning">', '</div>');
        }
        $fileIconMeta = $this->upload->data();

        // upload sprite
        if (isset($_POST['file-sprite'])) {
            if ($this->upload->do_upload('file-sprite') == false) {
                return $this->upload->display_errors('<div class="alert alert-warning">', '</div>');
            }
            $fileSprite = $this->upload->data();

            if ($this->upload->do_upload('file-sprite-meta') == false) {
                return $this->upload->display_errors('<div class="alert alert-warning">', '</div>');
            }
            $fileSpriteMeta = $this->upload->data();
        }

        $id = uuid();
        $path = 'resources/items/' . $id;

        mkdir($path);
        chmod($path, 0777);

        $this->db->data_items->insertOne([
            '_id' => $id,
            'tag' => $tag,
            'name' => $name == null ? 'No name' : $name,
            'type' => $type,
            'specs' => $specs,
            'enabled' => $enabled == 'yes' ? true : false,
            'createdAt' => time(),
            'updatedAt' => time()
        ]);

        copy('resources/tmp/' . $fileIcon['file_name'], $path . '/icon.png');
        copy('resources/tmp/' . $fileIconMeta['file_name'], $path . '/icon.png.meta');

        unlink('resources/tmp/' . $fileIcon['file_name']);
        unlink('resources/tmp/' . $fileIconMeta['file_name']);


        if (isset($fileSprite)) {
            copy('resources/tmp/' . $fileSprite['file_name'], $path . '/sprite.png');
            copy('resources/tmp/' . $fileSpriteMeta['file_name'], $path . '/sprite.png.meta');

            unlink('resources/tmp/' . $fileSprite['file_name']);
            unlink('resources/tmp/' . $fileSpriteMeta['file_name']);
        }

        $this->load->model('Items_Funcs');
        $this->Items_Funcs->refresh();

        return '<div class="alert alert-success">Success</div>';
    }
}
