<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Npcs extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->db = mongodb();
		$this->auth = authentication();
	}

	public function edit($id = '')
	{
		$this->load->model('Npcs_Edit');

		$data = [];
		$data['body'] = $this->Npcs_Edit->submit($id);
		$data['item'] = $this->db->data_npcs->findOne(['_id' => $id]);
		if ($data['item'] == null) {
			redirect('/npcs');
		}
		$data['body'] .= $this->load->view('npcs/edit', $data, true);
		$this->load->view('main', $data);
	}

	public function index()
	{
		$this->load->model('Npcs_Funcs');

		$data = [];
		$data['items'] = $this->Npcs_Funcs->search();
		$data['body'] = $this->load->view('npcs/index', $data, true);
		$this->load->view('main', $data);
	}

	public function create()
	{
		$this->load->model('Npcs_Create');

		$data = [];
		$data['body'] = $this->Npcs_Create->submit();
		$data['body'] .= $this->load->view('npcs/create', $data, true);
		$this->load->view('main', $data);
	}

	public function delete($id = '')
	{
		$this->load->model('Npcs_Delete');

		$data = [];
		$data['body'] = $this->Npcs_Delete->submit($id);
		$data['item'] = $this->db->data_npcs->findOne(['_id' => $id]);
		if ($data['item'] == null) {
			redirect('/npcs');
		}
		$data['backUrl'] = '/npcs';
		$data['body'] .= $this->load->view('utils/delete', $data, true);
		$this->load->view('main', $data);
	}
}
