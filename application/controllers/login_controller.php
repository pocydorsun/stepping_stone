<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	public function index()
	{
		$this->load->helper('form');
		$this->load->view('include/header');
		$this->load->view('login/login_view');
		$this->load->view('include/footer');
	}
}
