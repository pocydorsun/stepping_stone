<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	public function index() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user','refesh');
				break;
			case "admin" :
				redirect('admin','refesh');
				break;
			default :
				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('login/login_view');
				$this -> load -> view('include/footer');
		}
		
	}

}
