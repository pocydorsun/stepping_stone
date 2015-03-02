<?php
Class Target_Model extends CI_Model {
	
	function getAllTarget() {
		$this -> db ->select('id, target_name');
		$this -> db -> from('target');
		$query = $this -> db -> get();

		return $query -> result();
	}
	
	function addTarget($targetname) {

		$this -> db -> from('target');
		$this -> db -> where('target_name', $targetname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('target_name' => $targetname,);
			$query = $this -> db -> insert('target', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}
	
	function removeTarget($id) {
		$this -> db -> where('id', $id);
		$query = $this -> db -> delete('target');

		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>