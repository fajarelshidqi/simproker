<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen_dalam extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_dosendalam');
		$this->load->model('m_matakuliah');
		$this->load->library('mypdf');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	public function index()
	{
		$data['dosenDalam'] = $this->m_dosendalam->get_dosenDalam()->result();
		$this->load->view('honor/v_dosendalam.php', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('dosen', 'Dosen Dalam', 'required|trim|is_unique[tb_dosendalam.nama_dosendalam]', [
			'required' => 'Silahkan masukan Kode Mata Kuliah!',
			'is_unique'=> 'Maaf, Nama Dosen yang anda Inputkan sudah ada!'
		]);
		$this->form_validation->set_rules('honor_dosen', 'Honor Mengajar', 'required|trim', [
			'required' => 'Anda belum mengisi data Honor Mengajar!'
		]);

		$nama_dosen		= htmlspecialchars($this->input->post('dosen', TRUE));
		$honor_dosen	= htmlspecialchars($this->input->post('honor_dosen', TRUE));

		if ($this->form_validation->run() != false) {
			
			$data = array(
				'nama_dosendalam'	=> $nama_dosen,
				'honor_dosendalam'	=> $honor_dosen
			);

			$this->m_crud->insert_data($data, 'tb_dosendalam');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dosen Dalam berhasil ditambahkan</div>');
			redirect(base_url('dosen_dalam'));
			
		} else {
			$this->load->view('honor/v_dosendalam_add');
		}
	}

	public function edit($id)
	{
		$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
		$data['dosenDalam'] = $this->m_dosendalam->get_dosenDalamEdit($id)->result();
		$this->load->view('honor/v_dosendalam_edit',$data);
	}

	public function update()
	{
		
		$where = array('id_dosendalam' => htmlspecialchars($this->input->post('id_dosen', TRUE)));

		$data = array(
			'nama_dosendalam'	=> htmlspecialchars($this->input->post('dosen', TRUE)),
			'id_mk'				=> htmlspecialchars($this->input->post('nama_mk', TRUE)),
			'honor_dosendalam'	=> htmlspecialchars($this->input->post('honor_dosen', TRUE))
		);

		$this->m_crud->update_data($where, $data, 'tb_dosendalam');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dosen Dalam berhasil di Update</div>');
		redirect(base_url('dosen_dalam'));
	}

	public function hapus($id)
	{
		$where = array('id_dosendalam'=>$id);
		
		$this->m_crud->delete_data($where,'tb_dosendalam');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Dosen Dalam berhasil di hapus</div>');
		redirect(base_url('dosen_dalam'));
	}

	public function import()
	{
		$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
		$this->load->view('honor/v_dosendalam_import', $data);
	}

	public function saveimport()
	{
		$fileName 	= $this->input->post('file', TRUE);
		$id_mk 	= $this->input->post('id_mk');

		if ($id_mk != "") {

			$config['upload_path'] 		= './format/';
			$config['file_name'] 		= $fileName;
			$config['allowed_types'] 	= 'xls|xlsx|csv|ods|ots';
			$config['max_size'] 		= 10000;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('file')) {

				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-ban"></i><b>Maaf !,<br></b> Import data Dosen Dalam <b>Gagal</b>!</div>');
				redirect(base_url('mata_kuliah'));

			} else {

				$media 			= $this->upload->data();
				$inputFileName 	= 'format/'.$media['file_name'];

				try {

					$inputFileType 	= IOFactory::identify($inputFileName);
					$objReader 		= IOFactory::createReader($inputFileType);
					$objPHPExcel	= $objReader->load($inputFileName);

				} catch(Eception $e) {

					die('Erorr loading file"'.pathinfo($inputFileName, PATHINFO_BASENAME).'": '.$e->getMessage());
				}

				foreach($objPHPExcel->getWorksheetIterator() as $sheet)
				{
					$highestRow		= $sheet->getHighestRow();
					$highestColumn	= $sheet->getHighestColumn();

					for ($row=2; $row <= $highestRow; $row++) 
					{ 
						
						$nama_dosendalam 	= $sheet->getCellByColumnAndRow(0, $row)->getValue();
						$honor_dosendalam		= $sheet->getCellByColumnAndRow(2, $row)->getValue();

						$data[] = array(
							'id_mk'	=> $id_mk,
							'nama_dosendalam' 	=> $nama_dosendalam,
							'honor_dosendalam'	=> $honor_dosendalam,

						);						
					}
					
				}
				
				$this->m_dosendalam->insertimport($data);
				unlink($media['full_path']);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Data Dosen Dalam berhasil di Import</div>');
				redirect(base_url('dosen_dalam'));		
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-ban"></i><b>Maaf !,<br></b> Anda belum memilih Mata Kuliah saat Import File !</div>');
			redirect(base_url('dosen_dalam'));
		}
	}
}