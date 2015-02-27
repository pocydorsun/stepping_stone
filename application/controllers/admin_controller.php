<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class Admin_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$user_session = $this -> session -> userdata('logged_in');
		
		if ($user_session['status'] == 'admin') {
			$session_data = $this -> session -> userdata('logged_in');
			$data['username'] = $session_data['username'];
			$this -> load -> view('include/header');
			$this -> load -> view('admin/home_view');
			$this -> load -> view('include/footer');
		} else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

}

?>
