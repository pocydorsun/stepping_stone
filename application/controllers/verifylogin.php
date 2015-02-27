<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class VerifyLogin extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('user_model', '', TRUE);
	}

	function index() {

		if ($this -> session -> userdata('logged_in')) {
			$user_session = $this -> session -> userdata('logged_in');
			redirect($user_session['status'], 'refesh');
		} else {
			$this -> load -> library('form_validation');
			$this -> form_validation -> set_rules('txtUsername', 'Username', 'trim|required|xss_clean');
			$this -> form_validation -> set_rules('txtPassword', 'Password', 'trim|required|xss_clean|callback_check_database');

			if ($this -> form_validation -> run() == FALSE) {

				$this -> load -> view('include/header');
				$this -> load -> view('login/login_view');
				$this -> load -> view('include/footer');
			} else {
				$user_session = $this -> session -> userdata('logged_in');
				redirect($user_session['status'], 'refesh');
			}
		}

	}

	function check_database($password) {
		//Field validation succeeded.  Validate against database
		$username = $this -> input -> post('txtUsername');

		//query the database
		$result = $this -> user_model -> login($username, $password);

		if ($result) {
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = array('id' => $row -> id, 'username' => $row -> username, 'status' => $row -> status);
				$this -> session -> set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		} else {
			$this -> form_validation -> set_message('check_database', 'Invalid username or password');
			return false;
		}
	}

}
?>