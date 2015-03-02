<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class User_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('user_model', '', TRUE);
		$this -> load -> model('source_model', '', TRUE);
		$this -> load -> model('destination_model', '', TRUE);
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

	function source_manager() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$data['sources'] = $this -> source_model -> getAllSource();

				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('user/source_view', $data);
				$this -> load -> view('include/footer');
				break;
			case "admin" :
				redirect('admin', 'refesh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function add_source() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$this -> load -> library('form_validation');
				$this -> form_validation -> set_rules('txtSource', 'Source', 'trim|required|alpha_numeric|min_length[6]|max_length[20]|xss_clean|callback_check_source_exit');

				if ($this -> form_validation -> run() == FALSE) {
					$this -> session -> set_flashdata('error_msg', validation_errors());
					redirect('user/source');
				} else {

					$this -> session -> set_flashdata('success_msg', 'เพิ่มต้นทางสำเร็จ');

					redirect('user/source');
				}
				break;
			case "admin" :
				redirect('admin', 'refesh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

function check_source_exit($sourcename) {

		$result = $this -> source_model -> addSource($sourcename);

		if ($result) {
			return TRUE;
		} else {
			$message = 'ชื่อผู้ใช้นี้ถูกใช้แล้ว ';
			$this -> form_validation -> set_message('check_source_exit', $message);
			return FALSE;
		}
	}

	function destination_manager() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$data['destinations'] = $this -> destination_model -> getAllDestination();

				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('user/destination_view', $data);
				$this -> load -> view('include/footer');
				break;
			case "admin" :
				redirect('admin', 'refesh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function destination_add() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$data['destinations'] = $this -> destination_model -> getAllDestination();

				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('user/destination_add', $data);
				$this -> load -> view('include/footer');
				break;
			case "admin" :
				redirect('admin', 'refesh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function edit_profile() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :

				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('user/user_profile_view');
				$this -> load -> view('include/footer');
				break;
			case "admin" :
				redirect('admin', 'refesh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function check_password() {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('txtNewPassword', 'รหัสผ่าน', 'trim|required|alpha_numeric|min_length[6]|max_length[12]|xss_clean');
		$this -> form_validation -> set_rules('txtReNewPassword', 'รหัสผ่าน', 'trim|required|alpha_numeric|min_length[6]|max_length[12]|xss_clean|callback_check_new_password');
		$this -> form_validation -> set_rules('txtPassword', 'รหัสผ่าน', 'trim|required|xss_clean|callback_check_user_password');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('user/profile');
		} else {
			$user_session = $this -> session -> userdata('logged_in');
			$new_password = $this -> input -> post('txtNewPassword');

			$this -> user_model -> updatePassword($user_session['username'], $new_password);

			$this -> session -> set_flashdata('success_msg', 'บันทึกรหัสผ่านใหม่สำเร็จ');

			redirect('user/profile');
		}
	}

	function check_user_password($password) {
		$user_session = $this -> session -> userdata('logged_in');

		$result = $this -> user_model -> login($user_session['username'], $password);

		if ($result) {
			return TRUE;
		} else {
			$this -> form_validation -> set_message('check_user_password', 'รหัสผ่านไม่ถูกต้อง');
			return FALSE;
		}
	}

	function check_new_password($re_new_password) {
		$password = $this -> input -> post('txtPassword');
		$new_password = $this -> input -> post('txtNewPassword');
		if ($re_new_password == $new_password) {
			if ($new_password == $password) {
				$this -> form_validation -> set_message('check_new_password', 'รหัสผ่านใหม่ต้องไม่ตรงกับรหัสผ่านเดิม');
				return FALSE;
			} else {
				return TRUE;
			}
		} else {
			$this -> form_validation -> set_message('check_new_password', 'รหัสผ่านใหม่ไม่ตรงกัน');
			return FALSE;
		}
	}

}
?>