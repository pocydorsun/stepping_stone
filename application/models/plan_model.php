<?php
Class Plan_Model extends CI_Model {

	function getAllPlan() {
		$this -> db -> select('id, plan_name');
		$this -> db -> from('plan');
		$query = $this -> db -> get();

		return $query -> result();
	}

	function statusSend($id) {

		$data = array('plan_status' => 1);
		$this -> db -> where('id', $id);
		$this -> db -> update('plan', $data);

	}

	function addPlan($planname, $sourceTable, $destinationTable) {

		$this -> db -> from('plan');
		$this -> db -> where('plan_name', $planname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array(
						'plan_name' => $planname,
						'plan_source' => $souceTable,
						'plan_destination' => $destinationTable
					);
			$query = $this -> db -> insert('plan', $data);
			return TRUE;
		} else {
			return FALSE;
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
