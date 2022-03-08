<?php
class Items_Clean extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = mongodb();
    }

    public function submit()
    {
        $ids = [];
        $query = $this->db->data_items->find([], [
            'limit' => 10000,
            'sort'  => [
                'updatedAt' => -1
            ],
        ])->toArray();

        foreach ($query as $item) {
            $ids[] = $item['_id'];
        }

        foreach (scandir('resources/items') as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            // if file
            if (is_file('resources/items/' . $file) && strpos($file, '.meta') !== false) {
                unlink('resources/items/' . $file);
            }

            // if not in ids
            if (in_array($file, $ids) == false) {
                // rmdirFull('resources/items/' . $file);
                echo $file . '</br>';
            }
        }

        $this->load->model('Items_Funcs');
        $this->Items_Funcs->refresh();
    }
}
