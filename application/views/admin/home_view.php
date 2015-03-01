<div class="container">
	<h1>ADMIN HOME</h1>
	<div>
		<?php
		$attributes = array('class' => 'form-inline');
		echo form_open('admin/add_user', $attributes);
		?>
		<div class="form-group">
			<label for="txtUsername">ชื่อผู้ใช้</label>
			<input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="กรอกชื่อผู้ใช้">
		</div>
		<button type="submit" class="btn btn-success">
			เพิ่ม
		</button>
		</form>

	</div>
</div>

<br>

Search: <input ng-model="searchText">

<br>



<div class="container" >
	<div class="col-sm-6">
		<a href="#" class="list-group-item active"><strong>รายชื่อ </strong></a>

		<?php $users_json = json_encode($users);?>
		<ul class="list-group" <?php echo "ng-init='users = $users_json'"; ?>>
			
			<li class="list-group-item" ng-repeat="user in filtered = (users | filter:searchText)">
				{{user.username}}
				
				<!-- link remove user for admin (CONFIRM by MODAL) -->
				<div class="pull-right">
					<a data-toggle="modal" data-msg="ยืนยันการลบผู้ใช้" data-id=<?php echo site_url("admin/remove_user/"); ?>{{"/"+user.id}} data-toggle="modal" class="open-ConfirmDialog" title="Add this item" style="color: red" data-target=".bs-example-modal-sm">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</a>
				</div>

			</li>
			<li ng-hide="users.length">ไม่มีชื่อผู้ใช้อยู่ในระบบ</li>
			<li ng-show="filtered == 0">ไม่มีชื่อผู้ใช้อยู่นี้ในระบบ</li>
			
		</ul>
	</div>
</div>

