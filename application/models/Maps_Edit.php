<?php
class Maps_Edit extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = mongodb();
    }

    public function submit($id = '')
    {
        if (isset($_POST['submit']) == false) return;

        $name = input('name');
        $npcs = input('npcs');
        $trees = input('trees');
        $points = input('points');
        $monsters = input('monsters');

        $this->db->data_maps->updateOne(['_id' => $id,], [
            '$set' => [
                'name' => $name == null ? 'No name' : $name,
                'npcs' => $npcs,
                'trees' => $trees,
                'points' => $points,
                'monsters' => $monsters,
                'updatedAt' => time()
            ]
        ]);

        redirect('/maps');
    }
}
