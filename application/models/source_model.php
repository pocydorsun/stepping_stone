<?php
Class Source_Model extends CI_Model {

	function getAll() {
		$this -> db -> select('*');
		$this -> db -> from('source');
		$this -> db -> where('source_status', 'ใช้งานอยู่');
		$query = $this -> db -> get();

		return $query -> result();
	}

  function addSource($targetname) {

		$this -> db -> from('source');
		$this -> db -> where('source_name', $targetname);
		$this -> db -> where('source_status', 'ใช้งานอยู่');
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('source_name' => $targetname, 'source_status' => 'ใช้งานอยู่');
			$query = $this -> db -> insert('source', $data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

  function editSource($id, $target_name) {

		$this -> db -> from('source');
		$this -> db -> where('source_name', $target_name);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('source_name' => $target_name);
			$this -> db -> where('id', $id);
			$this -> db -> update('source', $data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

  function removeSource($id) {
  	
		$data = array('source_status' => 'ยกเลิกการใช้งาน');
		$this -> db -> where('id', $id);
		$this -> db -> update('source', $data);
	}
}
?>
