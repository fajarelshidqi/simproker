<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ta extends CI_Controller
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
		$data['ta'] = $this->m_crud->get_data('tb_ta')->result();
		$this->load->view('proker/v_ta', $data);
	}

	public function add() 
	{
		$this->form_validation->set_rules('ta', 'Ta', 'required|trim|is_unique[tb_ta.tahun_ajaran]', [
			'required' => 'Field Tahun Ajaran tidak boleh kosong!',
			'is_unique' => 'Data tersebut sudah ada!'
		]);

		$ta = htmlspecialchars($this->input->post('ta', TRUE));

		if ($this->form_validation->run() != false) {
			
			$data = array('tahun_ajaran' => $ta);

			$this->m_crud->insert_data($data, 'tb_ta');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !,<br></b> Data Tahun Ajaran berhasil ditambahkan</div>');
			redirect(base_url('ta'));
			
		} else {
			$this->load->view('proker/v_ta_add');
		}
	}

	public function edit($id)
	{
		$where	= array('id_ta'=>$id);
		
		$data['ta']=$this->m_crud->edit_data($where,'tb_ta')->result();
		$this->load->view('proker/v_ta_edit',$data);
	}

	public function update()
	{
		$id 	= htmlspecialchars($this->input->post('id_ta', TRUE));
		$ta 	= htmlspecialchars($this->input->post('ta', TRUE));
		$where 	= array('id_ta'=>$id);
		$data 	= array('tahun_ajaran'=>$ta);
		
		$this->m_crud->update_data($where,$data,'tb_ta');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !,<br></b> Data Tahun Ajaran berhasil di update</div>');
		redirect(base_url('ta'));
	}

	public function hapus($id) 
	{
		$where = array('id_ta'=>$id);
		
		$this->m_crud->delete_data($where,'tb_ta');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !,<br></b> Data Tahun Ajaran berhasil di hapus</div>');
		redirect(base_url('ta'));
	}
}