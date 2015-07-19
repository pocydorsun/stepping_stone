angular.module('steppingStone', []).controller('miniSteppingStone', function($scope) {

	$scope.source_data = [];

	$scope.addSource = function() {
		if ($scope.selectSource !== undefined && $scope.selectSource !== '') {
			if ($scope.source_capacity === undefined || $scope.source_capacity === '' || $scope.source_capacity === null) {
				$scope.source_capacity = 0;
			}

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

			// ตั้งค่า selectSource ใหม่
			$scope.selectSource = '';
			$scope.source_capacity = '';
		};
	};

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

	$scope.destination_data = [];

	$scope.addDestination = function() {
		if ($scope.selectDestination !== undefined && $scope.selectDestination !== '') {
			if ($scope.destination_capacity === undefined || $scope.destination_capacity === '' || $scope.destination_capacity === null) {
				$scope.destination_capacity = 0;
			}
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

	$scope.new_costs = [];

	$scope.checkCost = function(SourceId, DestinationId) {

		var myCost = 0;
		// ตรวจสอบ  cost โดย  SourceId, DestinationId จาก  DB
		var cost = $scope.costs;
		angular.forEach(cost, function(list) {
			if (SourceId === list.source_id && DestinationId === list.destination_id) {
				myCost = list.cost;
			}
		});
		// ตรวจสอบ cost จากข้อมูลที่เลือกมาใน new_cost
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

		var current_cost = 0; // cost ปัจจุบัน

		var next_similar_cost = false; // ทำต่อ  cost ที่เหมือนกัน

		var current_list_point = 0;	// รายการปัจจุบัน

		var last_list_point = $scope.new_costs.length; // รายการสุดม้าย

		angular.forEach($scope.new_costs, function(list) {
			current_list_point = current_list_point + 1;

			if (current_list_point === 1) {	// รายการปัจจุบัน
				current_cost = list.cost;	// ให้ cost ปัจจุบันเท่ากับ cost
			}

			if (list.cost === current_cost) {	// ถ้า list.cost เท่ากับ cost ปัจจุบัน
				similar_cost.push(list);	// เก็บค่า cost ที่ระบุไว้ทั้งแอร์เรย์
			} else {
				next_similar_cost = true;	// ทำต่อ cost ที่เหมือนกัน
			}

			if (next_similar_cost) {
				console.log(" ");
				console.log("กลุ่มค่า Cost เท่ากับ " + current_cost + " :");
				console.log(similar_cost);
				next_similar_cost = false;
				similar_cost = [];
			}

			if (list.cost !== current_cost) {	// ถ้า list.cost ไม่เท่ากับ cost ปัจจุบัน
				current_cost = list.cost;	// ให้ cost ปัจจุบันเท่ากับ cost
				similar_cost.push(list);	// เก็บค่า cost ที่ระบุไว้ทั้งแอร์เรย์
			}

			if (current_list_point === last_list_point) {	// ถ้ารายการปัจจุบัน เท่ากับ รายการสุดม้าย
				console.log(" ");
				console.log("กลุ่มค่า Cost เท่ากับ " + current_cost + " :");
				console.log(similar_cost);
				console.log(" ");
				similar_cost = [];
			}
		});


		// แสดงค่าต่างๆที่ต้องใช้ออกมาทาง Console

		// printData($scope.new_costs);
		// console.log("$scope.init_capacity:");
		// printData($scope.init_capacity);
		console.log("[---END---]");
	};

	// 4.การเปลี่ยนสเต็ปไปมา
	// 4.1ตัวแปรนี้ใช้เก็บค่าสเตตัสของแผนว่า error หรือไม่ ถ้า error จะไป step 2 ไม่ได้
	$scope.err_plan = false;

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
			}
		}

		// 4.2.2 การไปสเต็ปที่สาม
		if (step === 3) {
			// 4.2.2.1 เรียกฟังค์ชั่นการจัดเรียง $scope.new_cost ใหม่ จาก cost น้อยไปหา cost มาก
			$scope.sortNewCosts();
			// 4.2.2.2 เรียกฟังค์ชั่นการตั้งค่า $scope.init_capacity ไว้ใช้สำหรับการแสดงผลใน Step 3
			$scope.initCapacity();
		}
	};
});
