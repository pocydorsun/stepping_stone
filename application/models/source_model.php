<?php
Class Source_Model extends CI_Model {

	function getAll() {
		$this -> db -> select('id, source_name');
		$this -> db -> from('source');
		$query = $this -> db -> get();

		return $query -> result();
	}

  function addSource($targetname) {

		$this -> db -> from('source');
		$this -> db -> where('source_name', $targetname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('source_name' => $targetname);
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
		$this -> db -> where('id', $id);
		$query = $this -> db -> delete('source');

		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>
