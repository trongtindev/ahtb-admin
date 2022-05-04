<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sandbox extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db = mongodb();
		$this->auth = authentication();
	}

	public function index()
	{
		$output = [
			'npcs' => $this->db->data_npcs->find()->toArray(),
			'trees' => $this->db->data_trees->find()->toArray(),
			'stones' => $this->db->data_stones->find()->toArray(),
			'monsters' => $this->db->data_monsters->find()->toArray(),
		];
		echo json_encode($output);
	}

	public function refresh()
	{
		$output = [];
		$this->db->data_settings->updateOne([
			'key' => 'system.refresh'
		], [
			'$set' => [
				'data' => true
			]
		]);
		echo json_encode($output);
	}

	public function create()
	{
		$id = input('id');
		$map = input('map');
		$type = input('type');
		$position = input('position');

		$output = [
			'id' => $id,
			'type' => $type,
			'status' => false,
			'position' => $position,
		];

		if ($id != null && $map != null && $type != null && $position != null) {
			$position = explode(',', $position);
			$item = ['id' => $id, 'position' => [
				(float) $position[0],
				(float) $position[1],
			]];

			if ($type == 'npcs') {
				$output['status'] = true;
				$this->db->data_maps->updateOne(['_id' => $map], ['$push' => ['npcs' => $item]]);
			} else if ($type == 'tree') {
				$output['status'] = true;
				$this->db->data_maps->updateOne(['_id' => $map], ['$push' => ['trees' => $item]]);
			} else if ($type == 'stone') {
				$output['status'] = true;
				$this->db->data_maps->updateOne(['_id' => $map], ['$push' => ['stones' => $item]]);
			} else if ($type == 'monster') {
				$output['status'] = true;
				$this->db->data_maps->updateOne(['_id' => $map], ['$push' => ['monsters' => $item]]);
			}
		}

		echo json_encode($output);
	}

	public function delete()
	{
		$map = input('map');
		$type = input('type');
		$position = input('position');

		$output = [
			'type' => $type,
			'status' => false,
			'position' => $position,
		];

		if ($position != null) {
			$position = explode(',', $position);
			$map = $this->db->data_maps->findOne(['_id' => $map]);

			if ($type == 'npcs') {
				$npcs = [];
				foreach ($map->npcs as $npc) {
					if ($npc->position[0] != $position[0] && $npc->position[1] != $position[1]) {
						$npcs[] = $npc;
					}
				}
				$output['status'] = true;
				$this->db->data_maps->updateOne(['_id' => $map->_id], ['$set' => ['npcs' => $npcs]]);
			} else if ($type == 'tree') {
				$trees = [];
				foreach ($map->trees as $tree) {
					if ($tree->position[0] != $position[0] && $tree->position[1] != $position[1]) {
						$trees[] = $tree;
					}
				}
				$output['status'] = true;
				$this->db->data_maps->updateOne(['_id' => $map->_id], ['$set' => ['trees' => $trees]]);
			} else if ($type == 'stone') {
				$stones = [];
				foreach ($map->stones as $stone) {
					if ($tree->position[0] != $position[0] && $stone->position[1] != $position[1]) {
						$stones[] = $stone;
					}
				}
				$output['status'] = true;
				$this->db->data_maps->updateOne(['_id' => $map->_id], ['$set' => ['stones' => $stones]]);
			} else if ($type == 'monster') {
				$monsters = [];
				foreach ($map->monsters as $monster) {
					if ($monster->position[0] != $position[0] && $monster->position[1] != $position[1]) {
						$monsters[] = $monster;
					}
				}
				$output['status'] = true;
				$this->db->data_maps->updateOne(['_id' => $map->_id], ['$set' => ['monsters' => $monsters]]);
			}
		}

		echo json_encode($output);
	}
}
