<div class="container">
	<h1>target PAGE</h1>
	<div>
		<?php
		$attributes = array('class' => 'form-inline');
		echo form_open('user/add_target', $attributes);
		?>
		<div class="col-sm-6">
			<div class="form-group">
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

				{{target.source_name}}

				<span class="pull-right">
					<button data-toggle="modal"
					data-title="แก้ไข"
					data-msg="<input type='text' class='form-control' name='txtTargetName' value='{{target.source_name}}'>"
					data-button="บันทึก"
					data-class="btn btn-success"
					data-id=<?php echo site_url("user/edit_target/"); ?>{{"/"+target.id}}
					class="open-ConfirmDialog btn btn-xs btn-default"
					data-target=".my-modal">

						<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					</button>
					<button data-toggle="modal"
					data-title="คำเตือน"
					data-msg="ยืนยันการลบ"
					data-button="ยืนยัน"
					data-class="btn btn-danger"
					data-id=<?php echo site_url("user/remove_target/"); ?>{{"/"+target.id}}
					class="open-ConfirmDialog btn btn-xs btn-default"
					data-target=".my-modal">

						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</button> </span>
			</li>
			<li class="list-group-item" ng-show="filtered == 0">
				ไม่พบข้อมูล
			</li>
		</ul>
	</div>
</div>