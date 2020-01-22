<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
	}

	public function index()
	{
		$data['user'] = $this->m_crud->get_data('tb_user')->result();
		$this->load->view('v_user', $data);
	}
}
