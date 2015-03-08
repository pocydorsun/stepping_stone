angular.module('steppingStone', [])

// Controller สำหรับการจัดการตารางรายการต้นทาง-ปลายทาง
.controller('listTableCtrl', ['$scope',
function($scope) {

	// ข้อมูลตั้งต้นไว้ใช้ทดสอบตาราง
	$scope.dataTable1 = [{
		name : 'โรงงาน A',
		capacity : '20'
	}, {
		name : 'โรงงาน B',
		capacity : '15'
	}];

	// เป็นฟังค์ชันที่ใช้สำหรับเพิ่มรายการ
	$scope.addList = function() {
		$scope.dataTable1.push({
			name : $scope.name,
			capacity : $scope.capacity
		});
		$scope.name = '';
		$scope.capacity = '';
	};

	// เป็นฟังค์ชันที่ใช้สำหรับลบรายการ
	$scope.deleteList = function(idx) {
		$scope.dataTable1.splice(idx, 1);
	};
}]); 