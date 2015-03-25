<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class Admin_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('user_model', '', TRUE);
		$this -> load -> model('plan_model', '', TRUE);

	}

	function index() {

		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user', 'refresh');
				break;
			case "admin" :
				$data['users'] = $this -> user_model -> getAllUser();

				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('admin/home_view', $data);
				$this -> load -> view('include/footer');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function add_user() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user', 'refresh');
				break;
			case "admin" :
				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('admin/add_user');
				$this -> load -> view('include/footer');
				break;
			default :
				redirect('login', 'refresh');
		}

	}

	function add_new_user() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user', 'refresh');
				break;
			case "admin" :
				$this -> load -> library('form_validation');
				$this -> form_validation -> set_rules('txtFirstname', 'ชื่อ', 'trim|required|xss_clean');
				$this -> form_validation -> set_rules('txtLastname', 'นามสกุล', 'trim|required|xss_clean|callback_update_name');
				$this -> form_validation -> set_rules('txtUsername', 'ชื่อผู้ใช้', 'trim|required|alpha_numeric|min_length[6]|max_length[12]|xss_clean|');
				$this -> form_validation -> set_rules('txtPasswod', 'รหัสผ่าน', 'trim|required|alpha_numeric|min_length[6]|max_length[12]|xss_clean|callback_check_username_exit');
				if ($this -> form_validation -> run() == FALSE) {
					$this -> session -> set_flashdata('error_msg', validation_errors());
					redirect('admin');
				} else {

					$this -> session -> set_flashdata('success_msg', 'เพิ่มผู้ใช้สำเร็จ');

					redirect('admin');
				}
				break;
			default :
				redirect('login', 'refresh');
		}

	}

	function check_username_exit($username) {

		$result = $this -> user_model -> addUser($username);

		if ($result) {
			return TRUE;
		} else {
			$message = 'ชื่อผู้ใช้นี้ถูกใช้แล้ว ';
			$this -> form_validation -> set_message('check_username_exit', $message);
			return FALSE;
		}
	}

	function remove_user($id) {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user', 'refresh');
				break;
			case "admin" :
				$this -> user_model -> removeUser($id);

				$this -> session -> set_flashdata('success_msg', 'ลบผู้ใช้สำเร็จ');

				redirect('admin');

				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function change_password() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user', 'refresh');
				break;
			case "admin" :
				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('admin/change_password_view');
				$this -> load -> view('include/footer');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function check_password() {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('txtNewPassword', 'รหัสผ่านใหม่', 'trim|required|alpha_numeric|min_length[6]|max_length[12]|xss_clean');
		$this -> form_validation -> set_rules('txtReNewPassword', 'ยืนยันรหัสผ่านใหม่', 'trim|required|alpha_numeric|min_length[6]|max_length[12]|xss_clean|callback_check_new_password');
		$this -> form_validation -> set_rules('txtPassword', 'รหัสผ่าน', 'trim|required|xss_clean|callback_check_admin_password');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('admin/change_password');
		} else {
			$user_session = $this -> session -> userdata('logged_in');
			$new_password = $this -> input -> post('txtNewPassword');

			$this -> user_model -> updatePassword($user_session['username'], $new_password);

			$this -> session -> set_flashdata('success_msg', 'บันทึกรหัสผ่านใหม่สำเร็จ');

			redirect('admin/change_password');
		}
	}

	function check_admin_password($password) {
		$user_session = $this -> session -> userdata('logged_in');

		$result = $this -> user_model -> login($user_session['username'], $password);

		if ($result) {
			return TRUE;
		} else {
			$this -> form_validation -> set_message('check_admin_password', 'รหัสผ่านไม่ถูกต้อง');
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

	function approve() {

		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user', 'refresh');
				break;
			case "admin" :
				$data['plans'] = $this -> plan_model -> getAllPlanSend();
				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('admin/approve_view', $data);
				$this -> load -> view('include/footer');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function plan_approve($id) {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user', 'refresh');
				break;
			case "admin" :
				$data['plans'] = $this -> plan_model -> statusApprove($id);

				$this -> session -> set_flashdata('success_msg', 'อนุมัติแผน');
				redirect('admin/approve');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function plan_not_approve($id) {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				redirect('user', 'refresh');
				break;
			case "admin" :
				$data['plans'] = $this -> plan_model -> statusNotApprove($id);

				$this -> session -> set_flashdata('success_msg', 'ไม่อนุมัติแผน');
				redirect('admin/approve');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

}
?>
