<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_proker');
		$this->load->model('m_proposal');
		$this->load->model('m_dana_cair');
		$this->load->model('m_matakuliah');
		$this->load->model('m_dosendalam');
		$this->load->model('m_dosenluar');
	}

	public function index()
	{
		$data['proker'] = $this->m_proker->get_proker('tb_proker')->num_rows();
		$data['proposal'] = $this->m_proposal->get_proposal('tb_proposal')->num_rows();
		$data['danaCair'] = $this->m_dana_cair->get_danaCair('tb_dana_cair')->num_rows();
		$data['mk'] = $this->m_matakuliah->get_mk('tb_matakuliah')->num_rows();
		$data['dd'] = $this->m_dosendalam->get_dosenDalam('tb_dosendalam')->num_rows();
		$data['dl'] = $this->m_dosenluar->get_dosenLuar('tb_dosenluar')->num_rows();

		// echo "<pre>"; print_r($proker);die;
		$this->load->view('v_home', $data);
	}
}
