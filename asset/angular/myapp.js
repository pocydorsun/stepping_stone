angular.module('steppingStone', [])

	.controller('listTableCtrl', ['$scope', function($scope) {

		$scope.sourceTable = [];

		$scope.destinationTable = [];

		$scope.initSources = function(sources) {

				for(var n = 0, len1 = $scope.sourceTable.length; n < len1; n++) {
					for(var i = 0, len2 = sources.length; i < len2; i++) {
			        	if (sources[i].source_name === $scope.sourceTable[n].source_name) {
			        		sources.splice(i,1);
			        		break;
			        	}
		    		}
				}

				for(var n = 0, len1 = $scope.destinationTable.length; n < len1; n++) {
					for(var i = 0, len2 = sources.length; i < len2; i++) {
			        	if (sources[i].source_name === $scope.destinationTable[n].destination_name) {
			        		sources.splice(i,1);
			        		break;
			        	}
		    		}
				}

			return sources;
		};

		$scope.initDestination = function(destinations) {

				for(var n = 0, len1 = $scope.sourceTable.length; n < len1; n++) {
					for(var i = 0, len2 = destinations.length; i < len2; i++) {
			        	if (destinations[i].destination_name === $scope.sourceTable[n].source_name) {
			        		destinations.splice(i,1);
			        		break;
			        	}
		    		}
				}

				for(var n = 0, len1 = $scope.destinationTable.length; n < len1; n++) {
					for(var i = 0, len2 = destinations.length; i < len2; i++) {
			        	if (destinations[i].destination_name === $scope.destinationTable[n].destination_name) {
			        		destinations.splice(i,1);
			        		break;
			        	}
		    		}
				}

			return destinations;
		};

		$scope.addSource = function() {
			if (($scope.selectSource !== undefined) && ($scope.capacityOfSource !== undefined)) {
				var str = $scope.selectSource;
				var json = JSON.parse(str);

				$scope.sourceTable.push({
					id : json.id,
					source_name : json.source_name,
					capacity : $scope.capacityOfSource
				});

				for(var i = 0, len = $scope.sources.length; i < len; i++) {
	      	if ($scope.sources[i].source_name === json.source_name) {
	      		$scope.sources.splice(i,1);
	      		break;
	      	}
				}

				$scope.selectSource = undefined;
				$scope.capacityOfSource = undefined;
				$scope.selectDestination = undefined;
				$scope.capacityOfDestination = undefined;
			}
		};

		$scope.addDestination = function() {
			if (($scope.selectDestination !== undefined) && ($scope.capacityOfDestination !== undefined)) {
				var str = $scope.selectDestination;
				var json = JSON.parse(str);

				$scope.destinationTable.push({
					id : json.id,
					destination_name : json.destination_name,
					capacity : $scope.capacityOfDestination
				});

				for(var i = 0, len = $scope.destinations.length; i < len; i++) {
	      	if ($scope.destinations[i].destination_name === json.destination_name) {
	      		$scope.destinations.splice(i,1);
	      		break;
	      	}
				}

				$scope.selectSource = undefined;
				$scope.capacityOfSource = undefined;
				$scope.selectDestination = undefined;
				$scope.capacityOfDestination = undefined;
			}
		};

		$scope.deleteSource = function(idx, id, name) {
			$scope.sourceTable.splice(idx, 1);

			$scope.sources.push({
				id : id,
				source_name : name
			});
		};

		$scope.deleteDestination = function(idx, id, name) {
			$scope.destinationTable.splice(idx, 1);

			$scope.destinations.push({
				id : id,
				destination_name : name
			});
		};

		$scope.checkCost = function(id1, id2) {
			for(var n = 0, len = $scope.costs.length; n < len; n++) {
				cost = $scope.costs[n];
				str = id1 + ":" + id2;
				str2 = cost.source_id + ":" + cost.destination_id;

				if(str === str2) {
						return cost.cost;
				}
			}

			return 0;
		};

		$scope.changeStep = function(step){
			$scope.myStep = step;
		};
	}]);
