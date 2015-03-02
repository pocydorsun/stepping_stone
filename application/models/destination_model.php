<?php
Class Destination_Model extends CI_Model {
	
	function getAllDestination() {
		$this -> db ->select('id, destination_name');
		$this -> db -> from('destination');
		$query = $this -> db -> get();

		return $query -> result();
	}
	
	function addDestination($destinationname) {

		$this -> db -> from('destination');
		$this -> db -> where('destination_name', $destinationname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('destination_name' => $destinationname,);
			$query = $this -> db -> insert('destination', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}
}
?>