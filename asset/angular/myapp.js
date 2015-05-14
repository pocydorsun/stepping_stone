angular.module('steppingStone', [])

	.controller('listTableCtrl', ['$scope', function($scope) {

		$scope.sourceTable = [];
		$scope.sources_backup = [];

		$scope.destinationTable = [];
		$scope.destinations_backup = [];
		
		$scope.err_plan = false;
		$scope.new_costs = [];
		
		$scope.sort_costs = [];
		$scope.backup_data = [];

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

						$scope.sources_backup.push({
							id : $scope.sources[i].id,
							source_name : $scope.sources[i].source_name
						});

	      		$scope.sources.splice(i,1);
	      		break;
	      	}
				}

				for(var i = 0, len = $scope.destinations.length; i < len; i++) {
	      	if ($scope.destinations[i].destination_name === json.source_name) {

						$scope.destinations_backup.push({
							id : $scope.destinations[i].id,
							destination_name : $scope.destinations[i].destination_name
						});

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

		$scope.addDestination = function() {
			if (($scope.selectDestination !== undefined) && ($scope.capacityOfDestination !== undefined)) {
				var str = $scope.selectDestination;
				var json = JSON.parse(str);

				$scope.destinationTable.push({
					id : json.id,
					destination_name : json.destination_name,
					capacity : $scope.capacityOfDestination
				});

				for(var i = 0, len = $scope.sources.length; i < len; i++) {
	      	if ($scope.sources[i].source_name === json.destination_name) {

						$scope.sources_backup.push({
							id : $scope.sources[i].id,
							source_name : $scope.sources[i].source_name
						});

	      		$scope.sources.splice(i,1);
	      		break;
	      	}
				}

				for(var i = 0, len = $scope.destinations.length; i < len; i++) {
	      	if ($scope.destinations[i].destination_name === json.destination_name) {

						$scope.destinations_backup.push({
							id : $scope.destinations[i].id,
							destination_name : $scope.destinations[i].destination_name
						});

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
			for(var i = 0, len = $scope.destinations_backup.length; i < len; i++) {
				if ($scope.destinations_backup[i].destination_name === name) {
					$scope.destinations.push({
						id : $scope.destinations_backup[i].id,
						destination_name : $scope.destinations_backup[i].destination_name
					});

					$scope.destinations_backup.splice(i,1);
					break;
				}
			}
	
			for(var i=0, len = $scope.new_costs.length; i < len; i++) {
				for(var n=0, len2 = $scope.new_costs.length; n < len2; n++) {
					var id2 = $scope.new_costs[n].source_id;
					console.log(n);
					if(id === id2) {
						console.log($scope.new_costs[n]);
						$scope.new_costs.splice(n,1);
						break;
					}	
				}
			}
		};

		$scope.deleteDestination = function(idx, id, name) {
			$scope.destinationTable.splice(idx, 1);

			$scope.destinations.push({
				id : id,
				destination_name : name
			});

			for(var i = 0, len = $scope.sources_backup.length; i < len; i++) {

				if ($scope.sources_backup[i].source_name === name) {
					$scope.sources.push({
						id : $scope.sources_backup[i].id,
						source_name : $scope.sources_backup[i].source_name
					});

					$scope.sources_backup.splice(i,1);
					break;
				}
			}
			
			for(var i=0, len = $scope.new_costs.length; i < len; i++) {
				for(var n=0, len2 = $scope.new_costs.length; n < len2; n++) {
					var id2 = $scope.new_costs[n].destination_id;
					if(id === id2) {
						$scope.new_costs.splice(n,1);
						break;
					}	
				}
			}
		};

		$scope.checkCost = function(id1, id2) {
			
			myCost = 0;
			
			for(var n = 0, len = $scope.costs.length; n < len; n++) {
				cost = $scope.costs[n];
				str = id1 + ":" + id2;
				str2 = cost.source_id + ":" + cost.destination_id;

				if(str === str2) {
						myCost = cost.cost;
						break;
				}
			}
			
			for(var n = 0, len = $scope.new_costs.length; n < len; n++) {
				new_cost = $scope.new_costs[n];
				str = id1 + ":" + id2;
				str2 = new_cost.source_id + ":" + new_cost.destination_id;

				if(str === str2) {
						myCost = new_cost.cost;
						break;
				}
			}
			$scope.addCost(id1, id2, myCost);
			return parseInt(myCost);
		};
		
		$scope.addCost = function(id1, id2, c) {
			
			for(var n = 0, len = $scope.new_costs.length; n < len; n++) {
				cost = $scope.new_costs[n];
				str = id1 + ":" + id2;
				str2 = cost.source_id + ":" + cost.destination_id;
				
				if(str === str2) {
					$scope.new_costs.splice(n,1);
					break;
				}
			}
			
			$scope.new_costs.push({
				source_id : id1,
				destination_id : id2,
				cost : c
			});
		};
		
		$scope.changeStep = function(step){
			$scope.myStep = step;
			
			if (step===2) {
				len1 = $scope.sourceTable.length;
				len2 = $scope.destinationTable.length;
				
				if (len1 < 3 && len2 < 3) {
					$scope.myStep = 1;
					$scope.err_plan = true;
				}
			}
			
			if (step===3) {
				$scope.sort_costs = [];
				$scope.sortNewCosts();
				$scope.initCapacity = [];
				$scope.setInitCapacity();
			}
		};
		
		$scope.sortNewCosts = function(){
			
			for (n = 0, len = $scope.new_costs.length; n < len; n++) {
				
				$scope.backup_data.push({
					source_id : $scope.new_costs[n].source_id,
					destination_id : $scope.new_costs[n].destination_id,
					cost : $scope.new_costs[n].cost
				});
			}

			for(var x = 0, len = $scope.backup_data.length; x < len-1; x++ ){
				var minCost;
				var index;
				for(var i = 0, len2 = $scope.backup_data.length; i < len2; i++){
						if (len2 === 2) {
							if ($scope.backup_data[0].cost > $scope.backup_data[1].cost ) {
								$scope.sort_costs.push($scope.backup_data[1]);
								$scope.sort_costs.push($scope.backup_data[0]);
								$scope.backup_data = [];
								break;
							} else {
								$scope.sort_costs.push($scope.backup_data[0]);
								$scope.sort_costs.push($scope.backup_data[1]);
								$scope.backup_data = [];
								break;
							}
						}
					
						if ((i === 0) && (len2 > 2)) {
							minCost = $scope.backup_data[i];
							index = i;
							continue;
						}
						
						if ((minCost.cost === $scope.backup_data[i].cost) && (len2 > 2)) {
							var destinationId1 = $scope.backup_data[index].destination_id;
							var sourceId1 = $scope.backup_data[index].source_id;
							var destinationId2 = $scope.backup_data[i].destination_id;
							var sourceId2 = $scope.backup_data[i].source_id;
							
							var minCapacity1;
							var minCapacity2;
							
							if ($scope.findCapacityById("source", sourceId1) >= $scope.findCapacityById("destination", destinationId1)) {
								minCapacity1 = $scope.findCapacityById("destination", destinationId1);
							} else {
								minCapacity1 = $scope.findCapacityById("source", sourceId1);
							}
							
							if ($scope.findCapacityById("source", sourceId2) >= $scope.findCapacityById("destination", destinationId2)) {
								minCapacity2 = $scope.findCapacityById("destination", destinationId2);
							} else {
								minCapacity2 = $scope.findCapacityById("source", sourceId2);
							}
							
							if (minCapacity1 >= minCapacity2) {
								continue;
							} else {
								minCost = $scope.backup_data[i];
								index = i;
								continue;
							}
						}
						
						if ((minCost.cost > $scope.backup_data[i].cost) && (len2 > 2)) {
							minCost = $scope.backup_data[i];
							index = i;
						}
				}
				if ($scope.backup_data.length > 2) {
					$scope.sort_costs.push(minCost);
					$scope.backup_data.splice(index,1);
				}
			}
		};
		
		$scope.findCapacityById = function(type, id){
			var capacity = 0;
			if (type === "destination") {
				for (var i = 0, len = $scope.destinationTable.length; i < len; i++) {
					if ($scope.destinationTable[i].id === id){
						capacity = $scope.destinationTable[i].capacity;
						break;
					}
				}
			} else if (type === "source") {
				for (var i = 0, len = $scope.sourceTable.length; i < len; i++) {
					if ($scope.sourceTable[i].id === id){
						capacity = $scope.sourceTable[i].capacity;
						break;
					}
				}
			}
			
			return capacity;
		};
		
		$scope.initCapacity = [];
		$scope.capacityBackup1 = [];
		$scope.capacityBackup2 = [];
		
		$scope.findBackupCapacityById = function(type, id){
			var capacity = 0;
			if (type === "destination") {
				for (var i = 0, len = $scope.capacityBackup2.length; i < len; i++) {
					if ($scope.capacityBackup2[i].id === id){
						capacity = $scope.capacityBackup2[i].capacity;
						break;
					}
				}
			} else if (type === "source") {
				for (var i = 0, len = $scope.capacityBackup1.length; i < len; i++) {
					if ($scope.capacityBackup1[i].id === id){
						capacity = $scope.capacityBackup1[i].capacity;
						break;
					}
				}
			}
			
			return capacity;
		};

		$scope.setInitCapacity = function() {
			$scope.capacityBackup1 = [];
			$scope.capacityBackup2 = [];
			
			for (var i = 0, len = $scope.sourceTable.length; i < len; i++) {
				$scope.capacityBackup1.push(
					{
						id : $scope.sourceTable[i].id,
						source_name : $scope.sourceTable[i].source_name,
						capacity : $scope.sourceTable[i].capacity
					}
				);
			}
			
			for (var i = 0, len = $scope.destinationTable.length; i < len; i++) {
				$scope.capacityBackup2.push(
					{
						id : $scope.destinationTable[i].id,
						destination_name : $scope.destinationTable[i].destination_name,
						capacity : $scope.destinationTable[i].capacity
					}
				);
			}
			
			for (var i = 0, len = $scope.sort_costs.length; i < len; i++) {
				cap1 = $scope.findBackupCapacityById("source", $scope.sort_costs[i].source_id);
				cap2 = $scope.findBackupCapacityById("destination", $scope.sort_costs[i].destination_id);
				if (cap1 > cap2) {
					$scope.initCapacity.push({
						source_id : $scope.sort_costs[i].source_id,
						destination_id : $scope.sort_costs[i].destination_id,
						capacity : cap2
					});
					sum = cap1 - cap2;
					$scope.setCapacityBackup("2", $scope.sort_costs[i].destination_id, 0);
					$scope.setCapacityBackup("1", $scope.sort_costs[i].source_id, sum);
				} else if (cap1 < cap2){
					$scope.initCapacity.push({
						source_id : $scope.sort_costs[i].source_id,
						destination_id : $scope.sort_costs[i].destination_id,
						capacity : cap1
					});
					sum = cap2 - cap1;
					$scope.setCapacityBackup("1", $scope.sort_costs[i].source_id, 0);
					$scope.setCapacityBackup("2", $scope.sort_costs[i].destination_id, sum);
				} else if (cap1 === cap2) {
					$scope.initCapacity.push({
						source_id : $scope.sort_costs[i].source_id,
						destination_id : $scope.sort_costs[i].destination_id,
						capacity : cap1
					});
					$scope.setCapacityBackup("1", $scope.sort_costs[i].source_id, 0);
					$scope.setCapacityBackup("2", $scope.sort_costs[i].destination_id, 0);
				}
			}
		};
		
		$scope.setCapacityBackup = function(type, id, sumCap) {
			if (type === "2") {
				for (var i = 0, len = $scope.capacityBackup2.length; i < len; i++) {
					if ($scope.capacityBackup2[i].id === id){
						$scope.capacityBackup2[i].capacity = sumCap;
						break;
					}
				}
			} else if (type === "1") {
				for (var i = 0, len = $scope.capacityBackup1.length; i < len; i++) {
					if ($scope.capacityBackup1[i].id === id){
						$scope.capacityBackup1[i].capacity = sumCap;
						break;
					}
				}
			}
		};
	}]);
