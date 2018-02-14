<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}

	public function index()
	{
		if($this->session->userdata('logged_in') == TRUE){
			redirect('surat','refresh');
		} else {
			$this->load->view('login_view');
		}
		
	}
	public function do_login(){
		if($this->session->userdata('logged_in') ==  TRUE){
			redirect('surat','refresh');
		} else{
			$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
			$this->form_validation->set_rules('password', 'PASSWORD', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if($this->login_model->user_check() == TRUE){
					$this->session->set_flashdata('notif', 'LOGIN SUKSES');
					redirect('surat','refresh');
				} else{
					$this->session->set_flashdata('notif', 'NIK atau password salah');
					redirect('login','refresh');
				}
			} else {
					$this->session->set_flashdata('notif', validation_errors());
					redirect('login','refresh');
			}
		}
	}
	public function logout(){
		if($this->session->userdata('logged_in') == TRUE){
			$this->session->sess_destroy();
			redirect('login','refresh');
		}
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */