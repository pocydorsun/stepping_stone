<?php
Class Source_Model extends CI_Model {
	
	function getAllSource() {
		$this -> db ->select('id, source_name');
		$this -> db -> from('source');
		$query = $this -> db -> get();

		return $query -> result();
	}
	
	function addSource($sourcename) {

		$this -> db -> from('source');
		$this -> db -> where('source_name', $sourcename);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('source_name' => $sourcename,);
			$query = $this -> db -> insert('source', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}
}
?>