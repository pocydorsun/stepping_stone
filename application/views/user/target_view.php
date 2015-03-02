<div class="container">
	<h1>target PAGE</h1>
	<div>
		<?php
		$attributes = array('class' => 'form-inline');
		echo form_open('user/add_target', $attributes);
		?>
		<div class="col-sm-6">
			<div class="form-group">
				<!-- <label for="txtTarget">ชื่อเป้าหมาย</label> -->
				<input type="text" class="form-control" name="txtTarget" id="txtTarget" placeholder="กรอกชื่อเป้าหมาย">
			</div>
			<button type="submit" class="btn btn-success">
				เพิ่ม
			</button>
		</div>
		</form>
	</div>
</div>
<br>

<div class="container" >
	<div class="col-sm-6">

		<?php $targets_json = json_encode($targets); ?>
		<ul class="list-group" <?php echo "ng-init='targets = $targets_json'"; ?>>

			<li class="list-group-item">
				<div class="input-group">
					<input type="text" class="form-control" ng-model="searchText" placeholder="ค้นหา...">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						</button> </span>
				</div>
			</li>

			<li class="list-group-item" ng-repeat="target in filtered = (targets | filter:searchText)">
				{{target.target_name}}

				<div class="pull-right">
					<a href="" data-toggle="modal" data-msg="ยืนยันการลบเป้าหมาย" data-id=<?php echo site_url("user/remove_target/"); ?>{{"/"+target.id}} data-toggle="modal" class="open-ConfirmDialog" title="Add this item" style="color: red" data-target=".bs-example-modal-sm"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>
				</div>

			</li>
			<li class="list-group-item" ng-show="filtered == 0">
				ไม่พบข้อมูล
			</li>

		</ul>
	</div>
</div>