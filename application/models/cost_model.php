<?php
Class Cost_Model extends CI_Model {
	
	function getAllCost() {
		// $this -> db ->select('target_id1, target_id2, cost');
		// $this -> db -> from('cost');
		// $query = $this -> db -> get();
// 
		// return $query -> result();
		
		$this->db->select('*');
		$this->db->from('cost');
		$this->db->join('target', 'cost.target_id1 = target.id', 'left');
		$this->db->join('target', 'cost.target_id2 = target.id', 'left');
		
		$query = $this->db->get();
		
		print_r($query->result());
		exit;
	}
	
	function addCost($id1, $id2, $cost) {

		$this -> db -> from('cost');
		$this -> db -> where('target_id1', $id1);
		$this -> db -> where('target_id2', $id2);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('target_id1' => $id1, 'target_id2' => $id2, 'cost' => $cost);
			$query = $this -> db -> insert('cost', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}
	
}
?>