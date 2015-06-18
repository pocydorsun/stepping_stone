<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
session_start();
class User_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$this -> load -> model('user_model', '', TRUE);
				$this -> load -> model('source_model', '', TRUE);
				$this -> load -> model('destination_model', '', TRUE);
				$this -> load -> model('cost_model', '', TRUE);
				$this -> load -> model('plan_model', '', TRUE);
				break;
			case "admin" :
				redirect('admin', 'refresh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function index() {

		redirect('user/plan', 'refresh');
		break;
	}

	// PLAN
	function plan_manager() {

		$data['plans'] = $this -> plan_model -> getAllplan();

		$this -> load -> helper('form');
		$this -> load -> view('include/header');
		$this -> load -> view('user/plan_view', $data);
		$this -> load -> view('include/footer');
	}

	function plan_send($id) {

		$data['plans'] = $this -> plan_model -> statusSend($id);

		$this -> session -> set_flashdata('success_msg', 'ส่งแผนแผนสำเร็จ');
		redirect('user/plan');
	}

	 function create_plan() {
 
		 $data['sources'] = $this -> source_model -> getAll();
		 $data['destinations'] = $this -> destination_model -> getAll();
		 $data['costs'] = $this -> cost_model -> getAllCostWithOutName();

		 $this -> load -> helper('form');
		 $this -> load -> view('include/header');
		 $this -> load -> view('user/plan_create', $data);
		 $this -> load -> view('include/footer');
	 }

	 function add_plan() {
 
		 $this -> load -> library('form_validation');
		 $this -> form_validation -> set_rules('txtPlan', 'เป้าหมาย', 'trim|required|callback_check_plan_exit');
 
		 if ($this -> form_validation -> run() == FALSE) {
			 $this -> session -> set_flashdata('sourceTable', $this -> input -> post('txtSourceTable'));
			 $this -> session -> set_flashdata('destinationTable', $this -> input -> post('txtDestinationTable'));
			 $this -> session -> set_flashdata('myStep', $this -> input -> post('txtMyStep'));
			 $this -> session -> set_flashdata('costOfPlan', $this -> input -> post('txtCostOfPlan'));
			 $this -> session -> set_flashdata('error_msg', validation_errors());
			 redirect('user/create');
		 } else {
 
			 $this -> session -> set_flashdata('success_msg', 'เพิ่มชื่อแผนสำเร็จ');
 
			 redirect('user/plan');
		 }
	 }
	
		 function check_plan_exit($plan) {
		 $sourceTable = $this -> input -> post('txtSourceTable');
		 $destinationTable = $this -> input -> post('txtDestinationTable');
		 $costOfPlan = $this -> input -> post('txtCostOfPlan');

		 $result = $this -> plan_model -> addPlan($plan, $sourceTable, $destinationTable, $costOfPlan);
 
		 if ($result) {
			 return TRUE;
		 } else {
			 $message = 'มีชื่อนี้แล้ว ';
			 $this -> form_validation -> set_message('check_plan_exit', $message);
			 return FALSE;
		 }
	 }
	
	function add_plan2() {

		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('txtPlan', 'เป้าหมาย', 'trim|required|callback_check_plan_exit2');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('sourceTable', $this -> input -> post('txtSourceTable'));
			$this -> session -> set_flashdata('destinationTable', $this -> input -> post('txtDestinationTable'));
			$this -> session -> set_flashdata('costOfPlan', $this -> input -> post('txtCostOfPlan'));
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('user/create');
		} else {

			$this -> session -> set_flashdata('success_msg', 'เพิ่มชื่อแผนสำเร็จ');

			redirect('user/plan');
		}
	}

	function create_plan2() {
		
		$data['sources'] = $this -> source_model -> getAll();
		$data['destinations'] = $this -> destination_model -> getAll();
		$data['costs'] = $this -> cost_model -> getAllCostWithOutName();
		
		$this -> load -> helper('form');
		$this -> load -> view('include/header');
		$this -> load -> view('user/plan_create2', $data);
		$this -> load -> view('include/footer');
	}
	
	function check_plan_exit2($plan) {
		$sourceTable = $this -> input -> post('txtSourceTable');
		$destinationTable = $this -> input -> post('txtDestinationTable');
		$costOfPlan = $this -> input -> post('txtCostOfPlan');

		$result = $this -> plan_model -> addPlan2($plan, $sourceTable, $destinationTable, $costOfPlan);

		if ($result) {
			return TRUE;
		} else {
			$message = 'มีชื่อนี้แล้ว ';
			$this -> form_validation -> set_message('check_plan_exit2', $message);
			return FALSE;
		}
	}

	function plan_edit($id) {

		$data['sources'] = $this -> source_model -> getAll();
		$data['destinations'] = $this -> destination_model -> getAll();
		$data['costs'] = $this -> cost_model -> getAllCostWithOutName();

		$data["plan"] = $this -> plan_model -> getPlan($id);

		$this -> load -> helper('form');
		$this -> load -> view('include/header');
		$this -> load -> view('user/plan_edit', $data);
		$this -> load -> view('include/footer');
	}

	function update_plan($id) {
		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('txtPlan', 'เป้าหมาย', 'trim|required|callback_check_updateplan_exit[' . $id . ']');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('sourceTable', $this -> input -> post('txtSourceTable'));
			$this -> session -> set_flashdata('destinationTable', $this -> input -> post('txtDestinationTable'));
			$this -> session -> set_flashdata('myStep', $this -> input -> post('txtMyStep'));
			$this -> session -> set_flashdata('costOfPlan', $this -> input -> post('txtCostOfPlan'));
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('user/plan_edit/' . $id);
		} else {

			$this -> session -> set_flashdata('success_msg', 'เพิ่มชื่อแผนสำเร็จ');

			redirect('user/plan_edit/' . $id);
		}
	}

	function check_updateplan_exit($plan, $id) {

		$name1 = $plan;
		$name2 = $this -> input -> post('txtOldNameOfPlan');
		$sourceTable = $this -> input -> post('txtSourceTable');
		$destinationTable = $this -> input -> post('txtDestinationTable');
		$costOfPlan = $this -> input -> post('txtCostOfPlan');

		if ($name1 == $name2) {
			$result = $this -> plan_model -> updatePlan($id, "", $sourceTable, $destinationTable, $costOfPlan);
		} else {
			$result = $this -> plan_model -> updatePlan($id, $plan, $sourceTable, $destinationTable, $costOfPlan);
		}

		if ($result) {
			return TRUE;
		} else {
			$message = 'มีชื่อนี้แล้ว ';
			$this -> form_validation -> set_message('check_updateplan_exit', $message);
			return FALSE;
		}
	}

	function remove_plan($id) {

		$this -> plan_model -> removePlan($id);

		$this -> session -> set_flashdata('success_msg', 'ลบแผนสำเร็จ');
		redirect('user/plan');
	}

	// TARGET
	function target_manager() {

		$data['sources'] = $this -> source_model -> getAll();
		$data['destinations'] = $this -> destination_model -> getAll();

		$this -> load -> helper('form');
		$this -> load -> view('include/header');
		$this -> load -> view('user/target_view', $data);
		$this -> load -> view('include/footer');
	}

	function add_target() {

		$this -> load -> library('form_validation');
		$typeSource = $this -> input -> post('typeSource');
		$typeDestination = $this -> input -> post('typeDestination');
		$y = $this -> input -> post('y');

		if ($typeSource && $typeDestination) {
			$this -> form_validation -> set_rules('txtTarget', 'เป้าหมาย', 'trim|required|callback_check_target_exit');
		} else if ($typeSource) {
			$this -> form_validation -> set_rules('txtTarget', 'เป้าหมาย', 'trim|required|callback_check_source_exit');
		} else if ($typeDestination) {
			$this -> form_validation -> set_rules('txtTarget', 'เป้าหมาย', 'trim|required|callback_check_destination_exit');
		} else {
			$this -> session -> set_flashdata('y', $y);
			$this -> session -> set_flashdata('error_msg', 'กรุณาเลือกประเภทของเป้าหมาย');
			redirect('user/target');
		}

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('user/target');
		} else {

			$this -> session -> set_flashdata('success_msg', 'เพิ่มเป้าหมายสำเร็จ');

			redirect('user/target');
		}
	}

	function check_target_exit($target) {

		$result = $this -> source_model -> addSource($target);
		$result2 = $this -> destination_model -> addDestination($target);

		if ($result || $result2) {
			return TRUE;
		} else {
			$message = 'มีข้อมูลเป้าหมายนี้แล้ว ';
			$this -> form_validation -> set_message('check_target_exit', $message);
			return FALSE;
		}
	}

	function check_source_exit($target) {

		$result = $this -> source_model -> addSource($target);

		if ($result) {
			return TRUE;
		} else {
			$message = 'มีข้อมูลเป้าหมายนี้แล้ว ';
			$this -> form_validation -> set_message('check_source_exit', $message);
			return FALSE;
		}
	}

	function check_destination_exit($target) {

		$result = $this -> destination_model -> addDestination($target);

		if ($result) {
			return TRUE;
		} else {
			$message = 'มีข้อมูลเป้าหมายนี้แล้ว ';
			$this -> form_validation -> set_message('check_destination_exit', $message);
			return FALSE;
		}
	}

	function edit_source($id) {

		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('txtTargetName', 'เป้าหมาย', 'trim|required|callback_update_source[' . $id . ']');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('user/target');
		} else {
			$this -> session -> set_flashdata('success_msg', 'แก้ไขเป้าหมายสำเร็จ');
			redirect('user/target');
		}
	}

	function update_source($target_name, $id) {

		$result = $this -> source_model -> editSource($id, $target_name);

		if ($result) {
			return TRUE;
		} else {
			$message = 'มีข้อมูลเป้าหมายนี้แล้ว ';
			$this -> form_validation -> set_message('update_source', $message);
			return FALSE;
		}
	}

	function edit_destination($id) {

		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('txtTargetName', 'เป้าหมาย', 'trim|required|callback_update_destination[' . $id . ']');
		$this -> session -> set_flashdata('y', 'active');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('user/target');
		} else {

			$this -> session -> set_flashdata('success_msg', 'แก้ไขเป้าหมายสำเร็จ');

			redirect('user/target');
		}
	}

	function update_destination($target_name, $id) {

		$result = $this -> destination_model -> editDestination($id, $target_name);

		if ($result) {
			return TRUE;
		} else {
			$message = 'มีข้อมูลเป้าหมายนี้แล้ว ';
			$this -> form_validation -> set_message('update_destination', $message);
			return FALSE;
		}
	}

	function remove_source($id) {

		$this -> source_model -> removeSource($id);

		$this -> session -> set_flashdata('success_msg', 'ลบเป้าหมายสำเร็จ');
		redirect('user/target');
	}

	function remove_destination($id) {

		$this -> destination_model -> removeDestination($id);
		$this -> session -> set_flashdata('y', 'active');

		$this -> session -> set_flashdata('success_msg', 'ลบเป้าหมายสำเร็จ');
		redirect('user/target');
	}

	// COST
	function cost_manager() {

		$data['sources'] = $this -> source_model -> getAll();
		$data['destinations'] = $this -> destination_model -> getAll();
		$data['costs'] = $this -> cost_model -> getAllCost();

		$this -> load -> helper('form');
		$this -> load -> view('include/header');
		$this -> load -> view('user/cost_view', $data);
		$this -> load -> view('include/footer');
	}

	function save_cost() {

		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('selectSource', 'ต้นทาง', 'trim|required|xss_clean');
		$this -> form_validation -> set_rules('selectDestination', 'ปลายทาง', 'trim|required|xss_clean');
		$this -> form_validation -> set_rules('inputCost', 'ค่าขนส่ง', 'trim|required|integer|xss_clean|callback_verify_cost');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('user/cost');
		} else {
			$this -> session -> set_flashdata('success_msg', "บันทึกสำเร็จ");
			redirect('user/cost');
		}

	}

	function verify_cost($inputCost) {
		$str1 = $this -> input -> post('selectSource');
		$str2 = $this -> input -> post('selectDestination');

		$data1 = explode(":::", $str1);
		$data2 = explode(":::", $str2);

		if ($data1[1] == $data2[1]) {
			$this -> form_validation -> set_message('verify_cost', 'ต้นทางปลายทางต้องไม่ซ้ำกัน');
			return FALSE;
		} else {
			$result = $this -> cost_model -> addCost($data1[0], $data2[0], $inputCost);

			if ($result) {
				return TRUE;
			} else {
				$this -> form_validation -> set_message('verify_cost', 'ต้นทางปลายทางนี้ถูกบันทึกไปแล้ว');
				return FALSE;
			}
		}
	}

	function edit_cost($id) {

		$this -> load -> library('form_validation');
		$this -> form_validation -> set_rules('txtCost', 'ค่าขนส่ง', 'trim|required|numeric|callback_update_cost[' . $id . ']');

		if ($this -> form_validation -> run() == FALSE) {
			$this -> session -> set_flashdata('error_msg', validation_errors());
			redirect('user/cost');
		} else {

			$this -> session -> set_flashdata('success_msg', 'แก้ไขเป้าหมายสำเร็จ');

			redirect('user/cost');
		}
	}

	function update_cost($cost, $id) {
		$this -> cost_model -> editCost($id, $cost);
		return TRUE;
	}

	function remove_cost($id) {

		$this -> cost_model -> removeCost($id);

		$this -> session -> set_flashdata('success_msg', 'ลบเป้าหมายสำเร็จ');
		redirect('user/cost');
	}

	// USER PROFILE
	function edit_profile() {

		$user_session = $this -> session -> userdata('logged_in');

		$user_id = $user_session['id'];

		$data['name'] = $this -> user_model -> getName($user_id);

		$this -> load -> helper('form');
		$this -> load -> view('include/header');
		$this -> load -> view('user/user_profile_view', $data);
		$this -> load -> view('include/footer');
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
			$this -> form_validation -> set_message('check_update_name', 'ระบบทำการบันทึกล้มเหลว กรุณาลองใหม่อีกครั้ง');
			return FALSE;
		}
	}

}
?>
