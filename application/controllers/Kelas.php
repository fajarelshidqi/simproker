<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_kelas');
		$this->load->library('mypdf');
	}

	public function index()
	{
		$data['kelas'] = $this->m_kelas->get_kelas()->result();
		$this->load->view('honor/v_kelas', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|trim|is_unique[tb_kelas.nama_kelas]', [
			'required' => 'Anda belum mengisi data kelas!',
			'is_unique'=> 'Maaf, Kelas yang anda Inputkan sudah ada!'
		]);

		$kelas		= htmlspecialchars($this->input->post('kelas', TRUE));

		if ($this->form_validation->run() != false) {
			
			$data = array('nama_kelas' 	=> $kelas);

			$this->m_crud->insert_data($data, 'tb_kelas');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Kelas berhasil ditambahkan</div>');
			redirect(base_url('kelas'));
			
		} else {
			
			$this->load->view('honor/v_kelas_add');
		}
	}

	public function edit($id)
	{
		$data['kelas'] = $this->m_kelas->get_kelasId($id)->result();
		$this->load->view('honor/v_kelas_edit', $data);
	}

	public function update()
	{
		$this->form_validation->set_rules('id', 'id', 'required|trim', [
			'required' => 'Anda belum mengisi data kelas!'
		]);
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|trim|is_unique[tb_kelas.nama_kelas]', [
			'required' => 'Anda belum mengisi data kelas!',
			'is_unique'=> 'Maaf, Kelas yang anda Inputkan sudah ada!'
		]);

		$id		= htmlspecialchars($this->input->post('id', TRUE));
		$kelas	= htmlspecialchars($this->input->post('kelas', TRUE));
		
		$where 	= array('id_kelas'		=> $id);
		$data 	= array('nama_kelas' 	=> $kelas);

		$this->m_crud->update_data($where, $data,'tb_kelas');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Kelas berhasil di Update</div>');
		redirect(base_url('kelas'));
	}

	public function hapus($id)
	{
		$where = array('id_kelas'=>$id);
		
		$this->m_crud->delete_data($where,'tb_kelas');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dana Kelas berhasil di hapus</div>');
		redirect(base_url('kelas'));
	}
}