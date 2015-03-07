<?php
Class Plan_Model extends CI_Model {

	function getAllPlan() {
		$this -> db -> select('id, plan_name');
		$this -> db -> from('plan');
		$query = $this -> db -> get();

		return $query -> result();
	}
	
	function addPlan($planname) {

		$this -> db -> from('plan');
		$this -> db -> where('plan_name', $planname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('plan_name' => $planname);
			$query = $this -> db -> insert('plan', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}
}
?>