<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_luar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_dosenluar');
		$this->load->model('m_matakuliah');
		$this->load->library('mypdf');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	public function index()
	{
		$data['dosenluar'] = $this->m_dosenluar->get_dosenLuar()->result();
		$this->load->view('honor/v_dosenluar.php', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('dosen', 'Dosen Dalam', 'required|trim|is_unique[tb_dosenluar.nama_dosenluar]', [
			'required' => 'Silahkan masukan Kode Mata Kuliah!',
			'is_unique'=> 'Maaf, Nama Dosen yang anda Inputkan sudah ada!'
		]);
		$this->form_validation->set_rules('honor_dosen', 'Honor Mengajar', 'required|trim', [
			'required' => 'Anda belum mengisi data Honor Mengajar!'
		]);
		$this->form_validation->set_rules('transport', 'Transport', 'required|trim', [
			'required' => 'Anda belum mengisi data Transport!'
		]);

		if ($this->form_validation->run() != false) {
			
			$data = array(
				'nama_dosenluar'	=> htmlspecialchars($this->input->post('dosen', TRUE)),
				'honor_dosenluar'	=> htmlspecialchars($this->input->post('honor_dosen', TRUE)),
				'transport'			=> htmlspecialchars($this->input->post('transport', TRUE))
			);

			$this->m_crud->insert_data($data, 'tb_dosenluar');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dosen Luar berhasil ditambahkan</div>');
			redirect(base_url('dosen_luar'));
			
		} else {
			$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
			$this->load->view('honor/v_dosenluar_add', $data);
		}
	}

	public function edit($id)
	{
		$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
		$data['dosenluar'] = $this->m_dosenluar->get_dosenLuarEdit($id)->result();
		$this->load->view('honor/v_dosenluar_edit',$data);
	}

	public function update()
	{
		
		$where = array('id_dosenluar' => htmlspecialchars($this->input->post('id_dosen', TRUE)));

		$data = array(
			'nama_dosenluar'	=> htmlspecialchars($this->input->post('dosen', TRUE)),
			'honor_dosenluar'	=> htmlspecialchars($this->input->post('honor_dosen', TRUE)),
			'transport'			=> htmlspecialchars($this->input->post('transport', TRUE))
		);

		$this->m_crud->update_data($where, $data, 'tb_dosenluar');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dosen Luar berhasil di Update</div>');
		redirect(base_url('dosen_luar'));
	}

	public function hapus($id)
	{
		$where = array('id_dosenluar'=>$id);
		
		$this->m_crud->delete_data($where,'tb_dosenluar');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dosen Luar berhasil di hapus</div>');
		redirect(base_url('dosen_luar'));
	}
}