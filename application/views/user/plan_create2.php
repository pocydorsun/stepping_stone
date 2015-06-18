<?php $sources_json = json_encode($sources, JSON_UNESCAPED_UNICODE); ?>
<?php $destinations_json = json_encode($destinations, JSON_UNESCAPED_UNICODE); ?>
<?php $costs_json = json_encode($costs, JSON_UNESCAPED_UNICODE); ?>

<div class="container">
	<div class=" well well-white">
		<div class="container">
			<font color="#0000FF" size="6">สร้างแผน</font>
			<div>
				<?php
				$attributes = array('class' => 'form-inline');
				echo form_open('user/add_plan2', $attributes);
				?>
				<div class="col-sm-6">
					<div class="form-group">
						<input type="text" class="form-control" name="txtPlan" id="txtPlan" placeholder="กรอกชื่อแผน">
					</div>
					<div class="form-group" ng-hide="false">
						<input type="text" class="form-control" name="txtSourceTable" id="txtSourceTable" value="{{source_data}}">
					</div>
					<div class="form-group" ng-hide="false">
						<input type="text" class="form-control" name="txtDestinationTable" id="txtDestinationTable" value="{{destination_data}}">
					</div>
					<div class="form-group" ng-hide="flase">
						<input type="text" class="form-control" name="txtCostOfPlan" id="txtCostOfPlan" value="{{new_costs}}">
					</div>
					<div class="form-group" ng-hide="flase">
						<input type="text" class="form-control" name="txtMyStep" id="txtMyStep" value="{{myStep}}">
					</div>
					<button type="submit" class="btn btn-success">
						สร้างแผน
					</button>
				</div>
				</form>
			</div>
		</div>

		{{new_costs}}

		<div ng-init="myStep=1">
			<div class="container-fluid">
				<div class="container" ng-show="myStep===1">
					<h2>ต้นทาง</h2>
					<div class="col-sm-7 well well-lg" >

						<table  class="table table-striped">
							<thead>
								<th style="width:200px;"/> ชื่อ </th>
								<th> ความจุ </th>
								<th></th>
							</thead>
							<br>

							<tbody>
								<tr ng-repeat='list in source_data'>

									<td>{{list.source_name}}</td>

									<td  ng-init='statusEdit=false; statusShow=true'><a = href=""
									ng-click='statusEdit=true; statusShow=false; newCapacity=list.capacity'
									ng-show="statusShow">
									<center>
										{{list.capacity}}
									</center> </a>
									<input type="number"
									class="form-control"
									style="width:50px;"/
									ng-model ='newCapacity'
									ng-show="statusEdit">
									</td>

									<td><a href=""
									ng-click="editSource(list.id, list.source_name, newCapacity)"
									ng-show="statusEdit"> ตกลง </a></td>

									<td><a href=""
									ng-click="statusEdit=false; statusShow=true; newName=''"
									ng-show="statusEdit"> ยกเลิก </a></td>

									<td><a href="" ng-click="removeSource(list.id)"
									ng-show="statusShow" > ลบ </a></td>
								</tr>
							</tbody>
						</table>

						<div <?php echo "ng-init='source_lists = $sources_json'"; ?> >
							<form class="form-inline" ng-submit="addSource()">
								<div class="form-group">
									<select style="width:150px;"/ class="form-control" ng-model="selectSource" ng-options="list.source_name for list in source_lists | orderBy:'source_name'">
										<option value="">เลือก</option>
									</select>
								</div>
								<div class="form-group">
									<input type="number" class="form-control" ng-model="source_capacity" placeholder="ความจุ">
								</div>

								<button type="submit" class="btn btn-default">
									เพิ่ม
								</button>
							</form>
						</div>

					</div>
				</div>
			</div>

			<div class="container-fluid">
				<div class="container" ng-show="myStep===1">
					<h2>ปลายทาง</h2>
					<div class="col-sm-7 well well-lg" >

						<table class="table table-striped" >
							<thead>
								<th style="width:200px;"/> ชื่อ </th>
								<th> ความจุ </th>
								<th></th>
							</thead>
							<br>

							<tbody>
								<tr ng-repeat='list in destination_data'>

									<td>{{list.destination_name}}</td>

									<td ng-init='statusEdit=false; statusShow=true'><a = href=""
									ng-click='statusEdit=true; statusShow=false; newCapacity=list.capacity'
									ng-show="statusShow">
									<center>
										{{list.capacity}}
									</center> </a>
									<input type="number"
									class="form-control"
									style="width:50px;"/
									ng-model ='newCapacity'
									ng-show="statusEdit">
									</td>

									<td><a href=""
									ng-click="editSource(list.id, list.destination_name, newCapacity)"
									ng-show="statusEdit"> ตกลง </a></td>

									<td><a href=""
									ng-click="statusEdit=false; statusShow=true; newName=''"
									ng-show="statusEdit"> ยกเลิก </a></td>

									<td><a href="" ng-click="removeDestination(list.id)"
									ng-show="statusShow"> ลบ </a></td>
								</tr>
							</tbody>
						</table>

						<div <?php echo "ng-init='destination_lists = $destinations_json'"; ?> >
							<form class="form-inline" ng-submit="addDestination()">
								<div class="form-group">
									<select style="width:150px;"/ class="form-control" ng-model="selectDestination" ng-options="list.destination_name for list in destination_lists | orderBy:'destination_name'">
										<option value="">เลือก</option>
									</select>
								</div>
								<div class="form-group">
									<input type="number" class="form-control" ng-model="destination_capacity" placeholder="ความจุ">
								</div>

								<button type="submit" class="btn btn-default">
									เพิ่ม
								</button>
							</form>
						</div>

					</div>
				</div>
			</div>
			<br>

			<div class="container-fluid">
				<div class="container-fluid table-responsive" ng-show="myStep===2">
					<table class="table table-bordered" >
						<thead>
							<tr>
								<th></th>
								<th ng-repeat="destination in destination_data">{{destination.destination_name}}</th>
								<th></th>
							</tr>
						</thead>
						<tbody <?php echo "ng-init='costs = $costs_json'"; ?>>
							<tr ng-repeat="source in source_data">
								<th>{{source.source_name}}</th>
								<td ng-repeat="destination in destination_data">
								<input type="number" ng-model="c" ng-init="c = checkCost(source.id, destination.id)" ng-change="addNewCost(source.id, destination.id, c)" class="form-control">
								</td>
								<th>{{source.capacity}}</th>
							</tr>
							<tr>
								<td></td>
								<th ng-repeat="destination in destination_data"> {{destination.capacity}} </th>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="container-fluid">
				<div class="container-fluid table-responsive" ng-show="myStep===3">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th></th>
								<th ng-repeat="destination in destination_data">{{destination.destination_name}}</th>
								<th></th>
							</tr>
						</thead>
						<tbody <?php echo "ng-init='costs = $costs_json'"; ?>>
							<tr ng-repeat="source in source_data">
								<th>{{source.source_name}}</th>
								<td ng-repeat="destination in destination_data">
								<input ng-model="search.source_id" ng-init="search.source_id = source.id" ng-hide="true">
								<input ng-model="search.destination_id" ng-init="search.destination_id = destination.id" ng-hide="true">
								<div ng-repeat="cap in initCapacity | filter:search">
									{{cap.capacity}}
								</div></td>
								<th>{{source.capacity}}</th>
							</tr>
							<tr>
								<td></td>
								<th ng-repeat="destination in destination_data"> {{destination.capacity}} </th>
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
