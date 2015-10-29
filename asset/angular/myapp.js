angular.module('steppingStone', []).controller('miniSteppingStone', function($scope) {

	// 1. สิ่งที่จำเป็นต้องใช้ใน Step1
	$scope.source_data = [];
	// 1.1 เพิ่มต้นทาง
	$scope.addSource = function() {
		if ($scope.selectSource !== undefined && $scope.selectSource !== '') {// เช็ค selectSource ว่าไม่ใช่ค่าว่าง
			if ($scope.source_capacity === undefined || $scope.source_capacity === '' || $scope.source_capacity === null || $scope.source_capacity <= 0) {// เช็ค capacity ถ้าเป็นค่าว่างให้ capacity = 0
				$scope.err_plan3 = true;
			} else {
				$scope.err_plan3 = false;
				$scope.source_data.push({
					id : $scope.selectSource.id,
					source_name : $scope.selectSource.source_name,
					capacity : $scope.source_capacity
				});

				// ลบลิสที่ถูกเลือกแล้ว
				var oldSourceList = $scope.source_lists;
				$scope.source_lists = [];
				angular.forEach(oldSourceList, function(list) {
					if (list.source_name !== $scope.selectSource.source_name) {
						$scope.source_lists.push(list);
					}
				});
			}

			// ตั้งค่า selectSource ใหม่
			$scope.selectSource = '';
			$scope.source_capacity = '';
		};
	};
	// 1.2 แก้ไขต้นทาง
	$scope.editSource = function(id, name, newCapacity) {
		var oldData = $scope.source_data;
		$scope.source_data = [];
		angular.forEach(oldData, function(list) {
			if (list.id !== id) {
				$scope.source_data.push(list);
			} else {
				$scope.source_data.push({
					id : id,
					source_name : name,
					capacity : newCapacity
				});
			};
		});
	};
	// 1.3 ลบต้นทาง
	$scope.removeSource = function(id) {
		var oldData = $scope.source_data;
		$scope.source_data = [];
		angular.forEach(oldData, function(list) {
			if (list.id !== id) {
				$scope.source_data.push(list);
			} else {
				$scope.source_lists.push({
					id : list.id,
					source_name : list.source_name
				});
			}
		});

		if ($scope.new_costs.length) {
			var new_costs_backup = $scope.new_costs;
			$scope.new_costs = [];
			angular.forEach(new_costs_backup, function(list) {
				if (list.source_id !== id) {
					$scope.new_costs.push(list);
				}
			});
			new_costs_backup = [];
		}
	};

	// 1.4 เช็คข้อมูลตอนเปิดหน้าจอแก้ไข
	$scope.checkSourceEdit = function() {

		var oldsource = $scope.source_lists;
		$scope.source_lists = [];
		angular.forEach(oldsource, function(list) {
			if ($scope.checkSourceData(list.id)) {//ส่ง source_lists.id ไป เช็คที่ checkSourceData
				$scope.source_lists.push(list);
				// ถ้า  true ให้ใส่ใน source_lists
			}
		});
	};

	$scope.checkSourceData = function(id) {
		var x = true;
		angular.forEach($scope.source_data, function(list) {
			if (list.id === id) {// เช็ค source_data.id === source_lists.id
				x = false;
				//ถ้าไอดีตรงกัน ให้ส่งค่า false กลับไป ถ้าไม่ตรงให้ส่งค่า true
			}
		});
		return x;
	};

	//ใส่ชื่อ source_data ตามไอดี
	$scope.modifySource = function(source_json) {
		var set_source_data = [];
		angular.forEach($scope.source_data, function(list) {
			angular.forEach(source_json, function(list2) {
				if (list.id === list2.id) {
					set_source_data.push({
						id : list.id,
						source_name : list2.source_name,
						capacity : list.capacity
					});
				}
			});
		});
		$scope.source_data = set_source_data;
	};

	$scope.destination_data = [];

	$scope.addDestination = function() {
		if ($scope.selectDestination !== undefined && $scope.selectDestination !== '') {
			if ($scope.destination_capacity === undefined || $scope.destination_capacity === '' || $scope.destination_capacity === null || $scope.destination_capacity <= 0) {
				$scope.err_plan3 = true;
			} else {
				$scope.err_plan3 = false;
				$scope.destination_data.push({
					id : $scope.selectDestination.id,
					destination_name : $scope.selectDestination.destination_name,
					capacity : $scope.destination_capacity
				});

				// ลบลิสที่ถูกเลือกแล้ว
				var oldDestinationList = $scope.destination_lists;
				$scope.destination_lists = [];
				angular.forEach(oldDestinationList, function(list) {
					if (list.destination_name !== $scope.selectDestination.destination_name) {
						$scope.destination_lists.push(list);
					}
				});
			}
			// ตั้งค่า selectDestination ใหม่
			$scope.selectDestination = '';
			$scope.destination_capacity = '';
		};
	};

	$scope.editDestination = function(id, name, newCapacity) {
		var oldData = $scope.destination_data;
		$scope.destination_data = [];
		angular.forEach(oldData, function(list) {
			if (list.id !== id) {
				$scope.destination_data.push(list);
			} else {
				$scope.destination_data.push({
					id : id,
					destination_name : name,
					capacity : newCapacity
				});
			};
		});
	};

	$scope.removeDestination = function(id) {
		var oldData = $scope.destination_data;
		$scope.destination_data = [];
		angular.forEach(oldData, function(list) {
			if (list.id !== id) {
				$scope.destination_data.push(list);
			} else {
				$scope.destination_lists.push({
					id : list.id,
					destination_name : list.destination_name
				});
			}
		});

		if ($scope.new_costs.length) {
			var new_costs_backup = $scope.new_costs;
			$scope.new_costs = [];
			angular.forEach(new_costs_backup, function(list) {
				if (list.destination_id !== id) {
					$scope.new_costs.push(list);
				}
			});
			new_costs_backup = [];
		}
	};

	$scope.checkDestinationEdit = function() {
		var olddestination = $scope.destination_lists;
		$scope.destination_lists = [];

		angular.forEach(olddestination, function(list) {
			//ส่ง
			if ($scope.checkDestinationData(list.id)) {
				$scope.destination_lists.push(list);
			}
		});
	};

	$scope.checkDestinationData = function(id) {
		var x = true;
		angular.forEach($scope.destination_data, function(list) {
			if (list.id === id) {
				x = false;
			}
		});
		return x;
	};

	//ใส่ชื่อ destination_data ตามไอดี
	$scope.modifyDestination = function(destination_json) {
		var set_destination_data = [];
		angular.forEach($scope.destination_data, function(list) {
			angular.forEach(destination_json, function(list2) {
				if (list.id === list2.id) {
					set_destination_data.push({
						id : list.id,
						destination_name : list2.destination_name,
						capacity : list.capacity
					});
				}
			});
		});
		$scope.destination_data = set_destination_data;
	};

	// 2. สิ่งที่จำเป็นต้องใช้ใน Step2
	$scope.new_costs = [];
	// 2.1 เช็ค cost
	$scope.checkCost = function(SourceId, DestinationId) {

		var myCost = 0;
		// 2.2 ตรวจสอบ  cost โดย  SourceId, DestinationId จาก  DB
		var cost = $scope.costs;
		angular.forEach(cost, function(list) {
			if (SourceId === list.source_id && DestinationId === list.destination_id) {
				myCost = list.cost;
			}
		});
		// 2.3 ตรวจสอบ cost จากข้อมูลที่เลือกมาใน new_cost
		var new_cost = $scope.new_costs;
		angular.forEach(new_cost, function(list) {
			if (SourceId === list.source_id && DestinationId === list.destination_id) {
				myCost = list.cost;
			}
		});

		myCost = parseInt(myCost);
		$scope.addNewCost(SourceId, DestinationId, myCost);
		return myCost;

	};

	$scope.addNewCost = function(SourceId, DestinationId, c) {
		if ($scope.new_costs.length === 0) {
			$scope.new_costs.push({
				source_id : SourceId,
				destination_id : DestinationId,
				cost : c
			});
		} else {
			var old_costs = $scope.new_costs;
			// status 1 ยังไม่ได้ใส่ข้อมูล
			var status = 1;
			$scope.new_costs = [];
			angular.forEach(old_costs, function(list) {
				if (SourceId === list.source_id && DestinationId === list.destination_id) {
					$scope.new_costs.push({
						source_id : SourceId,
						destination_id : DestinationId,
						cost : c
					});
					status = 2;
				} else {
					$scope.new_costs.push(list);
				}
			});
			if (status === 1) {
				$scope.new_costs.push({
					source_id : SourceId,
					destination_id : DestinationId,
					cost : c
				});
			}
		}
	};

	// 3. สิ่งที่จำเป็นต้องใช้ใน Step3
	// 3.1เรียง $scope.new_cost ใหม่จาก Cost น้อยไปหา Cost มาก
	$scope.sortNewCosts = function() {
		$scope.new_costs.sort(function(a, b) {
			return a.cost - b.cost;
		});
	};

	// 3.2ตัวแปรที่ต้องใช้ในการเซ็ท Capacity เริ่มแรก
	$scope.init_capacity = [];

	// ไม่เกี่ยวกับการคำนวณ แต่เอามาใช้ปริ้นค่า Json ให้ดูง่ายเฉยๆ
	printData = function(data) {
		angular.forEach(data, function(list) {
			console.log(list);
		});
	};

	// 3.3 ตัวแปรที่จะต้องใช้ในการคำนวณ Capacity (จำเป็นต้อง Backup)
	var source_data_backup = [];
	var destination_data_backup = [];

	// 3.4ฟังค์ชั่นตั้งค่า Capacity เริ่มต้น โดยการเลือกใส่ค่า Capacity จาก Cost น้อยไปหา Cost มาก
	$scope.initCapacity = function() {
		source_data_backup = [];
		destination_data_backup = [];

		// 3.4.1ทำการ Backup source_data
		angular.forEach($scope.source_data, function(list) {
			source_data_backup.push({
				id : list.id,
				source_name : list.source_name,
				capacity : list.capacity
			});
		});

		// 3.4.2ทำการ Backup destination_data
		angular.forEach($scope.destination_data, function(list) {
			destination_data_backup.push({
				id : list.id,
				destination_name : list.destination_name,
				capacity : list.capacity
			});
		});

		// แสดงค่าต่างๆที่ต้องใช้ออกมาทาง Console
		console.log("source_data:");
		printData($scope.source_data);
		console.log("destination_data:");
		printData($scope.destination_data);
		console.log("source_data_backup:");
		printData(source_data_backup);
		console.log("destination_data_backup:");
		printData(destination_data_backup);
		console.log("$scope.new_costs:");
		printData($scope.new_costs);

		//3.4.3ทำการคำนวณและใส่เซ็ทค่า $scope.init_capacity
		var similar_cost = [];
		//cost ที่เหมือนกัน

		var current_cost = 0;
		// cost ปัจจุบัน

		var next_similar_cost = false;
		// ทำต่อ  cost ที่เหมือนกัน

		var current_list_point = 0;
		// รายการปัจจุบัน

		var last_list_point = $scope.new_costs.length;
		// รายการสุดม้าย

		$scope.init_capacity = [];
		// ล้างค่า init_capacity ใหม่ทุกครั้ง

		angular.forEach($scope.new_costs, function(list) {
			current_list_point = current_list_point + 1;

			if (current_list_point === 1) {// กำหนดรายการแรกของปัจจุบัน
				current_cost = list.cost;
				// ให้ cost ปัจจุบันเท่ากับ cost
			}

			if (list.cost === current_cost) {// ถ้า list.cost เท่ากับ cost ปัจจุบัน
				similar_cost.push(list);
				// เก็บค่า cost ที่ระบุไว้ทั้งแอร์เรย์
			} else {
				next_similar_cost = true;
				// ทำต่อ cost ที่เหมือนกัน
			}

			if (next_similar_cost) {
				console.log(" ");
				console.log("กลุ่มค่า Cost เท่ากับ " + current_cost + " :");
				setInitCapacity(similar_cost);
				// ส่ง similar_cost ไปที่  setInitCapacity
				next_similar_cost = false;
				similar_cost = [];
			}

			if (list.cost !== current_cost) {// ถ้า list.cost ไม่เท่ากับ cost ปัจจุบัน
				current_cost = list.cost;
				// ให้ cost ปัจจุบันเท่ากับ cost
				similar_cost.push(list);
				// เก็บค่า cost ที่ระบุไว้ทั้งแอร์เรย์
			}

			if (current_list_point === last_list_point) {// ถ้ารายการปัจจุบัน เท่ากับ รายการสุดม้าย
				console.log(" ");
				console.log("กลุ่มค่า Cost เท่ากับ " + current_cost + " :");
				setInitCapacity(similar_cost);
				// ส่ง similar_cost ไปที่  setInitCapacity
				console.log(" ");
				similar_cost = [];
			}
		});

		angular.forEach($scope.new_costs, function(list) {
			var pushList = true;

			angular.forEach($scope.init_capacity, function(list2) {// ตรวจสอบ new_costs กับ  init_capacity ถ้าไม่ตรงให้ทำ pushList
				if ((list.source_id === list2.source_id) && (list.destination_id === list2.destination_id)) {
					pushList = false;
				}
			});
			// ใส่ new_costs ไปใน  init_capacity โดยกำหนด capacity เป็น 0 ให้หมดหลังคำนวน
			if (pushList) {
				$scope.init_capacity.push({
					source_id : list.source_id,
					destination_id : list.destination_id,
					cost : list.cost,
					capacity : 0
				});
			}
		});

		// แสดงค่าต่างๆที่ต้องใช้ออกมาทาง Console
		var total_result = 0;
		angular.forEach($scope.init_capacity, function(list) {
			console.log(list);
			total_result = total_result + list.capacity;
		});
		console.log(total_result);
		console.log($scope.new_costs.length === $scope.init_capacity.length);
		console.log("[---END---]");
	};

	// 3.5. ฟังค์ชั่น setInitCapacity() ใช้ค้ำนวณกำหนดค่า Capacity ของแต่ละกลุ่มที่มี Cost เท่ากัน
	function setInitCapacity(similar_cost) {

		var total_capacity = 0;

		do {
			var x = calCapacity(similar_cost);
			// ส่่ง similar_cost ไปที่ calCapacity แล้วให้เท่ากับ x

			if (x[0].capacity !== 0) {
				$scope.init_capacity.push(x[0]);
				reCapacity(x[0]);
				// ส่ง x ไป eCapacity
			}
			total_capacity = 0;

			angular.forEach(x, function(list) {
				total_capacity = total_capacity + list.capacity;
			});
		} while (total_capacity !== 0);

	}

	// 3.6. ฟังค์ชั่น findCapacityOfSource() ใช้ค้นหา Capacity จาก source_id
	function findCapacityOfSource(source_id) {
		var result = 0;
		angular.forEach(source_data_backup, function(list) {
			if (source_id === list.id) {// ถ้า similar_cost.source_id เท่ากับ source_data_backup.id
				result = list.capacity;
			}
		});
		return result;
	}

	// 3.7. ฟังค์ชั่น findCapacityOfDestination() ใช้ค้นหา Capacity จาก source_id
	function findCapacityOfDestination(destination_id) {
		var result = 0;
		angular.forEach(destination_data_backup, function(list) {
			if (destination_id === list.id) {// ถ้า similar_cost.destination_id เท่ากับ destination_data_backup.id
				result = list.capacity;
			}
		});
		return result;
	}

	// 3.8. ฟังค์ชั่น calCapacity()
	function calCapacity(similar_cost) {
		var x = [];
		angular.forEach(similar_cost, function(list) {
			console.log(list);
			var a = findCapacityOfSource(list.source_id);
			// ส่ง source_id ไปตรวจสอบที่ findCapacityOfSource
			var b = findCapacityOfDestination(list.destination_id);
			// ส่ง destination_id ไปตรวจสอบที่  findCapacityOfDestination
			var c = 0;
			if (a < b) {
				c = a;
			} else {
				c = b;
			}
			console.log(a + " " + b);

			console.log(c);

			x.push({
				source_id : list.source_id,
				destination_id : list.destination_id,
				cost : list.cost,
				capacity : c
			});
		});

		x.sort(function(a, b) {
			return b.capacity - a.capacity;
		});

		return x;
	}

	// 3.9 ฟังค์ชั่น reCapacity() แก้ไข  capacity ใน source_data_backup, destination_data_backup ใหม่เพื่อการคำนวณ
	function reCapacity(obj) {
		var source_point = 0;
		angular.forEach(source_data_backup, function(list) {
			if (obj.source_id == list.id) {
				source_data_backup[source_point].capacity = source_data_backup[source_point].capacity - obj.capacity;
			}
			source_point = source_point + 1;
		});

		var destination_point = 0;
		angular.forEach(destination_data_backup, function(list) {
			if (obj.destination_id == list.id) {
				destination_data_backup[destination_point].capacity = destination_data_backup[destination_point].capacity - obj.capacity;
			}
			destination_point = destination_point + 1;
		});
	}

	// 4.การเปลี่ยนสเต็ปไปมา
	// 4.1ตัวแปรนี้ใช้เก็บค่าสเตตัสของแผนว่า error หรือไม่ ถ้า error จะไป step 2 ไม่ได้
	$scope.err_plan = false;

	$scope.err_plan2 = false;

	$scope.err_plan3 = false;

	// 4.2 ฟังค์ชั่นการเปลี่ยน Step
	$scope.changeStep = function(step) {
		$scope.myStep = step;
		// 4.2.1 เงื่อนไขการไปสเต็ปที่สอง ถ้าความไม่ใช่ ตาราง 3x3 ขึ้นไป ก็จะไม่สามารถข้ามไปยัง Step 2 ได้
		if (step === 2) {
			len1 = $scope.source_data.length;
			len2 = $scope.destination_data.length;

			if (len1 < 3 || len2 < 3) {
				$scope.myStep = 1;
				$scope.err_plan = true;
			} else {
				$scope.myStep = 2;
				$scope.err_plan = false;
				CheckStep1();
			}
		}

		// 4.2.2 การไปสเต็ปที่สาม
		if (step === 3) {
			// 4.2.2.1 เรียกฟังค์ชั่นการจัดเรียง $scope.new_cost ใหม่ จาก cost น้อยไปหา cost มาก
			$scope.sortNewCosts();
			// 4.2.2.2 เรียกฟังค์ชั่นการตั้งค่า $scope.init_capacity ไว้ใช้สำหรับการตั้งค่า capacity เบื้องต้น
			$scope.initCapacity();
			// 4.2.2.3 เรียกฟังค์ชั่นการคำนวณหาคำตอบ $scope.calculation ไว้ใช้สำหรับการหาคำตอบและแสดงผลลัพธ์ใน step3
			$scope.calculation();
		}

		function CheckStep1() {
			total_result1 = 0;
			angular.forEach($scope.source_data, function(list) {
				total_result1 = total_result1 + parseInt(list.capacity);
			});
			CheckStep2(total_result1);
		}

		function CheckStep2(total_result1) {
			total_result2 = 0;
			angular.forEach($scope.destination_data, function(list) {
				total_result2 = total_result2 + parseInt(list.capacity);
			});

			if (total_result1 !== total_result2) {
				$scope.err_plan2 = true;
				$scope.myStep = 1;
			} else {
				$scope.err_plan2 = false;
			}
		}

	};

	// ส่วนคำนวณ
	$scope.calculation = function() {

		// ตัวแปร re_init_capacity มีไว้ใช้เก็บข้อมูลจาก init_capacity ที่ได้ทำการจัดเรียงใหม่ ให้อยู่ในรูปแบบตามตาราง
		var re_init_capacity = [];

		// ทำการจัดเรียง init_capacity ใหม่ ให้อยู่ในรูปแบบเดียวกันกับตาราง
		angular.forEach($scope.source_data, function(list) {
			angular.forEach($scope.destination_data, function(list2) {
				angular.forEach($scope.init_capacity, function(list3) {
					if (list.id === list3.source_id && list2.id === list3.destination_id) {
						re_init_capacity.push(list3);
					}
				});
			});
		});

		// ตัวแปร re_init_capacity_2d เก็บค่าจาก re_init_capacity ในแบบ Array 2 มิติ
		var re_init_capacity_2d = [];

		// เก็บค่าจำนวนนับ source_data, destination_data ว่ามีกี่ตัวเพื่อใช้ในการคำนวณหาระยะของ Array 2 มิติ
		var source_length = $scope.source_data.length;
		var destination_length = $scope.destination_data.length;

		// ดำเนินการแปลงการเก็บค่าของ re_init_capacity จาก array 1 มิติ ให้เป็นแบบ 2 มิติ โดยเก็บไว้ที่ตัวแปร re_init_capacity_2d
		var count = 0;
		var pt = 1;
		var last_pt = re_init_capacity.length;
		var backup_array = [];
		angular.forEach(re_init_capacity, function(list) {
			pt++;
			if (count < destination_length) {
				backup_array.push(list);
				count++;
			} else {
				re_init_capacity_2d.push(backup_array);
				backup_array = [];
				backup_array.push(list);
				count = 0;
				count++;
			}

			if (pt === last_pt) {
				re_init_capacity_2d.push(backup_array);
			}
		});

		// แสดง re_init_capacity_2d
		console.log("\n\n[calculation function] -> re_init_capacity_2d : ");
		angular.forEach(re_init_capacity_2d, function(list) {
			console.log(list);
		});

		// หาจุดเริ่มต้นที่มีค่า capacity เท่ากับ 0
		var zero_points = [];
		console.log("\n\n");
		for (i = 0; i < source_length; i++) {
			for (j = 0; j < destination_length; j++) {
					if (re_init_capacity_2d[i][j].capacity === 0) {
						zero_points.push([i,j]);
					}
			}
		}
		console.log("จุดเริ่มต้นทั้งหมด :");
		console.log(zero_points);
		console.log("\n");

		// เริ่มดำเนินการกล้ิงหินได้!!! (TT~TT)/
		angular.forEach(zero_points, function(zero_point) {
			// เรียกฟังค์ชั่น rollingStone()
			rollingStone(re_init_capacity_2d, zero_point, source_length, destination_length);
		});
	};

	// ฟังค์ชั่น rollingStone() หรือ ฟังค์ชั่นการกล้ิงหิน
	// ตัวแปรที่เกี่ยวข้องคือ re_init_capacity_2d, zero_point, source_length, destination_length
	var rollingStone = function(re_init_capacity_2d, zero_point, source_length, destination_length) {
		console.log("\n------ จุดเริ่มต้น : "+ zero_point +" ------\n");
		// เส้นทางล่าง
		if (zero_point[0] < source_length-1) {
			for (i = zero_point[0]+1; i < source_length; i++) {
				var j = zero_point[1];
				var capacity = re_init_capacity_2d[i][j].capacity;
				if (capacity !== 0) {
					console.log("ล่าง :" + i + "," + j + " -> " + capacity);
				}
			}
		}
		//เส้นทางขวา
		if (zero_point[1] < destination_length-1) {
			for (j = zero_point[1]+1; j < destination_length; j++) {
				var i = zero_point[0];
				var capacity = re_init_capacity_2d[i][j].capacity;
				if (capacity !== 0) {
					console.log("ขวา :" + i + "," + j + " -> " + capacity);
				}
			}
		}
		//เส้นทางบน
		if (zero_point[0] !== 0) {
			for (i = zero_point[0]-1; i >= 0; i--) {
				var j = zero_point[1];
				var capacity = re_init_capacity_2d[i][j].capacity;
				if (capacity !== 0) {
					console.log("บน :" + i + "," + j + " -> " + capacity);
				}
			}
		}
		// เส้นทางซ้าย
		if (zero_point[1] !== 0) {
			for (j = zero_point[1]-1; j >= 0; j--) {
				var i = zero_point[0];
				var capacity = re_init_capacity_2d[i][j].capacity;
				if (capacity !== 0) {
					console.log("ซ้าย :" + i + "," + j + " -> " + capacity);
				}
			}
		}

		console.log("---------------------------\n\n");

	};
});
