<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Honor_dosen_luar extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_hdl');
		$this->load->model('m_matakuliah');
		$this->load->model('m_dosenluar');
		$this->load->model('m_kelas');
		$this->load->library('mypdf2');
	}

	public function index()
	{
		if (isset($_GET['bulan1']) || isset($_GET['bulan2']) || isset($_GET['kelas'])) {
			$bulan1 = $this->input->get('bulan1');
			$bulan2	= $this->input->get('bulan2');
			$kelas	= $this->input->get('kelas');
			$data['honordl'] = $this->m_hdl->get_filterHdl($bulan1, $bulan2, $kelas)->result();
			$data['kelas'] = $this->m_kelas->get_kelas()->result();
			$this->load->view('honordl/v_hdl', $data);
		} else {
			$data['honordl'] = $this->m_hdl->get_hdl()->result();
			$data['kelas'] = $this->m_kelas->get_kelas()->result();
			$this->load->view('honordl/v_hdl', $data);
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
				'id_dosenluar'	=> htmlspecialchars($this->input->post('dosen', TRUE)),
				'pertemuan'		=> htmlspecialchars($this->input->post('pertemuan', TRUE)),
				'jam'			=> htmlspecialchars($this->input->post('jam', TRUE)),
				'bulanpertama'	=> htmlspecialchars($this->input->post('bulan1', TRUE)),
				'bulankedua'	=> htmlspecialchars($this->input->post('bulan2', TRUE))
			);

			$this->m_crud->insert_data($data, 'tb_honor_dosenluar');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Honor Dosen Luar berhasil ditambahkan</div>');
			redirect(base_url('honor_dosen_luar'));
			
		} else {
			$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
			$data['dosenluar'] = $this->m_dosenluar->get_dosenLuar()->result();
			$this->load->view('honordl/v_hdl_add', $data);
		}
	}

	public function edit($id)
	{
		$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
		$data['dosenluar'] = $this->m_dosenluar->get_dosenLuar()->result();
		$data['hdl'] = $this->m_hdl->get_hdlEdit($id)->result();
		$this->load->view('honordl/v_hdl_edit',$data);
	}

	public function update()
	{
		
		$where = array('id_honor_dosenluar' => htmlspecialchars($this->input->post('id_honordl', TRUE)));

		$data = array(
			'id_mk' 		=> htmlspecialchars($this->input->post('mk', TRUE)),
			'id_dosenluar'	=> htmlspecialchars($this->input->post('dosen', TRUE)),
			'pertemuan'		=> htmlspecialchars($this->input->post('pertemuan', TRUE)),
			'jam'			=> htmlspecialchars($this->input->post('jam', TRUE)),
			'bulanpertama'	=> htmlspecialchars($this->input->post('bulan1', TRUE)),
			'bulankedua'	=> htmlspecialchars($this->input->post('bulan2', TRUE))
		);

		$this->m_crud->update_data($where, $data, 'tb_honor_dosenluar');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Honor Dosen Luar berhasil di Update</div>');
		redirect(base_url('honor_dosen_luar'));
	}

	public function hapus($id)
	{
		$where = array('id_honor_dosenluar'=>$id);
		
		$this->m_crud->delete_data($where,'tb_honor_dosenluar');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Honor Dosen Luar berhasil di hapus</div>');
		redirect(base_url('honor_dosen_luar'));
	}

	public function exportPdf()
	{
		if (isset($_GET['bulan1']) && isset($_GET['bulan2']) && isset($_GET['kelas'])) {
			$bulan1 = $this->input->get('bulan1');
			$bulan2	= $this->input->get('bulan2');
			$kelas	= $this->input->get('kelas');
			$data['title'] = 'Export filter to PDF';
			$data['honordd'] = $this->m_hdl->get_filterHdl($bulan1, $bulan2, $kelas)->row();
			$data['honordd2'] = $this->m_hdl->get_filterHdl($bulan1, $bulan2, $kelas)->result();
			//echo "<pre>";print_r($data);die;
			//$data['prop'] = $this->m_koord->get_filterKoord($id_proker)->result();

			$this->mypdf2->generate('honordd/v_hdd_exportpdf', $data, 'laporan', 'A4', 'landscape');
		}
	}


}