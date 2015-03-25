<div class="container">
	<div class=" well well-white">
		<div class="container">
			<center>
				<font color="#0000FF" size="6">กำหนดค่าขนส่ง</font>
			</center>
		</div>
		<br>
		<div class="container">
			<?php $sources_json = json_encode($sources); ?>
			<?php $destinations_json = json_encode($destinations); ?>

			<?php $attributes = array('class' => 'form-inline'); ?>
			<?php echo form_open('user/save_cost', $attributes); ?>
			<div class="form-group">
				<label for="selectSource">ต้นทาง</label>
				<select class="form-control" id="selectSource" name="selectSource" <?php echo "ng-init='sources = $sources_json'"; ?>>
					<option value="">-</option>
					<option ng-repeat="source in sources" value={{source.id}}> {{source.source_name}} </option>
				</select>
			</div>
			<div class="form-group">
				<label for="selectDestination">ปลายทาง</label>
				<select class="form-control" id="selectDestination" name="selectDestination" <?php echo "ng-init='destinations = $destinations_json'"; ?>>
					<option value="">-</option>
					<option ng-repeat="destination in destinations" value={{destination.id}}> {{destination.destination_name}} </option>
				</select>
			</div>
			<div class="form-group">
				<label for="inputCost">ค่าขนส่ง</label>
				<input type="number" class="form-control" name="inputCost" id="inputCost" value="0">
			</div>
			<button type="submit" class="btn btn-success">
				บันทึก
			</button>
			</form>
		</div>

		<br>
		<br>

		<!-- table cost -->
		<div class="container">
			<div class="col-sm-11">
				<?php $costs_json = json_encode($costs); ?>
				<div class="input-group">
					<input type="text" class="form-control" ng-model="searchText" placeholder="ค้นหา...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</button> </span>
				</div>
			</div>
		</div>
		<br>
		<table class="table">
			<thead>
				<tr>
					<th> ต้นทาง </th>
					<th> ปลายทาง </th>
					<th> ค่าขนส่ง </th>
				</tr>
			</thead>
			<tbody <?php echo "ng-init='costs = $costs_json'" ?>>
				<tr ng-repeat="cost in filtered = (costs | filter:searchText)">
					<td> {{cost.source_name}} </td>
					<td> {{cost.destination_name}} </td>
					<td> {{cost.cost}} </td>
					<td>
					<button data-toggle="modal"
					data-title="แก้ไขค่าขนส่ง"
					data-msg="<input type='text' class='form-control' name='txtCost' value='{{cost.cost}}'>"
					data-button="บันทึก"
					data-class="btn btn-success"
					data-id=<?php echo site_url("user/edit_cost/"); ?>{{"/"+cost.cost_id}}
					class="open-ConfirmDialog btn btn-xs btn-default"
					data-target=".my-modal">

						<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					</button>
					<button data-toggle="modal"
					data-title="คำเตือน"
					data-msg="ยืนยันการลบ"
					data-button="ยืนยัน"
					data-class="btn btn-danger"
					data-id=<?php echo site_url("user/remove_cost/"); ?>{{"/"+cost.cost_id}}
					class="open-ConfirmDialog btn btn-xs btn-default"
					data-target=".my-modal">

						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button></td>
				</tr>
				<tr ng-show="filtered == 0">
					<td> ไม่พบข้อมูล </td>
					<td> ไม่พบข้อมูล </td>
					<td> ไม่พบข้อมูล </td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
