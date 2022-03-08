<?php
class Items_Delete extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = mongodb();
    }

    public function submit($item)
    {
        if (isset($_POST['submit'])) {
            rmdirFull('resources/items/' . $item->_id);
            $this->db->data_items->deleteOne(['_id' => $item->_id]);

            $this->load->model('Items_Funcs');
            $this->Items_Funcs->refresh();

            if (isset($_GET['backUrl'])) {
                redirect(base64_decode($_GET['backUrl']));
            } else {
                redirect('/items');
            }
        }
    }
}
