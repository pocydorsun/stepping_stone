<?php
Class Cost_Model extends CI_Model {

	function getAllCost() {

		$this->db->select('*');
		$this->db->from('cost');
		$this->db->join('source', 'cost.source_id = source.id', 'left');
		$this->db->join('destination', 'cost.destination_id = destination.id', 'left');

		$query = $this->db->get();

		return $query -> result();
	}

	function getAllCostWithOutName() {

		$this->db->select('*');
		$this->db->from('cost');

		$query = $this->db->get();

		return $query -> result();
	}

	function addCost($id1, $id2, $cost) {

		if ($id1 > $id2) {
			$reId1 = $id2;
			$reId2 = $id1;
		} else {
			$reId1 = $id1;
			$reId2 = $id2;
		}

		$this -> db -> from('cost');
		$this -> db -> where('source_id', $reId1);
		$this -> db -> where('destination_id', $reId2);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('source_id' => $reId1, 'destination_id' => $reId2, 'cost' => $cost);
			$query = $this -> db -> insert('cost', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function editCost($id, $cost) {

			$data = array('cost' => $cost);
			$this -> db -> where('cost_id', $id);
			$this -> db -> update('cost', $data);

	}


	function removeCost($id) {
		$this -> db -> where('cost_id', $id);
		$query = $this -> db -> delete('cost');

		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>
