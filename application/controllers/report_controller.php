<?php
class Report_controller extends CI_Controller {

	function __construct() {
		parent::__construct();
		$user_session = $this -> session -> userdata('logged_in');

		switch ($user_session['status']) {
			case "user" :
				$this -> load -> model('plan_model', '', TRUE);
				$this -> load -> model('cargo_model', '', TRUE);
				$this -> load -> model('user_model', '', TRUE);
				$this -> load -> library("mpdf/mpdf");
				break;
			case "admin" :
				redirect('admin', 'refresh');
				break;
			default :
				redirect('login', 'refresh');
		}
	}

	function pdf($id) {
		
		$data['user'] = $this -> user_model -> getAdmin(1);
		$data['plan'] = $this -> plan_model -> getNamePlan($id);
		$data['cargo'] = $this -> cargo_model -> getCargoPlan($id);
		$name = $this -> plan_model -> getName($id);

		$html = $this -> load -> view("report", $data, TRUE);

		$mypdf = new mPDF('th');
		
		$mypdf -> AddPage();
		
		$mypdf -> useAdobeCJK = true;
		
		$mypdf -> WriteHTML($html);
		
		$mypdf -> Output($name, 'I');


	}

}
