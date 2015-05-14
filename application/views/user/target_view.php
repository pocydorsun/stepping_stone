<?php if ($this->session->flashdata('y') === 'active') : ?>
<div class="container" ng-init="x = ''; y ='active'">
<?php else : ?>
	<div class="container" ng-init="x = 'active'; y =''">
<?php endif ?>
	<div class=" well well-white">
		<div class="container">

				<font color="#0000FF" size="6">จัดการเป้าหมาย</font>

			<div>
				<?php
				$attributes = array('class' => 'form-inline');
				echo form_open('user/add_target', $attributes);
				?>
				<div class="col-sm-6">
					<input type="text" name="y" value={{y}} ng-hide="true">
					<input type="text" class="form-control" name="txtTarget" id="txtTarget" placeholder="กรอกชื่อเป้าหมาย">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="typeSource" value="true">
							เพิ่มต้นทาง</label>
					</div>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="typeDestination" value="true">
							เพิ่มปลายทาง</label>
					</div>
					<button type="submit" class="btn btn-success">
						เพิ่ม
					</button>
				</div>
				</form>
			</div>
		</div>
		<br>

		<div class="container">
			<div class="col-sm-6">
				<ul class="nav nav-pills">
				  <li role="presentation" class={{x}}><a href="" ng-click="x = 'active'; y=''">ต้นทาง</a></li>
				  <li role="presentation" class={{y}}><a href="" ng-click="x = ''; y='active'">ปลายทาง</a></li>
				</ul>

				<br>

				<div ng-show="x === 'active'">
					<?php $sources_json = json_encode($sources); ?>
					<ul class="list-group" <?php echo "ng-init='sources = $sources_json'"; ?>>

						<li class="list-group-item">
							<div class="input-group">
								<input type="text" class="form-control" ng-model="searchText" placeholder="ค้นหา...">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</button> </span>
							</div>
						</li>

						<li class="list-group-item" ng-repeat="list in filtered = (sources | filter:searchText)">

							{{list.source_name}}

							<span class="pull-right">
								<button data-toggle="modal"
								data-title="แก้ไข"
								data-msg="<input type='text' class='form-control' name='txtTargetName' value='{{list.source_name}}'>"
								data-button="บันทึก"
								data-class="btn btn-success"
								data-id=<?php echo site_url("user/edit_source/"); ?>{{"/"+list.id}}
								class="open-ConfirmDialog btn btn-xs btn-default"
								data-target=".my-modal">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
								</button>
								<button data-toggle="modal"
								data-title="คำเตือน"
								data-msg="ยืนยันการลบ"
								data-button="ยืนยัน"
								data-class="btn btn-danger"
								data-id=<?php echo site_url("user/remove_source/"); ?>{{"/"+list.id}}
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

				<div ng-show="y === 'active'">
					<?php $destinations_json = json_encode($destinations); ?>
					<ul class="list-group" <?php echo "ng-init='destinations = $destinations_json'"; ?>>

						<li class="list-group-item">
							<div class="input-group">
								<input type="text" class="form-control" ng-model="searchText" placeholder="ค้นหา...">
								<span class="input-group-btn">
									<button class="btn btn-default" type="button">
										<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
									</button> </span>
							</div>
						</li>

						<li class="list-group-item" ng-repeat="list in filtered = (destinations | filter:searchText)">

							{{list.destination_name}}

							<span class="pull-right">
								<button data-toggle="modal"
								data-title="แก้ไข"
								data-msg="<input type='text' class='form-control' name='txtTargetName' value='{{list.destination_name}}'>"
								data-button="บันทึก"
								data-class="btn btn-success"
								data-id=<?php echo site_url("user/edit_destination/"); ?>{{"/"+list.id}}
								class="open-ConfirmDialog btn btn-xs btn-default"
								data-target=".my-modal">
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
								</button>
								<button data-toggle="modal"
								data-title="คำเตือน"
								data-msg="ยืนยันการลบ"
								data-button="ยืนยัน"
								data-class="btn btn-danger"
								data-id=<?php echo site_url("user/remove_destination/"); ?>{{"/"+list.id}}
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
		</div>
	</div>
</div>
