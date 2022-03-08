<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Maps extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db = mongodb();
		$this->auth = authentication();
	}

	public function edit($id = '')
	{
		$this->load->model('Maps_Edit');

		$data = [];
		$data['db'] = $this->db;
		$data['body'] = $this->Maps_Edit->submit($id);
		$data['item'] = $this->db->data_maps->findOne(['_id' => $id]);
		if ($data['item'] == null) {
			redirect('/maps');
		}
		$data['body'] .= $this->load->view('maps/edit', $data, true);
		$this->load->view('main', $data);
	}

	public function index()
	{
		$this->load->model('Maps_Funcs');

		$data = [];
		$data['tag'] = getItemTags()[0];
		if (isset($_GET['tag'])) {
			$data['tag'] = $this->input->get('tag', true);
		}
		$data['items'] = $this->Maps_Funcs->search();
		$data['body'] = $this->load->view('maps/index', $data, true);
		$this->load->view('main', $data);
	}

	public function create()
	{
		$this->load->model('Maps_Create');

		$data = [];
		$data['tag'] = getItemTags()[0];
		if (isset($_GET['tag'])) {
			$data['tag'] = $this->input->get('tag', true);
		}
		$data['body'] = $this->Maps_Create->submit();
		$data['body'] .= $this->load->view('maps/create', $data, true);
		$this->load->view('main', $data);
	}

	public function delete($id = '')
	{
		$this->load->model('Maps_Delete');

		$data = [];
		$data['item'] = $this->db->data_maps->findOne(['_id' => $id]);
		if ($data['item'] == null) {
			redirect('/maps');
		}
		$this->Maps_Delete->submit($data['item']);

		$data['backUrl'] = '/items';
		$data['body'] = $this->load->view('utils/delete', $data, true);
		$this->load->view('main', $data);
	}
}
