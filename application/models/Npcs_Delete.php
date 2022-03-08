<?php
class Npcs_Delete extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = mongodb();
    }

    public function submit($options = [])
    { }
}
