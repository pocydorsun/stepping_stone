<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class Logout_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
	}

	function logout() {
		$this -> session -> unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}

}

?>