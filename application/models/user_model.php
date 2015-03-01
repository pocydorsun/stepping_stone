<?php
Class User_model extends CI_Model {

	function login($username, $password) {
		$this -> db -> select('id, username, password,status');
		$this -> db -> from('users');
		$this -> db -> where('username', $username);
		$this -> db -> where('password', MD5($password));
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if ($query -> num_rows() == 1) {
			return $query -> result();
		} else {
			return FALSE;
		}
	}

	function getAllUser() {
		$this -> db -> select('id, username');
		$this -> db -> from('users');
		$this -> db -> where('status', 'user');
		$query = $this -> db -> get();

		return $query -> result();
	}

	function addUser($username) {

		$this -> db -> from('users');
		$this -> db -> where('username', $username);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('username' => $username, 'password' => md5('12345678'));
			$query = $this -> db -> insert('users', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function removeUser($id) {
		$this -> db -> where('id', $id);
		$query = $this -> db -> delete('users');

		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function updatePassword($username, $password) {
		$data = array('password' => md5($password));

		$this -> db -> where('username', $username);
		$query = $this -> db -> update('users', $data);
		
		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>