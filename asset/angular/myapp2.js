angular.module('steppingStone', []).controller('miniSteppingStone', function($scope) {

	$scope.source_data = [];

	$scope.addSource = function() {
		if ($scope.selectSource != undefined && $scope.selectSource != '') {
			if ($scope.source_capacity == undefined || $scope.source_capacity == '') {
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
				if (list.source_name != $scope.selectSource.source_name)
					$scope.source_lists.push(list);
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
			if (list.id != id) {
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
			if (list.id != id) {
				$scope.source_data.push(list);
			} else {
				$scope.source_lists.push({
					source_name : list.source_name,
					capacity : list.capacity
				});
			}
		});
	};

	$scope.destination_data = [];

	$scope.addDestination = function() {
		if ($scope.selectDestination != undefined && $scope.selectDestination != '') {
			if ($scope.destination_capacity == undefined || $scope.destination_capacity == '') {
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
				if (list.destination_name != $scope.selectDestination.destination_name)
					$scope.destination_lists.push(list);
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
			if (list.id != id) {
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
			if (list.id != id) {
				$scope.destination_data.push(list);
			} else {
				$scope.destination_lists.push({
					destination_name : list.destination_name,
					capacity : list.capacity
				});
			}
		});
	};

	$scope.new_costs = [];

	$scope.checkCost = function(SourceId, DestinationId) {

		myCost = 0;

		var cost = $scope.costs;
		angular.forEach(cost, function(list) {
			if (SourceId === list.source_id && DestinationId === list.destination_id) {
				myCost = list.cost;
			}
		});

		var new_cost = $scope.new_costs;
		angular.forEach(new_cost, function(list) {
			if (SourceId === list.source_id && DestinationId === list.destination_id) {
				myCost = list.cost;
			}
		});

		$scope.addNewCost(SourceId, DestinationId, myCost);
		return parseInt(myCost);

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

	$scope.err_plan = false;

	$scope.changeStep = function(step) {
		$scope.myStep = step;


		// if (step === 2) {
			// len1 = $scope.source_data.length;
			// len2 = $scope.destination_data.length;
// 
			// if (len1 < 3 || len2 < 3) {
				// $scope.myStep = 1;
				// $scope.err_plan = true;
			// } else {
				// $scope.myStep = 2;
				// $scope.err_plan = false;
			// }
		// }


		if (step === 3) {
			$scope.sortNewCosts();
		}

	};
	
	

	$scope.sortNewCosts = function() {
		$scope.new_costs.sort(function(a,b) {return a.cost-b.cost;});


	};

});
