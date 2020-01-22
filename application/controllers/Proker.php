<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proker extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('status') != 'user_login') {
			redirect(base_url('auth'));
		}
		$this->load->model('m_proker');
		$this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
	}

	public function index()
	{
		$data['proker'] = $this->m_proker->get_proker('tb_proker')->result();
		$this->load->view('proker/v_proker', $data);
	}

	public function add() 
	{
		$this->form_validation->set_rules('nama_proker', 'Program Kerja', 'required|trim', [
			'required' => 'Field Program Kerja tidak boleh kosong!'
		]);
		$this->form_validation->set_rules('dana_proker', 'Dana Program Kerja', 'required|trim', [
			'required' => 'Field Dana Program Kerja tidak boleh kosong!'
		]);

		$ta = htmlspecialchars($this->input->post('ta', TRUE));
		$proker = htmlspecialchars($this->input->post('nama_proker', TRUE));
		$dana = htmlspecialchars($this->input->post('dana_proker', TRUE));

		if ($this->form_validation->run() != false) {
			
			$data = array(
				'id_ta' => $ta,
				'nama_proker' => $proker,
				'dana_proker' => $dana
			);

			$this->m_crud->insert_data($data, 'tb_proker');
			$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !,<br></b> Data Program Kerja berhasil ditambahkan</div>');
			redirect(base_url('proker'));
			
		} else {
			$data['ta'] = $this->m_crud->get_data('tb_ta')->result();
			$this->load->view('proker/v_proker_add', $data);
		}
	}

	public function edit($id)
	{
		$data['proker'] = $this->m_proker->get_joinproker($id)->result();
		$data['ta'] = $this->m_crud->get_data('tb_ta')->result();
		$this->load->view('proker/v_proker_edit',$data);
	}

	public function update()
	{
		$id 	= htmlspecialchars($this->input->post('id_proker', TRUE));
		$ta 	= htmlspecialchars($this->input->post('ta', TRUE));
		$proker	= htmlspecialchars($this->input->post('nama_proker', TRUE));
		$dana 	= htmlspecialchars($this->input->post('dana_proker', TRUE));

		$where 	= array('id_proker'=>$id);
		$data 	= array(
			'id_ta'=>$ta,
			'nama_proker'=>$proker,
			'dana_proker'=>$dana
		);
		
		$this->m_crud->update_data($where,$data,'tb_proker');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !,<br></b> Data Program Kerja berhasil di update</div>');
		redirect(base_url('proker'));
	}

	public function hapus($id) 
	{
		$where = array('id_proker'=>$id);
		
		$this->m_crud->delete_data($where,'tb_proker');
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !,<br></b> Data Program Kerja berhasil di hapus</div>');
		redirect(base_url('proker'));
	}

	public function import()
	{
		$data['ta'] = $this->m_crud->get_data('tb_ta')->result();
		$this->load->view('proker/v_proker_import', $data);
	}

	public function saveimport()
	{
		$fileName 	= $this->input->post('file', TRUE);
		$id_ta 		= $this->input->post('ta');

		if ($id_ta != "") {

			$config['upload_path'] 		= './format/';
			$config['file_name'] 		= $fileName;
			$config['allowed_types'] 	= 'xls|xlsx|csv|ods|ots';
			$config['max_size'] 		= 10000;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('file')) {

				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-ban"></i><b>Maaf !,<br></b> Import data Program Kerja <b>Gagal</b>!</div>');
				redirect(base_url('proker'));

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
						
						$nama_proker = $sheet->getCellByColumnAndRow(0, $row)->getValue();
                    	$dana_proker = $sheet->getCellByColumnAndRow(1, $row)->getValue();

						$data[] = array(
							
							'nama_proker'	=> $nama_proker,
							'dana_proker'	=> $dana_proker,
							'id_ta'			=> $id_ta,		
						);						
					}
				}
				$this->m_proker->insertimport($data);
            	unlink($media['full_path']);

				$this->session->set_flashdata('message', '<div class="alert alert-success alert-message"><i class="icon fa fa-check"></i><b>Selamat !<br></b> Data Program Kerja berhasil di Import</div>');
				redirect(base_url('proker'));
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message"><i class="icon fa fa-ban"></i><b>Maaf !,<br></b> Anda belum memilih Tahun Ajaran saat Import File !</div>');
			redirect(base_url('proker'));
		}
	}
}
