<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class Admin_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('user_model', '', TRUE);
	}

	function index() {
		
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user', 'refresh');
				break;
			case "admin" :
				
				$data['users'] = $this -> user_model -> getAllUser();
				
				
				$this -> load -> view('include/header');
				$this -> load -> view('admin/home_view', $data);
				$this -> load -> view('include/footer');
				break;
			default :
				redirect('login', 'refresh');
		}
	}
	

}

?>
