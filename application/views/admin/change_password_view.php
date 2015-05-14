<div class="container">
	<div class=" well well-white">
		<div class="container">
			<font color="#0000FF" size="6">แก้ไขรหัสผ่าน</font>
			<?php
			echo form_open('admin/check_password');
			?>
			<div class="col-md-6">
				<div class="form-group">
					<label for="txtPassword">รหัสผ่าน</label>
					<input type="password" class="form-control" name="txtPassword" id="txtPassword" placeholder="กรอกรหัสผ่าน 8-12 ตัวอักษร">
				</div>
				<div class="form-group">
					<label for="txtNewPassword">รหัสผ่านใหม่</label>
					<input type="password" class="form-control" name="txtNewPassword" id="txtNewPassword" placeholder="กรอกรหัสผ่านใหม่ 8-12 ตัวอักษร">
				</div>
				<div class="form-group">
					<label for="txtReNewPassword">ยืนยันรหัสผ่านใหม่</label>
					<input type="password" class="form-control" name="txtReNewPassword" id="txtReNewPassword" placeholder="กรอกยืนยันรหัสผ่านใหม่ 8-12 ตัวอักษร">
				</div>
				<div class="col-md-6 col-md-offset-10">
					<button type="submit" class="btn btn-success">
						บันทึกการเปลี่ยนแปลง
					</button>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
