<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Objects extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db = mongodb();
		$this->auth = authentication();
	}

	public function edit($id = '')
	{
		$this->load->model('Objects_Edit');

		$data = [];
		$data['db'] = $this->db;
		$data['body'] = $this->Objects_Edit->submit($id);
		$data['item'] = $this->db->data_objects->findOne(['_id' => $id]);
		if ($data['item'] == null) {
			redirect('/objects');
		}
		$data['body'] .= $this->load->view('objects/edit', $data, true);
		$this->load->view('main', $data);
	}

	public function index()
	{
		$this->load->model('Objects_Funcs');

		$data = [];
		$data['tag'] = getItemTags()[0];
		if (isset($_GET['tag'])) {
			$data['tag'] = $this->input->get('tag', true);
		}
		$data['items'] = $this->Objects_Funcs->search();
		$data['body'] = $this->load->view('objects/index', $data, true);
		$this->load->view('main', $data);
	}

	public function create()
	{
		$this->load->model('Objects_Create');

		$data = [];
		$data['tag'] = getItemTags()[0];
		if (isset($_GET['tag'])) {
			$data['tag'] = $this->input->get('tag', true);
		}
		$data['body'] = $this->Objects_Create->submit();
		$data['body'] .= $this->load->view('objects/create', $data, true);
		$this->load->view('main', $data);
	}

	public function delete($id = '')
	{
		$this->load->model('Objects_Delete');

		$data = [];
		$data['item'] = $this->db->data_objects->findOne(['_id' => $id]);
		if ($data['item'] == null) {
			redirect('/objects');
		}
		$this->Objects_Delete->submit($data['item']);

		$data['backUrl'] = '/items';
		$data['body'] = $this->load->view('utils/delete', $data, true);
		$this->load->view('main', $data);
	}
}
