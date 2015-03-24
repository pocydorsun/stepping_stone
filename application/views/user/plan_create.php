<div class="container">
	<h1>PLAN CREATH</h1>
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
				<input type="text" class="form-control" name="txtDataTable" id="txtDataTable" value="{{dataTable}}">
			</div>
			<div class="form-group" ng-hide="true">
				<input type="text" class="form-control" name="txtDataTable2" id="txtDataTable2" value="{{dataTable2}}">
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
<?php if ($this->session->flashdata('dataTable') && $this->session->flashdata('dataTable2') && $this->session->flashdata('myStep')) : ?>
	<div ng-init='myStep=<?php echo $this->session->flashdata("myStep"); ?>; dataTable=<?php echo $this->session->flashdata("dataTable"); ?>; dataTable2=<?php echo $this->session->flashdata("dataTable2"); ?>;'>
<?php else : ?>
	<div ng-init="myStep=1">
<?php endif ?>
	<div class="container" ng-show="myStep===1">
		<?php $targets_json = json_encode($targets); ?>
		<?php $costs_json = json_encode($costs); ?>
		<h2>ต้นทาง</h2>
		<div class="col-sm-6 well well-lg" >
			<!-- เรียกใช้ listTableCtrl ด้วยแท็ก div -->
			<!-- ตารางรายการ -->
			<table class="table" ng-if="dataTable.length !== 0">
				<thead>
					<tr>
						<th>ชื่อ</th>
						<th>จำนวน/ความจุ</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="list in dataTable">
						<td>{{list.name}}</td>
						<td>
						<center>
							{{list.capacity}}
						</center></td>
						<td><a ng-click="deleteList($index, list.id, list.name);"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
					</tr>
				</tbody>
			</table>
			<br>
			<!-- เว้นบรรทัด -->

			<!-- ฟอร์มเพิ่มรายการในตาราง -->

			<div <?php echo "ng-init='targets = dataList($targets_json)'"; ?>>
				<div ng-show="targets.length !== 0">
					<form class="form-inline" ng-submit="addList()">
						<div class="form-group">
							<select class="form-control" ng-model="name" id="selectSource" name="selectSource">
								<option value="">-</option>
								<option ng-repeat="target in targets | orderBy: 'source_name'" value={{target}}> {{target.source_name}} </option>
							</select>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" ng-model="capacity" placeholder="จำนวน/ความจุ">
						</div>
						<button type="submit" class="btn btn-default">
							เพิ่ม
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- ปิดแท็ก div ของการเรียกใช้ listTableCtrl -->

	<div class="container" ng-show="myStep===1">
		<h2>ปลายทาง</h2>
		<div class="col-sm-6 well well-lg" >
			<!-- เรียกใช้ listTableCtrl ด้วยแท็ก div -->
			<!-- ตารางรายการ -->
			<table class="table" ng-if="dataTable2.length !== 0">
				<thead>
					<tr>
						<th>ชื่อ</th>
						<th>จำนวน/ความจุ</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="list in dataTable2">
						<td>{{list.name}}</td>
						<td>
						<center>
							{{list.capacity}}
						</center></td>
						<td><a ng-click="deleteList2($index, list.id, list.name);"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a></td>

					</tr>
				</tbody>
			</table>
			<br>
			<!-- เว้นบรรทัด -->

			<!-- ฟอร์มเพิ่มรายการในตาราง -->
			<div <?php echo "ng-init='targets = dataList($targets_json)'"; ?>>
				<div ng-show="targets.length !== 0">
					<form class="form-inline" ng-submit="addList2()" >
						<div class="form-group">
							<select class="form-control" ng-model="name2" id="selectSource" name="selectSource">
								<option value="">-</option>
								<option ng-repeat="target in targets | orderBy: 'source_name'" value={{target}}> {{target.source_name}} </option>
							</select>
						</div>
						<div class="form-group">
							<input type="number" class="form-control" ng-model="capacity2" placeholder="จำนวน/ความจุ">
						</div>
						<button type="submit" class="btn btn-default">
							เพิ่ม
						</button>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="container" ng-show="myStep===2">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th></th>
					<th ng-repeat="list in dataTable">{{list.name}}</th>
					<th></th>
				</tr>
			</thead>
			<tbody <?php echo "ng-init='costs = $costs_json'"; ?>>
				<tr ng-repeat="list2 in dataTable2">
					<th>{{list2.name}}</th>
					<td ng-repeat="list in dataTable">
						<input type="number" value="{{checkCost(list.id, list2.id)}}" class="form-control">
					</td>
					<th>{{list2.capacity}}</th>
				</tr>
				<tr>
					<td></td>
					<td ng-repeat="list in dataTable">
						{{list.capacity}}
					</td>
					<td></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="container" ng-show="myStep===1">
		<button class="btn btn-success" ng-click="changeStep(2)">ต่อไป</button>
	</div>

	<div class="container" ng-show="myStep===2">
		<button class="btn btn-success" ng-click="changeStep(1)">กลับ</button>
	</div>

</div>
<!-- ปิดแท็ก div ของการเรียกใช้ listTableCtrl -->
