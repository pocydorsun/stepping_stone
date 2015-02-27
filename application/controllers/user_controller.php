<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class User_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$this -> load -> view('include/header');
				$this -> load -> view('user/user_view');
				$this -> load -> view('include/footer');
				break;
			case "admin" :
				redirect('admin', 'refesh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

}
?>