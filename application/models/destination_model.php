<?php
Class Destination_Model extends CI_Model {
	
	function getAllDestination() {
		$this -> db ->select('id, destination_name');
		$this -> db -> from('destination');
		$query = $this -> db -> get();

		return $query -> result();
	}
}
?>