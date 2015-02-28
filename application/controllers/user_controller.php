<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class User_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('source_model', '', TRUE);
	}

	function index() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$data['sources'] = $this -> source_model -> getAllSource();

				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('user/user_view', $data);
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