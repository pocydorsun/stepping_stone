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
				redirect('user/plan', 'refesh');
				break;
			case "admin" :
				redirect('admin', 'refesh');
				break;
			default :
				$this -> load -> model('user_model', '', TRUE);
				$user_session = $this -> session -> userdata('logged_in');

				$user_id = $user_session['id'];
				$data['name'] = $this -> user_model -> getName($user_id);

				$this -> load -> helper('form');
				$this -> load -> view('include/header', $data);
				$this -> load -> view('login/login_view');
				$this -> load -> view('include/footer');
		}

	}

}
?>
