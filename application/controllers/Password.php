<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Password extends CI_Controller
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
		$this->form_validation->set_rules('password1', 'Password Baru', 'required|trim|min_length[6]|matches[password2]', [
			'required' 		=> 'Silahkan Masukan Password Baru Anda !',
			'matches' 		=> 'Password tidak sama !',
			'min_length' 	=> 'Password Harus Lebih dari 6 Karakter'
		]);
		$this->form_validation->set_rules('password2', 'Password Ulang', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$this->load->view('v_password');
			
		} else {
			$baru = htmlspecialchars($this->input->post('password1', true));

			if ($this->session->userdata('status') == 'user_login') {
				$id = $this->session->userdata('id_user');
				$where 	= array('id_user' => $id);
				$data 	= array('password' => password_hash($baru, PASSWORD_DEFAULT));

				$this->m_crud->update_data($where, $data, 'tb_user');
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-message text-center"><b>Selamat, Password telah berhasil di ubah</b></div>');
				redirect(base_url('password'));
			}
		}
	}
}
