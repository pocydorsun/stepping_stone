<?php
Class Target_Model extends CI_Model {

	function getAllTarget() {
		$this -> db -> select('id, source_name');
		$this -> db -> from('source');
		$query = $this -> db -> get();

		return $query -> result();
	}

	function addTarget($targetname) {

		$this -> db -> from('source');
		$this -> db -> where('source_name', $targetname);
		$this -> db -> from('destination');
		$this -> db -> where('destination_name', $targetname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('source_name' => $targetname);
			$query = $this -> db -> insert('source', $data);
			$data = array('destination_name' => $targetname);
			$query = $this -> db -> insert('destination', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function editTarget($id, $target_name) {

		$this -> db -> from('source');
		$this -> db -> where('source_name', $target_name);
		$this -> db -> from('destination');
		$this -> db -> where('destination_name', $target_name);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('source_name' => $target_name);
			$this -> db -> where('id', $id);
			$this -> db -> update('source', $data);
			$data = array('destination_name' => $target_name);
			$this -> db -> where('id', $id);
			$this -> db -> update('destination', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function removeTarget($id) {
		$this -> db -> where('id', $id);
		$query = $this -> db -> delete('source');
		$this -> db -> where('id', $id);
		$query = $this -> db -> delete('destination');

		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>