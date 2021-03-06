<?php
Class User_model extends CI_Model {

	function login($username, $password) {
		$this -> db -> select('id, username, password, status');
		$this -> db -> from('users');
		$this -> db -> where('username', $username);
		$this -> db -> where('password', MD5($password));
		$this -> db -> where('user_status', 'ใช้งานอยู่');
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if ($query -> num_rows() == 1) {
			return $query -> result();
		} else {
			return FALSE;
		}
	}

	function getAllUser() {
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('status', 'user');
		$query = $this -> db -> get();

		return $query -> result();
	}

	function addUser($username, $password, $firstname, $lastname) {
		
		$this -> db -> from('users');
		$this -> db -> where('username', $username);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {
			$data = array('firstname' => $firstname, 'lastname' => $lastname, 'username' => $username, 'password' => md5($password),'user_status' => 'ใช้งานอยู่' );
			$query = $this -> db -> insert('users', $data);
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function removeUser($id) {
		
		$data = array('user_status' => 'ยกเลิกการใช้งาน');
		$this -> db -> where('id', $id);
		$this -> db -> update('users', $data);
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

	function getName($user_id) {
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('id', $user_id);
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if ($query -> num_rows() == 1) {
			return $query -> result_array();
		} else {
			return FALSE;
		}
	}

	function updateName($user_id, $firstname, $lastname, $password) {
		if ($password == "") {
			$data = array('firstname' => $firstname, 'lastname' => $lastname);

		} else {
			$data = array('firstname' => $firstname, 'lastname' => $lastname, 'password' => md5($password));
		}
		$this -> db -> where('id', $user_id);
		$query = $this -> db -> update('users', $data);

		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
?>