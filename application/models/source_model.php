<?php
Class Source_Model extends CI_Model {
	
	function getAllSource() {
		$this -> db ->select('id, source_name');
		$this -> db -> from('source');
		$query = $this -> db -> get();

		return $query -> result();
	}
}
?>