<?php $sources_json = json_encode($sources); ?>
<?php $destinations_json = json_encode($destinations); ?>
<?php $costs_json = json_encode($costs); ?>

<div class="container">
	<div class=" well well-white">
		<div class="container">
			<font color="#0000FF" size="6">สร้างแผน</font>
			<div>
				<?php
				$attributes = array('class' => 'form-inline');
				echo form_open('user/add_plan', $attributes);
				?>
				<div class="col-sm-6">
					<div class="form-group">
						<input type="text" class="form-control" name="txtPlan" id="txtPlan" placeholder="กรอกชื่อแผน">
					</div>
					<div class="form-group" ng-hide="true">
						<input type="text" class="form-control" name="txtSourceTable" id="txtSourceTable" value="{{sourceTable}}">
					</div>
					<div class="form-group" ng-hide="true">
						<input type="text" class="form-control" name="txtDestinationTable" id="txtDestinationTable" value="{{destinationTable}}">
					</div>
					<div class="form-group" ng-hide="true">
						<input type="text" class="form-control" name="txtCostOfPlan" id="txtCostOfPlan" value="{{new_costs}}">
					</div>
					<div class="form-group" ng-hide="true">
						<input type="text" class="form-control" name="txtMyStep" id="txtMyStep" value="{{myStep}}">
					</div>
					<button type="submit" class="btn btn-success">
						สร้างแผน
					</button>
				</div>
				</form>
			</div>
		</div>
		<br>
		<?php if ($this->session->flashdata('sourceTable') && $this->session->flashdata('destinationTable') && $this->session->flashdata('myStep') && $this->session->flashdata('costOfPlan')) :
		?>
		<div ng-init='myStep=<?php echo $this -> session -> flashdata("myStep"); ?>; sourceTable=<?php echo $this -> session -> flashdata("sourceTable"); ?>; destinationTable=<?php echo $this -> session -> flashdata("destinationTable"); ?>; new_costs=<?php echo $this -> session -> flashdata("costOfPlan"); ?>;'>
			<?php else : ?>
			<div ng-init="myStep=1">
				<?php endif ?>
				<div class="container-fluid">
					<div class="container" ng-show="myStep===1">
						<h2>ต้นทาง</h2>
						<div class="col-sm-6 well well-lg" >
							<!-- เรียกใช้ listTableCtrl ด้วยแท็ก div -->
							<!-- ตารางรายการ -->
							<table class="table" ng-if="sourceTable.length !== 0">
								<thead>
									<tr>
										<th>ชื่อ</th>
										<th>จำนวน/ความจุ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="list in sourceTable">
										<td>{{list.source_name}}</td>
										<td>
										<center>
											{{list.capacity}}
										</center></td>
										<td><a ng-click="deleteSource($index, list.id, list.source_name);"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
									</tr>
								</tbody>
							</table>
							<br>
							<!-- เว้นบรรทัด -->

							<!-- ฟอร์มเพิ่มรายการในตาราง -->

							<div <?php echo "ng-init='sources = initSources($sources_json)'"; ?>>
								<div ng-show="sources.length !== 0">
									
									<form class="form-inline" ng-submit="addSource()">
										<div class="form-group">
											<select class="form-control" ng-model="selectSource">
												<option value="">-</option>
												<option ng-repeat="source in sources | orderBy: 'source_name'" value={{source}}> {{source.source_name}} </option>
											</select>
										</div>
										<div class="form-group">
											<input type="number" class="form-control" ng-model="capacityOfSource" placeholder="จำนวน/ความจุ">
										</div>
										<button type="submit" class="btn btn-default">
											เพิ่ม
										</button>
									</form>
									
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- ปิดแท็ก div ของการเรียกใช้ listTableCtrl -->

				<div class="container-fluid">
					<div class="container" ng-show="myStep===1">
						<h2>ปลายทาง</h2>
						<div class="col-sm-6 well well-lg" >
							<!-- เรียกใช้ listTableCtrl ด้วยแท็ก div -->
							<!-- ตารางรายการ -->
							<table class="table" ng-if="destinationTable.length !== 0">
								<thead>
									<tr>
										<th>ชื่อ</th>
										<th>จำนวน/ความจุ</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="list in destinationTable">
										<td>{{list.destination_name}}</td>
										<td>
										<center>
											{{list.capacity}}
										</center></td>
										<td><a ng-click="deleteDestination($index, list.id, list.destination_name);"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></td>

									</tr>
								</tbody>
							</table>
							<br>
							<!-- เว้นบรรทัด -->

							<!-- ฟอร์มเพิ่มรายการในตาราง -->
							<div <?php echo "ng-init='destinations = initDestination($destinations_json)'"; ?>>
								<div ng-show="sources.length !== 0">
									<form class="form-inline" ng-submit="addDestination()" >
										<div class="form-group">
											<select class="form-control" ng-model="selectDestination">
												<option value="">-</option>
												<option ng-repeat="destination in destinations | orderBy: 'destination_name'" value={{destination}}> {{destination.destination_name}} </option>
											</select>
										</div>
										<div class="form-group">
											<input type="number" class="form-control" ng-model="capacityOfDestination" placeholder="จำนวน/ความจุ">
										</div>
										<button type="submit" class="btn btn-default">
											เพิ่ม
										</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="container-fluid">
					<div class="container-fluid table-responsive" ng-show="myStep===2">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th></th>
									<th ng-repeat="destination in destinationTable">{{destination.destination_name}}</th>
									<th></th>
								</tr>
							</thead>
							<tbody <?php echo "ng-init='costs = $costs_json'"; ?>>
								<tr ng-repeat="source in sourceTable">
									<th>{{source.source_name}}</th>
									<td ng-repeat="destination in destinationTable">
									<input type="number" ng-model="c" ng-init="c = checkCost(source.id, destination.id)" ng-change="addCost(source.id, destination.id, c)" class="form-control">
									</td>
									<th>{{source.capacity}}</th>
								</tr>
								<tr>
									<td></td>
									<th ng-repeat="destination in destinationTable"> {{destination.capacity}} </th>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<br>
				
				<div class="container-fluid">
					<div class="container-fluid table-responsive" ng-show="myStep===3">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th></th>
									<th ng-repeat="destination in destinationTable">{{destination.destination_name}}</th>
									<th></th>
								</tr>
							</thead>
							<tbody <?php echo "ng-init='costs = $costs_json'"; ?>>
								<tr ng-repeat="source in sourceTable">
									<th>{{source.source_name}}</th>
									<td ng-repeat="destination in destinationTable">
										<input ng-model="search.source_id" ng-init="search.source_id = source.id" ng-hide="true">
										<input ng-model="search.destination_id" ng-init="search.destination_id = destination.id" ng-hide="true">
										<div ng-repeat="cap in initCapacity | filter:search">
											{{cap.capacity}}
										</div>
									</td>
									<th>{{source.capacity}}</th>
								</tr>
								<tr>
									<td></td>
									<th ng-repeat="destination in destinationTable"> {{destination.capacity}} </th>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="container-fluid">
					<div class="container-fluid" ng-show="myStep===1">
						<button class="btn btn-success" ng-click="changeStep(2)">
							ต่อไป
						</button>
					</div>

					<div class="container-fluid" ng-show="myStep===2">
						<button class="btn btn-success" ng-click="changeStep(1)">
							กลับ
						</button>
				
						<button class="btn btn-success" ng-click="changeStep(3)">
							ต่อไป
						</button>
					</div>
					
					<div class="container-fluid" ng-show="myStep===3">
						<button class="btn btn-success" ng-click="changeStep(2)">
							กลับ
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- ปิดแท็ก div ของการเรียกใช้ listTableCtrl -->