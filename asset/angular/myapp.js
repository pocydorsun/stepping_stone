angular.module('steppingStone', [])

// Controller สำหรับการจัดการตารางรายการต้นทาง-ปลายทาง
.controller('listTableCtrl', ['$scope',
function($scope) {
	
	$scope.mainDataTable = [];

	// ข้อมูลตั้งต้นไว้ใช้ทดสอบตาราง
	$scope.dataTable = [];

	$scope.dataList = function(targets) {
		$scope.mainDataTable = $scope.dataTable.concat($scope.dataTable2);
		for(var n = 0, len1 = $scope.mainDataTable.length; n < len1; n++) {
			for(var i = 0, len2 = targets.length; i < len2; i++) {
	        	if (targets[i].source_name === $scope.mainDataTable[n].source_name) {
	        		targets.splice(i,1);
	        		break;
	        	}
    		}
		}
		
		return targets;
	};
	
	// เป็นฟังค์ชันที่ใช้สำหรับเพิ่มรายการ
	$scope.addList = function() {
		if (($scope.name !== undefined) && ($scope.capacity !== undefined)) {
			var str = $scope.name;
			var json = JSON.parse(str);
			
			$scope.dataTable.push({
				id : json.id,
				name : json.source_name,
				capacity : $scope.capacity
			});
			
			for(var i = 0, len = $scope.targets.length; i < len; i++) {
	        	if ($scope.targets[i].source_name === json.source_name) {
	        		$scope.targets.splice(i,1);
	        		break;
	        	}
			}
			
			$scope.name = undefined;
			$scope.capacity = undefined;
			$scope.name2 = undefined;
			$scope.capacity2 = undefined;
		}
	};

	// เป็นฟังค์ชันที่ใช้สำหรับลบรายการ
	$scope.deleteList = function(idx, id, name) {
		$scope.dataTable.splice(idx, 1);
		$scope.targets.push({
			id : id,
			source_name : name
		});
	};
	
	$scope.dataTable2 = [];
	
	$scope.addList2 = function() {
		if (($scope.name2 !== undefined) && ($scope.capacity2 !== undefined)) {
			var str2 = $scope.name2;
			var json2 = JSON.parse(str2);
			
			$scope.dataTable2.push({
				id : json2.id,
				name : json2.source_name,
				capacity : $scope.capacity2
			});
			
			for(var i = 0, len = $scope.targets.length; i < len; i++) {
	        	if ($scope.targets[i].source_name === json2.source_name) {
	        		$scope.targets.splice(i,1);
	        		break;
	        	}
			}
			
			$scope.name = undefined;
			$scope.capacity = undefined;
			$scope.name2 = undefined;
			$scope.capacity2 = undefined;
		}
	};

	// เป็นฟังค์ชันที่ใช้สำหรับลบรายการ
	$scope.deleteList2 = function(idx, id, name) {
		$scope.dataTable2.splice(idx, 1);
		$scope.targets.push({
			id : id,
			source_name : name
		});
	};
	
	$scope.changeStep = function(step){
		$scope.myStep = step;
	};
}]);
