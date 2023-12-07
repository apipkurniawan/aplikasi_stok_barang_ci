<?php

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->login) redirect('dashboard');
		$this->load->model('M_pengguna', 'm_pengguna');
	}

	public function index(){
		$this->load->view('login');
	}

	public function proses_login(){
		if($this->input->post('role')) $this->_proses_login_pengguna($this->input->post('username'));
	}

	protected function _proses_login_pengguna($username){
		$get_pengguna = $this->m_pengguna->lihat_username($username);
		if ($get_pengguna) {
			if ($get_pengguna->password != $this->input->post('password')) {
				$this->session->set_flashdata('error', 'Password Salah!');
				redirect();
			} else if($get_pengguna->kode_role != explode('-', $this->input->post('role'))[0]) {
				$this->session->set_flashdata('error', 'Role Akses tidak sesuai!');
				redirect();
			} else {
				$session = [
					'kode' => $get_pengguna->kode,
					'nama' => $get_pengguna->nama,
					'username' => $get_pengguna->username,
					'password' => $get_pengguna->password,
					'role' => explode('-', $this->input->post('role'))[1],
					'jam_masuk' => date('H:i:s')
				];

				$this->session->set_userdata('login', $session);
				$this->session->set_flashdata('success', '<strong>Login</strong> Berhasil!');
				redirect('dashboard');
			}
		} else {
			$this->session->set_flashdata('error', 'Username Salah!');
			redirect();
		}
	}
}