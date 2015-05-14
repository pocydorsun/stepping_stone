<div class="container">
	<div class=" well well-white">
		<div class="container">
			<font color="#0000FF" size="6">จัดการผู้ใช้</font>
		</div>
		<br>
		<div class="container">
			<div>

				</form>
				<div class="col-md-6 col-md-offset-10">
					<a href=<?php echo site_url("admin/add_user"); ?> class="btn btn-success">เพิ่มผู้ใช้งาน</a>
				</div>
			</div>
		</div>

		<br>

		<!-- table user -->
		<div class="container">
			<div class="col-sm-11">
				<?php $users_json = json_encode($users); ?>
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
					<th> ชื่อผู้ใช้ </th>
					<th> ชื่อ </th>
					<th> นามสกุล </th>
				</tr>
			</thead>
			<tbody <?php echo "ng-init='users = $users_json'" ?>>
				<tr ng-repeat="user in filtered = (users | filter:searchText)">
					<td> {{user.username}} </td>
					<td> {{user.firstname}} </td>
					<td> {{user.lastname}} </td>
					<td>
					<button data-toggle="modal"
					data-title="แก้ไขค่าขนส่ง"
					data-msg="<input type='text' class='form-control' name='txtFirstname' value='{{user.firstname}}'><br><input type='text' class='form-control' name='txtLastname' value='{{user.lastname}}'><br><input type='password' class='form-control' name='txtpassword' placeholder='******'><br><input type='password' class='form-control' name='txtrepassword' placeholder='******'>"
					data-button="บันทึก"
					data-class="btn btn-success"
					data-id=<?php echo site_url("admin/edit_user/"); ?>{{"/"+user.id}}
					class="open-ConfirmDialog btn btn-xs btn-default"
					data-target=".my-modal">

						<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					</button>
					
					<button data-toggle="modal"
					data-title="คำเตือน"
					data-msg="ยืนยันการลบ"
					data-button="ยืนยัน"
					data-class="btn btn-danger"
					data-id=<?php echo site_url("admin/remove_user/"); ?>{{"/"+user.id}}
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

