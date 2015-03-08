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
			<button type="submit" class="btn btn-success">
				สร้างแผน
			</button>
		</div>
		</form>
	</div>
</div>
<br>

<div class="container" >
	<?php $targets_json = json_encode($targets); ?>
	<h2>ต้นทาง</h2>
	<div class="col-sm-6 well well-lg" >
		<!-- เรียกใช้ listTableCtrl ด้วยแท็ก div -->
		<div ng-controller="listTableCtrl">
			<!-- ตารางรายการ -->
			<table class="table" ng-if="dataTable1.length !== 0">
				<thead>
					<tr>
						<th>ชื่อ</th>
						<th>จำนวน/ความจุ</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="list in dataTable1">
						<td>{{list.name}}</td>
						<td>
						<center>
							{{list.capacity}}
						</center></td>
						<td><a ng-click="deleteList($index)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
					</tr>
				</tbody>
			</table>

			<br>
			<!-- เว้นบรรทัด -->

			<!-- ฟอร์มเพิ่มรายการในตาราง -->
			<form class="form-inline" ng-submit="addList()">
				<div class="form-group">
					<select class="form-control" ng-model="name" id="selectSource" name="selectSource" <?php echo "ng-init='targets = $targets_json'"; ?>>
						<option value="">-</option>
						<option ng-repeat="target in targets" value={{target.source_name}}> {{target.source_name}} </option>
					</select>
				</div>
				<div class="form-group">
					<input type="number" class="form-control" ng-model="capacity"  placeholder="จำนวน/ความจุ">
				</div>
				<button type="submit" class="btn btn-default">
					เพิ่ม
				</button>
			</form>
		</div>
	</div>
</div>
<!-- ปิดแท็ก div ของการเรียกใช้ listTableCtrl -->

<div class="container" >
	<?php $targets_json = json_encode($targets); ?>
	<h2>ปลายทาง</h2>
	<div class="col-sm-6 well well-lg" >
		<!-- เรียกใช้ listTableCtrl ด้วยแท็ก div -->
		<div ng-controller="listTableCtrl">
			<!-- ตารางรายการ -->
			<table class="table" ng-if="dataTable1.length !== 0">
				<thead>
					<tr>
						<th>ชื่อ</th>
						<th>จำนวน/ความจุ</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="list in dataTable1">
						<td>{{list.name}}</td>
						<td>
						<center>
							{{list.capacity}}
						</center></td>
						<td><a ng-click="deleteList($index)"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
					</tr>
				</tbody>
			</table>

			<br>
			<!-- เว้นบรรทัด -->

			<!-- ฟอร์มเพิ่มรายการในตาราง -->
			<form class="form-inline" ng-submit="addList()">
				<div class="form-group">
					<select class="form-control" ng-model="name" id="selectSource" name="selectSource" <?php echo "ng-init='targets = $targets_json'"; ?>>
						<option value="">-</option>
						<option ng-repeat="target in targets" value={{target.source_name}}> {{target.source_name}} </option>
					</select>
				</div>
				<div class="form-group">
					<input type="number" class="form-control" ng-model="capacity"  placeholder="จำนวน/ความจุ">
				</div>
				<button type="submit" class="btn btn-default">
					เพิ่ม
				</button>
			</form>
		</div>
	</div>
</div>
<!-- ปิดแท็ก div ของการเรียกใช้ listTableCtrl -->

<?php
print_r($targets)
?>