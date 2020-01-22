<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koord extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_koord');
		$this->load->model('m_matakuliah');
		$this->load->model('m_dosendalam');
		$this->load->model('m_kelas');
		$this->load->library('mypdf2');
	}

	public function index()
	{
		if (isset($_GET['bulan1']) || isset($_GET['bulan2']) || isset($_GET['kelas'])) {
			$bulan1 = $this->input->get('bulan1');
			$bulan2	= $this->input->get('bulan2');
			$kelas	= $this->input->get('kelas');
			$data['title'] = 'Export filter to PDF';
			$data['koord'] = $this->m_koord->get_filterKoord($bulan1, $bulan2, $kelas)->result();
			$data['kelas'] = $this->m_kelas->get_kelas()->result();
			$this->load->view('koord/v_koord', $data);
		} else {
			$data['koord'] = $this->m_koord->get_koord()->result();
			$data['kelas'] = $this->m_kelas->get_kelas()->result();
			$this->load->view('koord/v_koord', $data);
		}
		
	}

	public function add()
	{
		$this->form_validation->set_rules('bulan1', 'Bulan Mengajar', 'required|trim', [
			'required' => 'Anda belum mengisi data Bulan Mengajar!'
		]);

		if ($this->form_validation->run() != false) {
			
			$data = array(
				'id_mk' 		=> htmlspecialchars($this->input->post('mk', TRUE)),
				'id_dosendalam'	=> htmlspecialchars($this->input->post('dosen', TRUE)),
				'bulanpertama'	=> htmlspecialchars($this->input->post('bulan1', TRUE)),
				'bulankedua'	=> htmlspecialchars($this->input->post('bulan2', TRUE))
			);
			
			$this->m_crud->insert_data($data, 'tb_koord');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Honor Koordinator Mata Kuliah berhasil ditambahkan</div>');
			redirect(base_url('koord'));
			
		} else {
			$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
			$data['dosendalam'] = $this->m_koord->get_dosenDalam()->result();
			$data['ta'] = $this->m_koord->get_ta()->result();
			$this->load->view('koord/v_koord_add', $data);
		}
	}

	public function edit($id)
	{
		$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
		$data['dosendalam'] = $this->m_koord->get_dosenDalam()->result();
		$data['koord'] = $this->m_koord->get_koordEdit($id)->result();
		$this->load->view('koord/v_koord_edit',$data);
	}

	public function update()
	{
		
		$where = array('id_koord' => htmlspecialchars($this->input->post('id_koord', TRUE)));

		$data = array(
			'id_mk' 		=> htmlspecialchars($this->input->post('mk', TRUE)),
			'id_dosendalam'	=> htmlspecialchars($this->input->post('dosen', TRUE)),
			'bulanpertama'	=> htmlspecialchars($this->input->post('bulan1', TRUE)),
			'bulankedua'	=> htmlspecialchars($this->input->post('bulan2', TRUE))
		);

		$this->m_crud->update_data($where, $data, 'tb_koord');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Honor Koordinator Mata Kuliah berhasil di Update</div>');
		redirect(base_url('koord'));
	}

	public function hapus($id)
	{
		$where = array('id_koord'=>$id);
		
		$this->m_crud->delete_data($where,'tb_koord');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Honor Koordinator Mata Kuliah berhasil di hapus</div>');
		redirect(base_url('koord'));
	}

	public function exportPdf()
	{
		if (isset($_GET['bulan1']) && isset($_GET['bulan2']) && isset($_GET['kelas'])) {
			$bulan1 = $this->input->get('bulan1');
			$bulan2	= $this->input->get('bulan2');
			$kelas	= $this->input->get('kelas');
			$data['title'] = 'Export filter to PDF';
			$data['koord'] = $this->m_koord->get_filterKoord($bulan1, $bulan2, $kelas)->row();
			$data['koord2'] = $this->m_koord->get_filterKoord($bulan1, $bulan2, $kelas)->result();
			//echo "<pre>";print_r($data);die;
			//$data['prop'] = $this->m_koord->get_filterKoord($id_proker)->result();

			$this->mypdf2->generate('koord/v_koord_exportpdf', $data, 'laporan', 'A4', 'landscape');
		}
	}


}