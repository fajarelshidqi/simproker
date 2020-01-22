<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proposal extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_proposal');
		$this->load->model('m_proker');
		$this->load->library('mypdf');
	}

	public function index() 
	{	
		if (isset($_GET['proker'])) {
			$id_proker = $this->input->get('proker');
			$data['prop'] = $this->m_proposal->get_filter_proposal($id_proker)->result();
			$data['proker'] = $this->m_proposal->get_proker('tb_proker')->result();
			$this->load->view('proker/v_proposal', $data);
		} else {
			$data['prop'] = $this->m_proposal->get_proposal('tb_proposal')->result();
			$data['proker'] = $this->m_proposal->get_proker('tb_proker')->result();
			$this->load->view('proker/v_proposal', $data);
		}		
	}

	public function add()
	{
		$this->form_validation->set_rules('id_proker', 'Tahun Ajaran', 'required|trim', [
			'required' => 'Anda belum memilih Program Kerja !'
		]);
		$this->form_validation->set_rules('tanggal', 'Tanggal Proposal', 'required|trim', [
			'required' => 'Silahkan masukan tanggal proposal!'
		]);
		$this->form_validation->set_rules('no_surat', 'No. Surat Proposal', 'required|trim|is_unique[tb_proposal.no_surat_proposal]', [
			'required' => 'Silahkan masukan No. Surat Proposal!',
			'is_unique'=> 'Maaf, No. Surat Proposal yang anda Inputkan sudah ada!'
		]);
		$this->form_validation->set_rules('perihal', 'Perihal', 'required|trim', [
			'required' => 'Silahkan masukan perihal proposal!'
		]);
		$this->form_validation->set_rules('dana_proposal', 'Dana Proposal', 'required|trim', [
			'required' => 'Silahkan masukan Dana Proposal!'
		]);

		$id_proker	= htmlspecialchars($this->input->post('id_proker', TRUE));
		$tgl 		= htmlspecialchars($this->input->post('tanggal', TRUE));
		$no_surat 	= htmlspecialchars($this->input->post('no_surat', TRUE));
		$perihal 	= htmlspecialchars($this->input->post('perihal', TRUE));
		$dana_prop	= htmlspecialchars($this->input->post('dana_proposal', TRUE));

		if ($this->form_validation->run() != false) {
			
			$data = array(
				'id_proker' 		=> $id_proker,
				'no_surat_proposal' => $no_surat,
				'tanggal_proposal' 	=> $tgl,
				'perihal'		 	=> $perihal,
				'dana_proposal'		=> $dana_prop
			);

			$this->m_crud->insert_data($data, 'tb_proposal');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Program Kerja berhasil ditambahkan</div>');
			redirect(base_url('proposal'));
			
		} else {
			$data['proker'] = $this->m_proker->get_proker('tb_proker')->result();
			$this->load->view('proker/v_proposal_add', $data);
		}
	}

	public function edit($id)
	{
		$data['proposal'] = $this->m_proposal->get_joinProposal($id)->result();
		// echo "<pre>";
		// print_r($data);
		// die;
		$data['proker'] = $this->m_proker->get_proker('tb_proker')->result();
		$this->load->view('proker/v_proposal_edit',$data);
	}

	public function update()
	{
		$this->form_validation->set_rules('id_proker', 'Tahun Ajaran', 'required|trim', [
			'required' => 'Anda belum memilih Program Kerja !'
		]);
		$this->form_validation->set_rules('tanggal', 'Tanggal Proposal', 'required|trim', [
			'required' => 'Silahkan masukan tanggal proposal!'
		]);
		$this->form_validation->set_rules('no_surat', 'No. Surat Proposal', 'required|trim|is_unique[tb_proposal.no_surat_proposal]', [
			'required' => 'Silahkan masukan No. Surat Proposal!',
			'is_unique'=> 'Maaf, No. Surat Proposal yang anda Inputkan sudah ada!'
		]);
		$this->form_validation->set_rules('perihal', 'Perihal', 'required|trim', [
			'required' => 'Silahkan masukan perihal proposal!'
		]);
		$this->form_validation->set_rules('dana_proposal', 'Dana Proposal', 'required|trim', [
			'required' => 'Silahkan masukan Dana Proposal!'
		]);

		$id_proposal= htmlspecialchars($this->input->post('id_proposal', TRUE));
		$id_proker	= htmlspecialchars($this->input->post('id_proker', TRUE));
		$tgl 		= htmlspecialchars($this->input->post('tanggal', TRUE));
		$no_surat 	= htmlspecialchars($this->input->post('no_surat', TRUE));
		$perihal 	= htmlspecialchars($this->input->post('perihal', TRUE));
		$dana_prop	= htmlspecialchars($this->input->post('dana_proposal', TRUE));

		$where 	= array('id_proposal'=>$id_proposal);
		$data = array(
			'id_proker' 		=> $id_proker,
			'no_surat_proposal' => $no_surat,
			'tanggal_proposal' 	=> $tgl,
			'perihal'		 	=> $perihal,
			'dana_proposal'		=> $dana_prop
		);

		$this->m_crud->update_data($where, $data,'tb_proposal');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Proposal berhasil di update</div>');
		redirect(base_url('proposal'));

	}

	public function hapus($id)
	{
		$where = array('id_proposal'=>$id);
		
		$this->m_crud->delete_data($where,'tb_proposal');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Proposal berhasil di hapus</div>');
		redirect(base_url('proposal'));
	}

	public function exportPdf()
	{
		if (isset($_GET['proker'])) {
			$id_proker = $this->input->get('proker');
			$data['title'] = 'Export filter to PDF';
			$data['proker'] = $this->m_proposal->get_filter_proker($id_proker)->result();
			$data['prop'] = $this->m_proposal->get_filter_proposal($id_proker)->result();

			$this->mypdf->generate('proker/v_proposal_export', $data, 'laporan', 'A4', 'portrait');
		} else {
			$data['title'] = 'Export all to PDF';
			$data['proker'] = $this->m_proposal->get_proker('tb_proker')->result();
			$data['prop'] = $this->m_proposal->get_proposal('tb_proposal')->result();

			$this->mypdf->generate('proker/v_proposal_export', $data, 'laporan', 'A4', 'portrait');
		}
	}

}