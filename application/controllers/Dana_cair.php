<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dana_cair extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_proposal');
		$this->load->model('m_proker');
		$this->load->model('m_dana_cair');
		$this->load->library('mypdf');
	}

	public function index()
	{
		if (isset($_GET['proker'])) {
			$id_proker = $this->input->get('proker');
			$data['dana_cair'] = $this->m_dana_cair->get_filter_danaCair($id_proker)->result();
			$data['proker'] = $this->m_proposal->get_proker('tb_proker')->result();
			$this->load->view('proker/v_dana_cair.php', $data);
		} else {
			$data['dana_cair'] = $this->m_dana_cair->get_danaCair()->result();
			$data['proker'] = $this->m_proposal->get_proker('tb_proker')->result();
			$this->load->view('proker/v_dana_cair.php', $data);
		}
	}

	public function add()
	{
		$this->form_validation->set_rules('proker', 'Program Kerja', 'required|trim', [
			'required' => 'Anda belum memilih Program Kerja !'
		]);
		$this->form_validation->set_rules('dana_cair', 'Dana Cair', 'required|trim', [
			'required' => 'Silahkan masukan Jumlah Dana Cair!'
		]);
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
			'required' => 'Silahkan masukan tanggal Dana Cair!'
		]);
		$this->form_validation->set_rules('no_kwitansi', 'No. Kwitansi', 'required|trim|is_unique[tb_dana_cair.no_kwitansi]', [
			'required' => 'Silahkan masukan No. Kwitansi!',
			'is_unique'=> 'Maaf, No. Kwitansi yang anda Inputkan sudah ada!'
		]);
		$this->form_validation->set_rules('nota_dinas', 'Nota Dinas', 'required|trim|is_unique[tb_dana_cair.nota_dinas]', [
			'required' => 'Silahkan masukan Nota Dinas!',
			'is_unique'=> 'Maaf, Nota Dinas yang anda Inputkan sudah ada!'
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
			'required' => 'Silahkan masukan Keterangan!'
		]);

		$id_proker		= htmlspecialchars($this->input->post('proker', TRUE));
		$dana_cair		= htmlspecialchars($this->input->post('dana_cair', TRUE));
		$tanggal 		= htmlspecialchars($this->input->post('tanggal', TRUE));
		$no_kwitansi 	= htmlspecialchars($this->input->post('no_kwitansi', TRUE));
		$nota_dinas		= htmlspecialchars($this->input->post('nota_dinas', TRUE));
		$keterangan		= htmlspecialchars($this->input->post('keterangan', TRUE));

		if ($this->form_validation->run() != false) {
			
			$data = array(
				'id_proker' 	=> $id_proker,
				'dana_cair' 	=> $dana_cair,
				'tanggal' 		=> $tanggal,
				'no_kwitansi'	=> $no_kwitansi,
				'nota_dinas'	=> $nota_dinas,
				'keterangan'	=> $keterangan
			);

			$this->m_crud->insert_data($data, 'tb_dana_cair');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dana Cair berhasil ditambahkan</div>');
			redirect(base_url('dana_cair'));
			
		} else {
			$data['proker'] = $this->m_proker->get_proker('tb_proker')->result();
			$this->load->view('proker/v_dana_cair_add', $data);
		}
	}

	public function edit($id)
	{
		$data['dana_cair'] = $this->m_dana_cair->get_joinDanaCair($id)->result();
		$data['proker'] = $this->m_proker->get_proker('tb_proker')->result();
		$this->load->view('proker/v_dana_cair_edit',$data);
	}

	public function update()
	{
		$this->form_validation->set_rules('proker', 'Program Kerja', 'required|trim', [
			'required' => 'Anda belum memilih Program Kerja !'
		]);
		$this->form_validation->set_rules('dana_cair', 'Dana Cair', 'required|trim', [
			'required' => 'Silahkan masukan Jumlah Dana Cair!'
		]);
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
			'required' => 'Silahkan masukan tanggal Dana Cair!'
		]);
		$this->form_validation->set_rules('no_kwitansi', 'No. Kwitansi', 'required|trim|is_unique[tb_dana_cair.no_kwitansi]', [
			'required' => 'Silahkan masukan No. Kwitansi!',
			'is_unique'=> 'Maaf, No. Kwitansi yang anda Inputkan sudah ada!'
		]);
		$this->form_validation->set_rules('nota_dinas', 'Nota Dinas', 'required|trim|is_unique[tb_dana_cair.nota_dinas]', [
			'required' => 'Silahkan masukan Nota Dinas!',
			'is_unique'=> 'Maaf, Nota Dinas yang anda Inputkan sudah ada!'
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', [
			'required' => 'Silahkan masukan Keterangan!'
		]);

		$id_dana_cair	= htmlspecialchars($this->input->post('id_dana_cair', TRUE));
		$id_proker		= htmlspecialchars($this->input->post('id_proker', TRUE));
		$dana_cair		= htmlspecialchars($this->input->post('dana_cair', TRUE));
		$tanggal 		= htmlspecialchars($this->input->post('tanggal', TRUE));
		$no_kwitansi 	= htmlspecialchars($this->input->post('no_kwitansi', TRUE));
		$nota_dinas		= htmlspecialchars($this->input->post('nota_dinas', TRUE));
		$keterangan		= htmlspecialchars($this->input->post('keterangan', TRUE));

		$where 	= array('id_dana_cair'=>$id_dana_cair);
		$data = array(
			'id_proker' 	=> $id_proker,
			'dana_cair' 	=> $dana_cair,
			'tanggal' 		=> $tanggal,
			'no_kwitansi'	=> $no_kwitansi,
			'nota_dinas'	=> $nota_dinas,
			'keterangan'	=> $keterangan
		);

		$this->m_crud->update_data($where, $data,'tb_dana_cair');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dana Cair berhasil di update</div>');
		redirect(base_url('proker/dana_cair'));

	}

	public function hapus($id)
	{
		$where = array('id_dana_cair'=>$id);
		
		$this->m_crud->delete_data($where,'tb_dana_cair');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dana Cair berhasil di hapus</div>');
		redirect(base_url('dana_cair'));
	}

	public function exportPdf()
	{
		if (isset($_GET['proker'])) {
			$id_proker = $this->input->get('proker');
			$data['title'] = 'Export filter to PDF';
			$data['proker'] = $this->m_proposal->get_filter_proker($id_proker)->result();
			$data['prop'] = $this->m_proposal->get_filter_proposal($id_proker)->result();
			$data['dana_cair'] = $this->m_dana_cair->get_filter_danaCair($id_proker)->result();
			$this->mypdf->generate('proker/v_dana_cair_export', $data, 'laporan', 'A4', 'portrait');
		} else {
			$data['title'] = 'Export all to PDF';
			$data['proker'] = $this->m_proposal->get_proker('tb_proker')->result();
			$data['prop'] = $this->m_proposal->get_proposal('tb_proposal')->result();
			$data['dana_cair'] = $this->m_dana_cair->get_danaCair()->result();
			$this->mypdf->generate('proker/v_dana_cair_export', $data, 'laporan', 'A4', 'portrait');
		}
	}
}