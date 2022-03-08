<?php
class Items_Funcs extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = mongodb();
    }

    public function search($options = [])
    {
        $filter = [];
        if (isset($_GET['keyword'])) {
            $filter['name'] = [
                '$regex' => $this->input->get('keyword', true)
            ];
        }
        
        if (isset($_GET['tag']) && $this->input->get('tag', true) != '') {
            $filter['tag'] = $this->input->get('tag', true);
        }
        if (isset($_GET['type']) && $this->input->get('type', true) != '') {
            $filter['type'] = $this->input->get('type', true);
        }
        if (isset($_GET['enabled']) && $_GET['enabled'] != '') {
            $filter['enabled'] = $this->input->get('enabled', true) == '1';
        }

        $query = $this->db->data_items->find($filter, [
            'limit' => 100,
            'sort'  => [
                'updatedAt' => -1
            ],
        ])->toArray();
        return $query;
    }

    public function refresh()
    {
        $items = $this->db->data_items->find([], [
            'sort'  => [
                'createdAt' => -1
            ],
        ])->toArray();
        $ids = [];

        foreach ($items as $item) {
            $ids[] = $item['_id'];
        }

        // write to file
        file_put_contents('resources/items/ids.json', json_encode(['ids' => $ids]));
    }
}
