<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Honor_dosen_dalam extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_hdd');
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
			$data['honordd'] = $this->m_hdd->get_filterHdd($bulan1, $bulan2, $kelas)->result();
			$data['kelas'] = $this->m_kelas->get_kelas()->result();
			$this->load->view('honordd/v_hdd', $data);
		} else {
			$data['honordd'] = $this->m_hdd->get_hdd()->result();
			$data['kelas'] = $this->m_kelas->get_kelas()->result();
			$this->load->view('honordd/v_hdd', $data);
		}
		
	}

	public function add()
	{
		$this->form_validation->set_rules('pertemuan', 'Pertemuan', 'required|trim', [
			'required' => 'Anda belum mengisi data Pertemuan!'
		]);
		$this->form_validation->set_rules('jam', 'Jam', 'required|trim', [
			'required' => 'Anda belum mengisi data Jam Mengajar!'
		]);

		if ($this->form_validation->run() != false) {
			
			$data = array(
				'id_mk' 		=> htmlspecialchars($this->input->post('mk', TRUE)),
				'id_dosendalam'	=> htmlspecialchars($this->input->post('dosen', TRUE)),
				'pertemuan'		=> htmlspecialchars($this->input->post('pertemuan', TRUE)),
				'jam'			=> htmlspecialchars($this->input->post('jam', TRUE)),
				'bulanpertama'	=> htmlspecialchars($this->input->post('bulan1', TRUE)),
				'bulankedua'	=> htmlspecialchars($this->input->post('bulan2', TRUE))
			);

			$this->m_crud->insert_data($data, 'tb_honor_dosendalam');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Honor Dosen Dalam berhasil ditambahkan</div>');
			redirect(base_url('honor_dosen_dalam'));
			
		} else {
			$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
			$data['dosendalam'] = $this->m_dosendalam->get_dosenDalam()->result();
			$this->load->view('honordd/v_hdd_add', $data);
		}
	}

	public function edit($id)
	{
		$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
		$data['dosendalam'] = $this->m_dosendalam->get_dosenDalam()->result();
		$data['hdd'] = $this->m_hdd->get_hddEdit($id)->result();
		$this->load->view('honordd/v_hdd_edit',$data);
	}

	public function update()
	{
		
		$where = array('id_honor_dosendalam' => htmlspecialchars($this->input->post('id_honordd', TRUE)));

		$data = array(
			'id_mk' 		=> htmlspecialchars($this->input->post('mk', TRUE)),
			'id_dosendalam'	=> htmlspecialchars($this->input->post('dosen', TRUE)),
			'pertemuan'		=> htmlspecialchars($this->input->post('pertemuan', TRUE)),
			'jam'			=> htmlspecialchars($this->input->post('jam', TRUE)),
			'bulanpertama'	=> htmlspecialchars($this->input->post('bulan1', TRUE)),
			'bulankedua'	=> htmlspecialchars($this->input->post('bulan2', TRUE))
		);

		$this->m_crud->update_data($where, $data, 'tb_honor_dosendalam');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Honor Dosen Dalam berhasil di Update</div>');
		redirect(base_url('honor_dosen_dalam'));
	}

	public function hapus($id)
	{
		$where = array('id_honor_dosendalam'=>$id);
		
		$this->m_crud->delete_data($where,'tb_honor_dosendalam');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Honor Dosen Dalam berhasil di hapus</div>');
		redirect(base_url('honor_dosen_dalam'));
	}

	public function exportPdf()
	{
		if (isset($_GET['bulan1']) && isset($_GET['bulan2']) && isset($_GET['kelas'])) {
			$bulan1 = $this->input->get('bulan1');
			$bulan2	= $this->input->get('bulan2');
			$kelas	= $this->input->get('kelas');
			$data['title'] = 'Export filter to PDF';
			$data['honordd'] = $this->m_hdd->get_filterHdd($bulan1, $bulan2, $kelas)->row();
			$data['honordd2'] = $this->m_hdd->get_filterHdd($bulan1, $bulan2, $kelas)->result();
			//echo "<pre>";print_r($data);die;
			//$data['prop'] = $this->m_koord->get_filterKoord($id_proker)->result();

			$this->mypdf2->generate('honordd/v_hdd_exportpdf', $data, 'laporan', 'A4', 'landscape');
		}
	}


}