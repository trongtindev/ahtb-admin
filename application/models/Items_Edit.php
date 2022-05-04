<?php
class Items_Edit extends CI_Model
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
        $weight = input('weight');
        $setId = input('setId');
        $tier = input('tier');
        $level = input('level');
        $category = input('category');
        $specs = isset($_POST['specs']) ? $_POST['specs'] : [];
        $enabled = input('enabled');
        $crafting = isset($_POST['crafting']) ? $_POST['crafting'] : [];

        $config['upload_path'] = 'resources/tmp';
        $config['allowed_types'] = '*';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        // upload icon
        if (isset($_FILES['file-icon']) && $_FILES['file-icon']['name'] != '') {
            if ($this->upload->do_upload('file-icon') == false) {
                return $this->upload->display_errors('<div class="alert alert-warning">1', '</div>');
            }
            $fileIcon = $this->upload->data();
        }

        if (isset($_FILES['file-icon-meta']) && $_FILES['file-icon-meta']['name'] != '') {
            if ($this->upload->do_upload('file-icon-meta') == false) {
                return $this->upload->display_errors('<div class="alert alert-warning">2', '</div>');
            }
            $fileIconMeta = $this->upload->data();
        }

        if (isset($_FILES['file-sprite']) && $_FILES['file-sprite']['name'] != '') {
            if ($this->upload->do_upload('file-sprite') == false) {
                return $this->upload->display_errors('<div class="alert alert-warning">3', '</div>');
            }
            $fileSprite = $this->upload->data();
        }

        if (isset($_FILES['file-sprite-meta']) && $_FILES['file-sprite-meta']['name'] != '') {
            if ($this->upload->do_upload('file-sprite-meta') == false) {
                return $this->upload->display_errors('<div class="alert alert-warning">4', '</div>');
            }
            $fileSpriteMeta = $this->upload->data();
        }

        $this->db->data_items->updateOne([
            '_id' => $id,
        ], [
            '$set' => [

                'tag' => $tag,
                'name' => $name == null ? 'No name' : $name,
                'type' => $type,
                'specs' => $specs,
                'setId' => $setId,
                'weight' => $weight,
                'tier' => $tier,
                'level' => $level,
                'enabled' => $enabled == 'yes' ? true : false,
                'updatedAt' => time(),
                'crafting' => $crafting,
                'category' => $category
            ]
        ]);

        $path = 'resources/items/' . $id;
        if (isset($fileIcon)) {
            unlink($path . '/icon.png');
            copy('resources/tmp/' . $fileIcon['file_name'], $path . '/icon.png');
            unlink('resources/tmp/' . $fileIcon['file_name']);
        }

        if (isset($fileSprite)) {
            unlink($path . '/sprite.png');
            copy('resources/tmp/' . $fileSprite['file_name'], $path . '/sprite.png');
            unlink('resources/tmp/' . $fileSprite['file_name']);
        }

        if (isset($fileIconMeta)) {
            unlink($path . '/icon.png.meta');
            copy('resources/tmp/' . $fileIconMeta['file_name'], $path . '/icon.png.meta');
            unlink('resources/tmp/' . $fileIconMeta['file_name']);
        }

        if (isset($fileSpriteMeta)) {
            unlink($path . '/sprite.png.meta');
            copy('resources/tmp/' . $fileSpriteMeta['file_name'], $path . '/sprite.png.meta');
            unlink('resources/tmp/' . $fileSpriteMeta['file_name']);
        }

        $this->load->model('Items_Funcs');
        $this->Items_Funcs->refresh();

        if (isset($_GET['backUrl'])) {
            redirect(base64_decode($_GET['backUrl']));
        } else {
            redirect('/items');
        }
    }
}
