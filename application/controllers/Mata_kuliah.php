<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mata_kuliah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_matakuliah');
		$this->load->model('m_kelas');
		$this->load->library('mypdf');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	public function index()
	{
		$data['matakuliah'] = $this->m_matakuliah->get_mk()->result();
		$this->load->view('honor/v_matakuliah', $data);
	}

	public function add()
	{
		$this->form_validation->set_rules('mata_kuliah', 'Mata Kuliah', 'required|trim|is_unique[tb_matakuliah.nama_mk]', [
			'required' => 'Silahkan masukan Kode Mata Kuliah!',
			'is_unique'=> 'Maaf, Nama Mata Kuliah yang anda Inputkan sudah ada!'
		]);
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', [
			'required' => 'Anda belum mengisi data Kelas!'
		]);
		$this->form_validation->set_rules('sks', 'SKS', 'required|trim', [
			'required' => 'Anda belum mengisi data SKS!'
		]);
		$this->form_validation->set_rules('honor_mk', 'Honor MK', 'required|trim', [
			'required' => 'Anda belum mengisi data Honor Koord. MK!'
		]);

		$kelas			= htmlspecialchars($this->input->post('kelas', TRUE));
		$mata_kuliah	= htmlspecialchars($this->input->post('mata_kuliah', TRUE));
		$sks 			= htmlspecialchars($this->input->post('sks', TRUE));
		$honor_mk 		= htmlspecialchars($this->input->post('honor_mk', TRUE));

		if ($this->form_validation->run() != false) {
			
			$data = array(
				'id_kelas'	=> $kelas,
				'nama_mk' 	=> $mata_kuliah,
				'sks' 		=> $sks,
				'honor_mk'	=> $honor_mk
			);

			$this->m_crud->insert_data($data, 'tb_matakuliah');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Mata Kuliah berhasil ditambahkan</div>');
			redirect(base_url('mata_kuliah'));
			
		} else {
			$data['kelas'] = $this->m_kelas->get_kelas()->result();
			$this->load->view('honor/v_matakuliah_add', $data);
		}
	}

	public function edit($id)
	{
		$data['matakuliah'] = $this->m_matakuliah->get_mkEdit($id)->result();
		$data['kelas'] = $this->m_kelas->get_kelas()->result();
		$this->load->view('honor/v_matakuliah_edit',$data);
	}

	public function update()
	{
		$this->form_validation->set_rules('nama_mk', 'Mata Kuliah', 'required|trim|is_unique[tb_matakuliah.nama_mk]', [
			'required' => 'Silahkan masukan Nama Mata Kuliah!',
			'is_unique'=> 'Maaf, Nama Mata Kuliah yang anda Inputkan sudah ada!'
		]);

		$kelas		= htmlspecialchars($this->input->post('kelas', TRUE));
		$id_mk		= htmlspecialchars($this->input->post('id_mk', TRUE));
		$nama_mk	= htmlspecialchars($this->input->post('nama_mk', TRUE));
		$sks 		= htmlspecialchars($this->input->post('sks', TRUE));
		$honor_mk 	= htmlspecialchars($this->input->post('honor_mk', TRUE));

		$where = array('id_mk' => $id_mk);

		$data = array(
			'id_kelas'	=> $kelas,
			'nama_mk' 	=> $nama_mk,
			'sks' 		=> $sks,
			'honor_mk'	=> $honor_mk
		);

		$this->m_crud->update_data($where, $data, 'tb_matakuliah');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Mata Kuliah berhasil di Update</div>');
		redirect(base_url('mata_kuliah'));
	}

	public function hapus($id)
	{
		$where = array('id_mk'=>$id);
		
		$this->m_crud->delete_data($where,'tb_matakuliah');
		$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-check"></i><b>SELAMAT !<br></b> Data Mata Kuliah berhasil di hapus</div>');
		redirect(base_url('mata_kuliah'));
	}

	public function import()
	{
		$data['kelas'] = $this->m_kelas->get_kelas()->result();
		$this->load->view('honor/v_matakuliah_import', $data);
	}

	public function saveimport()
	{
		$fileName 	= $this->input->post('file', TRUE);
		$id_kelas 	= $this->input->post('kelas');

		if ($id_kelas != "") {

			$config['upload_path'] 		= './format/';
			$config['file_name'] 		= $fileName;
			$config['allowed_types'] 	= 'xls|xlsx|csv|ods|ots';
			$config['max_size'] 		= 10000;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('file')) {

				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-ban"></i><b>Maaf !,<br></b> Import data Mata Kuliah <b>Gagal</b>!</div>');
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
						
						$mata_kuliah 	= $sheet->getCellByColumnAndRow(0, $row)->getValue();
						$sks 			= $sheet->getCellByColumnAndRow(1, $row)->getValue();
						$honor_mk		= $sheet->getCellByColumnAndRow(2, $row)->getValue();

						$data[] = array(
							'id_kelas'	=> $id_kelas,
							'nama_mk' 	=> $mata_kuliah,
							'sks' 		=> $sks,
							'honor_mk'	=> $honor_mk,

						);						
					}
					
				}
				
				$this->m_matakuliah->insertimport($data);
				unlink($media['full_path']);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Data Mata Kuliah berhasil di Import</div>');
				redirect(base_url('mata_kuliah'));		
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-ban"></i><b>Maaf !,<br></b> Anda belum memilih Kelas saat Import File !</div>');
			redirect(base_url('mata_kuliah'));
		}
	}
}