<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim', ['required' => 'Email harus di isi!']);
		$this->form_validation->set_rules('password', 'Password', 'required|trim', ['required' => 'Password harus di isi!']);

		$email = htmlspecialchars($this->input->post('email', TRUE));
		$password = htmlspecialchars($this->input->post('password', TRUE));

		if ($this->form_validation->run() != false) {

			$where 	= array('email' => $email);
			$user 	= $this->db->get_where('tb_user', ['email' => $email])->row_array();

			if (password_verify($password, $user['password'])) {
				$data = $this->m_crud->edit_data($where, 'tb_user')->row();
				$data_session = array(
					'id_user'		=> $data->id_user,
					'nama_user'		=> $data->nama_user,
					'email'			=> $data->email,
					'status'		=> 'user_login'
				);
				$this->session->set_userdata($data_session);
				$this->session->set_flashdata('message', '<div class="alert alert-success alert-message text-center"><b>Login Berhasil !,<br></b> Halaman ini akan dialihkan ke Halaman Home</div>');
				redirect(base_url('home'));
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-message text-center"><b>Login Gagal !,<br></b> Maaf, Username dan Password tidak ditemukan</div>');
				redirect(base_url('auth'));
			}
		} else {
			$this->load->view('v_login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success alert-message text-center">Anda sudah logout</div>');
		redirect(base_url('auth'));
	}
}
