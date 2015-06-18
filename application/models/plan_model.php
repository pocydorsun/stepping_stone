<?php
Class Plan_Model extends CI_Model {

	function getAllPlan() {
		$this -> db -> select('id, plan_name');
		$this -> db -> from('plan');
		$query = $this -> db -> get();

		return $query -> result();
	}

	function getPlan($id) {
		$this -> db -> select('*');
		$this -> db -> from('plan');
		$this -> db -> where('id', $id);
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if ($query -> num_rows() == 1) {
			return $query -> result_array();
		} else {
			return FALSE;
		}
	}

	function statusSend($id) {

		$data = array('plan_status' => 1);
		$this -> db -> where('id', $id);
		$this -> db -> update('plan', $data);

	}

	function addPlan($planname, $sourceTable, $destinationTable, $costOfPlan) {

		$this -> db -> from('plan');
		$this -> db -> where('plan_name', $planname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('plan_name' => $planname, 'plan_source' => $sourceTable, 'plan_destination' => $destinationTable, 'plan_cost' => $costOfPlan);
			$query = $this -> db -> insert('plan', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}
	
	function addPlan2($planname, $sourceTable, $destinationTable, $costOfPlan) {

		$this -> db -> from('plan');
		$this -> db -> where('plan_name', $planname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('plan_name' => $planname, 'plan_source' => $sourceTable, 'plan_destination' => $destinationTable, 'plan_cost' => $costOfPlan);
			$query = $this -> db -> insert('plan', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function updatePlan($id, $planname, $sourceTable, $destinationTable, $costOfPlan) {

		if ($planname == "") {
			$data = array('plan_source' => $sourceTable, 'plan_destination' => $destinationTable, 'plan_cost' => $costOfPlan);
			$this -> db -> where('id', $id);
			$query = $this -> db -> update('plan', $data);
			if ($query) {
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			$this -> db -> from('plan');
			$this -> db -> where('plan_name', $planname);
			$this -> db -> limit(1);
	
			$query = $this -> db -> get();
			$rows = $query -> num_rows();
	
			if (!$rows) {
				$data = array('plan_name' => $planname, 'plan_source' => $sourceTable, 'plan_destination' => $destinationTable, 'plan_cost' => $costOfPlan);
				$this -> db -> where('id', $id);
				$query = $this -> db -> update('plan', $data);
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}
	
	function removePlan($id) {
		$this -> db -> where('id', $id);
		$query = $this -> db -> delete('plan');

		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function getAllPlanSend() {
		$this -> db -> select('*');
		$this -> db -> from('plan');
		$this -> db -> where('plan_status', 1);
		$query = $this -> db -> get();

		return $query -> result();
	}

	function statusNotApprove($id) {

		$data = array('plan_status' => 2);
		$this -> db -> where('id', $id);
		$this -> db -> update('plan', $data);

	}

	function statusApprove($id) {

		$data = array('plan_status' => 3);
		$this -> db -> where('id', $id);
		$this -> db -> update('plan', $data);

	}

}
?>
