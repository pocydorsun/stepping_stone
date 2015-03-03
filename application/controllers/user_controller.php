<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class User_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this -> load -> model('user_model', '', TRUE);
		$this -> load -> model('target_model', '', TRUE);
	}

	function index() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$data['targets'] = $this -> target_model -> getAllTarget();

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

	function target_manager() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$data['targets'] = $this -> target_model -> getAllTarget();

				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('user/target_view', $data);
				$this -> load -> view('include/footer');
				break;
			case "admin" :
				redirect('admin', 'refesh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function add_target() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$this -> load -> library('form_validation');
				$this -> form_validation -> set_rules('txtTarget', 'เป้าหมาย', 'trim|required|callback_check_target_exit');

				if ($this -> form_validation -> run() == FALSE) {
					$this -> session -> set_flashdata('error_msg', validation_errors());
					redirect('user/target');
				} else {

					$this -> session -> set_flashdata('success_msg', 'เพิ่มเป้าหมายสำเร็จ');

					redirect('user/target');
				}
				break;
			case "admin" :
				redirect('admin', 'refesh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function check_target_exit($targetname) {

		$result = $this -> target_model -> addTarget($targetname);

		if ($result) {
			return TRUE;
		} else {
			$message = 'มีข้อมูลเป้าหมายนี้แล้ว ';
			$this -> form_validation -> set_message('check_target_exit', $message);
			return FALSE;
		}
	}

	function edit_target($id) {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$this -> load -> library('form_validation');
				$this -> form_validation -> set_rules('txtTargetName', 'เป้าหมาย', 'trim|required|callback_update_target[' . $id . ']');

				if ($this -> form_validation -> run() == FALSE) {
					$this -> session -> set_flashdata('error_msg', validation_errors());
					redirect('user/target');
				} else {

					$this -> session -> set_flashdata('success_msg', 'แก้ไขเป้าหมายสำเร็จ');

					redirect('user/target');
				}
			case "admin" :
				redirect('admin', 'refresh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function update_target($target_name, $id) {
		$result = $this -> target_model -> editTarget($id, $target_name);
		
		if ($result) {
			return TRUE;
		} else {
			$message = 'มีข้อมูลเป้าหมายนี้แล้ว ';
			$this -> form_validation -> set_message('update_target', $message);
			return FALSE;
		}
	}

	function remove_target($id) {

		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$this -> target_model -> removeTarget($id);

				$this -> session -> set_flashdata('success_msg', 'ลบเป้าหมายสำเร็จ');

				redirect('user/target');
				break;

			case "admin" :
				redirect('admin', 'refresh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function edit_profile() {
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$user_session = $this -> session -> userdata('logged_in');

				$user_id = $user_session['id'];

				$data['name'] = $this -> user_model -> getName($user_id);

				$this -> load -> helper('form');
				$this -> load -> view('include/header');
				$this -> load -> view('user/user_profile_view', $data);
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

	function change_name() {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('txtFirstname', 'ชื่อ', 'trim|required|xss_clean');
		$this -> form_validation -> set_rules('txtLastname', 'นามสกุล', 'trim|required|xss_clean|callback_update_name');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('user/profile');
		} else {

			$this -> session -> set_flashdata('success_msg', 'บันทึกสำเร็จ');

			redirect('user/profile');
		}
	}

	function update_name($lastname) {
		$user_session = $this -> session -> userdata('logged_in');

		$user_id = $user_session['id'];

		$firstname = $this -> input -> post('txtFirstname');

		$result = $this -> user_model -> updateName($user_id, $firstname, $lastname);

		if ($result) {
			return TRUE;
		} else {
			$this -> form_validation -> set_message('check_update_namae', 'ระบบทำการบันทึกล้มเหลว กรุณาลองใหม่อีกครั้ง');
			return FALSE;
		}
	}

}
?>