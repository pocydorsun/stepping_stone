<?php
Class Plan_Model extends CI_Model {

	function getAllPlan() {
		$this -> db -> select('id, plan_name, plan_status');
		$this -> db -> from('transportation');
		$this -> db -> where('plan_status', "ยังไม่อนุมัติ");
		$this -> db -> or_where('plan_status', "อนุมัติ");
		$query = $this -> db -> get();

		return $query -> result();
	}

	function getPlan($id) {

		$this -> db -> select('*');
		$this -> db -> from('transportation');
		$this -> db -> where('id', $id);
		$this -> db -> limit(1);

		$data_transportation = $this -> db -> get();

		$this -> db -> select('*');
		$this -> db -> from('cost_of_plan');
		$this -> db -> where('transportation_id', $id);

		$data_costOfPlan = $this -> db -> get();

		$this -> db -> select('*');
		$this -> db -> from('list_plan');
		$this -> db -> where('transportation_id', $id);

		$data_listPlan = $this -> db -> get();

		// $array_listPlan แปลงจาก array เป็น string ในรูปแบบ Json
		$array_listPlan = $data_listPlan -> result_array();

		$string_planSource = "[";
		$string_planDestination = "[";
		$num_listPlan = count($array_listPlan);
		$i = 1;
		foreach ($array_listPlan as $key => $value) {
			if ($value['target_type'] === "1") {
				$string_planSource .= "{";
				$string_planSource .= "\"id\":\"".$value['target_id']."\",";
				$string_planSource .= "\"capacity\":".$value['capacity'];
				if($key+1 !== $num_listPlan) {
					if ($array_listPlan[$key+1]['target_type'] === "2") {
						$string_planSource .= "}";
					} else {
						$string_planSource .="},";
					}
				} else {
					$string_planSource .= "}";
				}
			} else {
				$string_planDestination .= "{";
				$string_planDestination .= "\"id\":\"".$value['target_id']."\",";
				$string_planDestination .= "\"capacity\":".$value['capacity'];
				if ($i === $num_listPlan) {
					$string_planDestination .= "}";
				} else {
					$string_planDestination .="},";
				}
			}
			$i = $i + 1;
		}
		$string_planSource .= "]";
		$string_planDestination .= "]";

		// $array_costOfPlan แปลงจาก array เป็น string ในรูปแบบ Json
		$array_costOfPlan = $data_costOfPlan -> result_array();

		$string_planCost = "[";
		$num_costOfPlan = count($array_costOfPlan);
		$i = 1;
		foreach ($array_costOfPlan as $key => $value) {
			$string_planCost .= "{";
			$string_planCost .= "\"source_id\":\"".$value['source_id']."\",";
			$string_planCost .= "\"destination_id\":\"".$value['destination_id']."\",";
			$string_planCost .= "\"cost\":".$value['cost'];
			if ($i === $num_costOfPlan) {
				$string_planCost .= "}";
			} else {
				$string_planCost .= "},";
				$i = $i + 1;
			}
		}
		$string_planCost .= "]";


		// จัดเตรียม $data ให้พร้อม เพื่อที่จะคืนให้ Controller ไปใช้ต่อไป ดังรูปแบบตัวอย่างผลลัพธ์ด้านล่าง
		$array_transportation = $data_transportation -> result_array();

		$data = array();
		$data[0] = array(
			'id' => $id,
			'plan_name' => $array_transportation[0]['plan_name'],
			'plan_source' => $string_planSource,
			'plan_destination' => $string_planDestination,
			'plan_cost' => $string_planCost,
			'plan_status' => $array_transportation[0]['plan_status'],
			'plan_date' => $array_transportation[0]['create_date']
		);

		
		return $data;
	}

	function statusSend($id) {

		$data = array('plan_status' => 'รออนุมัติ');
		$this -> db -> where('id', $id);
		$this -> db -> update('transportation', $data);

	}



	function addPlan($planname, $sourceTable, $destinationTable, $costOfPlan, $user_id) {


		$this -> db -> from('transportation');
		$this -> db -> where('plan_name', $planname);
		$this -> db -> limit(1);

		$query = $this -> db -> get();
		$rows = $query -> num_rows();

		if (!$rows) {


			// ต้องแปลงค่า string ที่เขียนในรูปแบบ json มาเป็น array ในแบบของ php
			$decode_sourceTable = json_decode($sourceTable, true);
			$decode_destinationTable = json_decode($destinationTable, true);

			// บันทึกข้อมูลลงตาราง transportation
			$data_transportation = array('plan_name' => $planname, 'number_of_source' => count($decode_sourceTable), 'number_of_destination' => count($decode_destinationTable), 'id_of_owner' => $user_id);
			$query = $this -> db -> insert('transportation', $data_transportation);

			// หาว่า id ของแผนที่เพิ่งสร้างคือ id อะไร
			$this -> db -> from('transportation');
			$this -> db -> where('plan_name', $planname);
			$this -> db -> limit(1);
			$query2 = $this -> db -> get();
			$data_thisPlan = $query2 -> result_array();
			$id_thisPlan = $data_thisPlan[0]['id'];

			// นำ sourceTable และ destinationTable ที่ทำการ Decode แล้วมาประกอบใส่ $data_listPlan เพื่อทำการบันทึกลงฐานข้อมูล ตาราง list_plan
			if ($decode_sourceTable || $decode_destinationTable) {
				$data_listPlan = array();
				$x = 1;
				foreach ($decode_sourceTable as $key => $value) {
					array_push($data_listPlan,
						array(
							'transportation_id' => $id_thisPlan,
							'target_id' => $value['id'],
							'target_type' => 1,
							'capacity' => $value['capacity'],
							'sequence' => $x
						)
					);
					$x = $x+1;
				}
				$x = 1;

				foreach ($decode_destinationTable as $key => $value) {
					array_push($data_listPlan,
						array(
							'transportation_id' => $id_thisPlan,
							'target_id' => $value['id'],
							'target_type' => 2,
							'capacity' => $value['capacity'],
							'sequence' => $x
						)
					);
					$x = $x+1;
				}
				$this -> db -> insert_batch('list_plan', $data_listPlan);
			}

			// ต้องแปลงค่า string ที่เขียนในรูปแบบ json มาเป็น array ในแบบของ php
			$decode_costOfPlan = json_decode($costOfPlan, true);

			// นำ $costOfPlan ที่ทำการ Decode แล้วมาประกอบใส่ $data_costOfPlan เพื่อทำการบันทึกลงฐานข้อมูล ตาราง cost_of_plan
			if (decode_costOfPlan) {
					$data_costOfPlan = array();
				foreach ($decode_costOfPlan as $key => $value) {
					array_push($data_costOfPlan,
						array(
							'transportation_id' => $id_thisPlan,
							'source_id' => $value['source_id'],
							'destination_id' => $value['destination_id'],
							'cost' => $value['cost']
						)
					);
				}
				$this -> db -> insert_batch('cost_of_plan', $data_costOfPlan);
			}
			return TRUE;
		} else {
			return FALSE;
		}

	}

	function updatePlan($id, $planname, $sourceTable, $destinationTable, $costOfPlan) {

		if ($planname === "") {
			// ลบข้อมูลในตาราง list_plan
			$this-> db -> where('transportation_id', $id);
			$this -> db -> delete('list_plan');

			// ลบข้อมูลในตาราง cost_of_plan
			$this-> db -> where('transportation_id', $id);
			$this -> db -> delete('cost_of_plan');

			// ต้องแปลงค่า string ที่เขียนในรูปแบบ json มาเป็น array ในแบบของ php
			$decode_sourceTable = json_decode($sourceTable, true);
			$decode_destinationTable = json_decode($destinationTable, true);

			// นำ sourceTable และ destinationTable ที่ทำการ Decode แล้วมาประกอบใส่ $data_listPlan เพื่อทำการบันทึกลงฐานข้อมูล ตาราง list_plan
			if ($decode_sourceTable || $decode_destinationTable) {
				$data_listPlan = array();
				$x = 1;
				foreach ($decode_sourceTable as $key => $value) {
					array_push($data_listPlan,
						array(
							'transportation_id' => $id,
							'target_id' => $value['id'],
							'target_type' => 1,
							'capacity' => $value['capacity'],
							'sequence' => $x
						)
					);
					$x = $x+1;
				}
				$x = 1;
				foreach ($decode_destinationTable as $key => $value) {
					array_push($data_listPlan,
						array(
							'transportation_id' => $id,
							'target_id' => $value['id'],
							'target_type' => 2,
							'capacity' => $value['capacity'],
							'sequence' => $x
						)
					);
					$x = $x+1;
				}
				$this -> db -> insert_batch('list_plan', $data_listPlan);
			}

			// ต้องแปลงค่า string ที่เขียนในรูปแบบ json มาเป็น array ในแบบของ php
			$decode_costOfPlan = json_decode($costOfPlan, true);

			// นำ $costOfPlan ที่ทำการ Decode แล้วมาประกอบใส่ $data_costOfPlan เพื่อทำการบันทึกลงฐานข้อมูล ตาราง cost_of_plan
			if($decode_costOfPlan) {
				$data_costOfPlan = array();
				foreach ($decode_costOfPlan as $key => $value) {
					array_push($data_costOfPlan,
						array(
							'transportation_id' => $id,
							'source_id' => $value['source_id'],
							'destination_id' => $value['destination_id'],
							'cost' => $value['cost']
						)
					);
				}
				$this -> db -> insert_batch('cost_of_plan', $data_costOfPlan);
			}
			return TRUE;
		} else {
			$this -> db -> from('transportation');
			$this -> db -> where('plan_name', "$planname");
			$this -> db -> limit(1);

			$query = $this -> db -> get();
			$rows = $query -> num_rows();

			if (!$rows) {
				$data = array('plan_name' => $planname);
				$this -> db -> where('id', $id);
				$query = $this -> db -> update('transportation', $data);

				// ลบข้อมูลในตาราง list_plan
				$this-> db -> where('transportation_id', $id);
				$this -> db -> delete('list_plan');

				// ลบข้อมูลในตาราง cost_of_plan
				$this-> db -> where('transportation_id', $id);
				$this -> db -> delete('cost_of_plan');

				// ต้องแปลงค่า string ที่เขียนในรูปแบบ json มาเป็น array ในแบบของ php
				$decode_sourceTable = json_decode($sourceTable, true);
				$decode_destinationTable = json_decode($destinationTable, true);

				// นำ sourceTable และ destinationTable ที่ทำการ Decode แล้วมาประกอบใส่ $data_listPlan เพื่อทำการบันทึกลงฐานข้อมูล ตาราง list_plan
				if ($decode_sourceTable || $decode_destinationTable) {
					$data_listPlan = array();
					$x = 1;
					foreach ($decode_sourceTable as $key => $value) {
						array_push($data_listPlan,
							array(
								'transportation_id' => $id,
								'target_id' => $value['id'],
								'target_type' => 1,
								'capacity' => $value['capacity'],
								'sequence' => $x
							)
						);
						$x = $x+1;
					}
					$x = 1;
					foreach ($decode_destinationTable as $key => $value) {
						array_push($data_listPlan,
							array(
								'transportation_id' => $id,
								'target_id' => $value['id'],
								'target_type' => 2,
								'capacity' => $value['capacity'],
								'sequence' => $x
							)
						);
						$x = $x+1;
					}
					$this -> db -> insert_batch('list_plan', $data_listPlan);
				}

				// ต้องแปลงค่า string ที่เขียนในรูปแบบ json มาเป็น array ในแบบของ php
				$decode_costOfPlan = json_decode($costOfPlan, true);

				// นำ $costOfPlan ที่ทำการ Decode แล้วมาประกอบใส่ $data_costOfPlan เพื่อทำการบันทึกลงฐานข้อมูล ตาราง cost_of_plan
				if (decode_costOfPlan) {
					$data_costOfPlan = array();
					foreach ($decode_costOfPlan as $key => $value) {
						array_push($data_costOfPlan,
							array(
								'transportation_id' => $id,
								'source_id' => $value['source_id'],
								'destination_id' => $value['destination_id'],
								'cost' => $value['cost']
							)
						);
					}
					$this -> db -> insert_batch('cost_of_plan', $data_costOfPlan);
				}
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	function removePlan($id) {
		// ลบข้อมูลในตาราง list_plan
		$this-> db -> where('transportation_id', $id);
		$this -> db -> delete('list_plan');

		// ลบข้อมูลในตาราง cost_of_plan
		$this-> db -> where('transportation_id', $id);
		$this -> db -> delete('cost_of_plan');

		// ลบข้อมูลในตาราง transportation
		$this -> db -> where('id', $id);
		$query = $this -> db -> delete('transportation');

		if ($query) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	function getAllPlanSend() {
		$this -> db -> select('*');
		$this -> db -> from('transportation');
		$this -> db -> where('plan_status', 'รออนุมัติ');
		$query = $this -> db -> get();

		return $query -> result();
	}

	function statusNotApprove($id) {

		$data = array('plan_status' => 'ยังไม่อนุมัติ');
		$this -> db -> where('id', $id);
		$this -> db -> update('transportation', $data);

	}

	function statusApprove($id) {

		$data = array('plan_status' => 'อนุมัติ');
		$this -> db -> where('id', $id);
		$this -> db -> update('transportation', $data);

	}

	function getPlanList() {
		$this -> db -> select('*');
		$this -> db -> from('transportation');
		$this -> db -> where('plan_status', 'อนุมัติ');
		$query = $this -> db -> get();

		return $query -> result();
	}

}
?>
