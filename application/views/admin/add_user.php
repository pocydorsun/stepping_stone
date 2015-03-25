<div class="container">
	<div class=" well well-white">
		<div class="container">
			<?php
			echo form_open('admin/add_new_user');
			?>
			<div class="col-md-5 col-md-offset-3">

				<div class="form-group">
					<label for="txtFirstname">ชื่อ</label>
					<input type="text" class="form-control" name="txtFirstname" id="txtFirstname" placeholder="ชื่อ">
				</div>
				<div class="form-group">
					<label for="txtLastname">นามสกุล</label>
					<input type="text" class="form-control" name="txtLastname" id="txtLastname" placeholder="นามสกุล">
				</div>
				<div class="form-group">
					<label for="txtUsername">ชื่อผู้ใช้</label>
					<input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="ชื่อผู้ใช้">
				</div>
				<div class="form-group">
					<label for="txtPassword">รหัสผ่าน</label>
					<input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="รหัสผ่าน">
				</div>
				<button type="submit" class="btn btn-success">
					เพิ่ม
				</button>
			</div>
		</div>
	</div>
</div>