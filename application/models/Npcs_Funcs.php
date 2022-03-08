<?php
class Npcs_Funcs extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = mongodb();
    }

    public function search($options = [])
    {
        if (isset($options['limit']) == false) {
            $options['limit'] = 999;
        }
        $query = $this->db->data_npcs->find([], [
            'limit' => $options['limit'],
            'sort'  => [
                'createdAt' => -1
            ],
        ])->toArray();
        return $query;
    }

    public function refresh()
    {
        $items = $this->db->data_npcs->find([], [
            'sort'  => [
                'createdAt' => -1
            ],
        ])->toArray();
        $ids = [];

        foreach ($items as $item) {
            $ids[] = $item['_id'];
        }

        // write to file
        file_put_contents('resources/npcs/ids.json', json_encode(['ids' => $ids]));
    }
}
