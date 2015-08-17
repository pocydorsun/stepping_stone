<?php
Class Destination_Model extends CI_Model {

	function getAll() {
		$this -> db -> select('*');
		$this -> db -> from('destination');
				$this -> db -> where('destination_status', 'ใช้งานอยู่');
		$query = $this -> db -> get();

		return $query -> result();
	}

	function addDestination($targetname) {

		$this -> db -> from('destination');
		$this -> db -> where('destination_name', $targetname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('destination_name' => $targetname, 'destination_status' => 'ใช้งานอยู่');
			$query = $this -> db -> insert('destination', $data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function editDestination($id, $target_name) {

		$this -> db -> from('destination');
		$this -> db -> where('destination_name', $target_name);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('destination_name' => $target_name);
			$this -> db -> where('id', $id);
			$this -> db -> update('destination', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function removeDestination($id) {

		$data = array('destination_status' => 'ยกเลิกการใช้งาน');
		$this -> db -> where('id', $id);
		$this -> db -> update('destination', $data);
	}
}
?>
