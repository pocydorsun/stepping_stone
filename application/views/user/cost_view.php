<div class="container">
	<h2>กำหนดค่าขนส่ง</h2>
</div>

<div class="container">
	<?php $targets_json = json_encode($targets); ?>

	<?php $attributes = array('class' => 'form-inline'); ?>
	<?php echo form_open('user/save_cost', $attributes); ?>
	<div class="form-group">
		<label for="selectSource">ต้นทาง</label>
		<select class="form-control" id="selectSource" name="selectSource" <?php echo "ng-init='targets = $targets_json'"; ?>>
			<option value="">-</option>
			<option ng-repeat="target in targets" value={{target.id}}> {{target.target_name}} </option>
		</select>
	</div>
	<div class="form-group">
		<label for="selectDestination">ปลายทาง</label>
		<select class="form-control" id="selectDestination" name="selectDestination" <?php echo "ng-init='targets = $targets_json'"; ?>>
			<option value="">-</option>
			<option ng-repeat="target in targets" value={{target.id}}> {{target.target_name}} </option>
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

<div class="container">
	<div class="col-sm-6">
		<?php $costs_json = json_encode($costs); ?>
		<?php $targets_r_json = json_encode($targets_r); ?>
		<ul class="list-group" <?php echo "ng-init='costs = $costs_json; targets_r = $targets_r_json'" ?>>
			{{target_r}}
			<!-- SEARCH -->
			<li class="list-group-item">
				<div class="input-group">
					<input type="text" class="form-control" ng-model="searchText" placeholder="ค้นหา...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</button> </span>
				</div>
			</li>

			<!-- LIST OF COST -->
			<li class="list-group-item" ng-repeat="cost in filtered = (costs | filter:searchText)">
				<span>{{cost}}</span>
			</li>

			<!-- NO LIST USERNAME -->
			<li class="list-group-item" ng-show="filtered == 0">
				ไม่พบข้อมูล
			</li>
		</ul>
	</div>
</div>

<div class="container">
	<br>
	<div class="well">
		<h3>targets</h3>
		<?php print_r($targets); ?>
	</div>
</div>