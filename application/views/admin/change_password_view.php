<div class="container">
	<h2>CHANGE PASSWORD</h2>
	
	<?php 
		echo form_open('admin/check_password');
	 ?>
	 	<div class="col-md-6">
	 		<div class="form-group">
				<label for="txtPassword">รหัสผ่าน</label>
				<input type="text" class="form-control" name="txtPassword" id="txtPassword" placeholder="กรอกรหัสผ่าน 8-12 ตัวอักษร">
			</div>
			<div class="form-group">
				<label for="txtNewPassword">รหัสผ่านใหม่</label>
				<input type="text" class="form-control" name="txtNewPassword" id="txtNewPassword" placeholder="กรอกรหัสผ่านใหม่ 8-12 ตัวอักษร">
			</div>
			<div class="form-group">
				<label for="txtReNewPassword">ยืนยันรหัสผ่านใหม่</label>
				<input type="text" class="form-control" name="txtReNewPassword" id="txtReNewPassword" placeholder="กรอกยืนยันรหัสผ่านใหม่ 8-12 ตัวอักษร">
			</div>
			<button type="submit" class="btn btn-success">บันทึกการเปลี่ยนแปลง</button>
	 	</div>
	</form>
</div>
