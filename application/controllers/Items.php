<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Items extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db = mongodb();
		$this->auth = authentication();
	}

	public function edit($id = '')
	{
		$this->load->model('Items_Edit');

		$data = [];
		$data['db'] = $this->db;
		$data['tag'] = getItemTags()[0];
		if (isset($_GET['tag'])) {
			$data['tag'] = $this->input->get('tag', true);
		}
		$data['body'] = $this->Items_Edit->submit($id);
		$data['resources'] = $this->db->data_items->find(['tag' => 'resource'], ['sort' => ['name' => 1]])->toArray();
		$data['item'] = $this->db->data_items->findOne(['_id' => $id]);
		if ($data['item'] == null) {
			redirect('/items');
		}
		$data['body'] .= $this->load->view('items/edit', $data, true);
		$this->load->view('main', $data);
	}

	public function index()
	{
		$this->load->model('Items_Funcs');

		$data = [];
		$data['tag'] = getItemTags()[0];
		if (isset($_GET['tag'])) {
			$data['tag'] = $this->input->get('tag', true);
		}
		$data['items'] = $this->Items_Funcs->search();
		$data['body'] = $this->load->view('items/index', $data, true);
		$this->load->view('main', $data);
	}

	public function create()
	{
		$this->load->model('Items_Create');

		$data = [];
		$data['tag'] = getItemTags()[0];
		if (isset($_GET['tag'])) {
			$data['tag'] = $this->input->get('tag', true);
		}
		$data['body'] = $this->Items_Create->submit();
		$data['body'] .= $this->load->view('items/create', $data, true);
		$this->load->view('main', $data);
	}

	public function delete($id = '')
	{
		$this->load->model('Items_Delete');

		$data = [];
		$data['item'] = $this->db->data_items->findOne(['_id' => $id]);
		if ($data['item'] == null) {
			redirect('/items');
		}
		$this->Items_Delete->submit($data['item']);

		$data['backUrl'] = '/items';
		$data['body'] = $this->load->view('utils/delete', $data, true);
		$this->load->view('main', $data);
	}

	public function clean()
	{
		$this->load->model('Items_Clean');
		$this->Items_Clean->submit();
	}
}
