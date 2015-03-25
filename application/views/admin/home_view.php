<div class="container">
	<div class=" well well-white">
		<div class="container">
			<center>
			<font color="#0000FF" size="6">จัดการผู้ใช้</font>
			</center>
			<div>
				<!-- <?php
				$attributes = array('class' => 'form-inline');
				echo form_open('admin/add_user', $attributes);
				?>
				<div class="col-sm-6">

				<div class="form-group">
				<input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="กรอกชื่อผู้ใช้">
				</div>
				<button type="submit" class="btn btn-success">
				เพิ่ม
				</button>
				</div>
				</form> -->
				<a href=<?php echo site_url("admin/add_user"); ?> class="btn btn-success">เพิ่มผู้ใช้งาน</a>
			</div>
		</div>

		<br>

		<div class="container" >
			<div class="col-sm-6">

				<?php $users_json = json_encode($users); ?>
				<ul class="list-group" <?php echo "ng-init='users = $users_json'"; ?>>

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

					<!-- LIST USERNAME -->
					<li class="list-group-item" ng-repeat="user in filtered = (users | filter:searchText)">
						{{user.username}}

						<!-- link remove user for admin (CONFIRM by MODAL) -->
						<span class="pull-right">
							<button data-toggle="modal"
							data-title="คำเตือน"
							data-msg="ยืนยันการลบ"
							data-button="ยืนยัน"
							data-class="btn btn-danger"
							data-id=<?php echo site_url("admin/remove_user/"); ?>{{"/"+user.id}}
							class="open-ConfirmDialog btn btn-xs btn-default"
							data-target=".my-modal">

								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button> </span>

					</li>

					<!-- NO LIST USERNAME -->
					<li class="list-group-item" ng-show="filtered == 0">
						ไม่พบข้อมูล
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

