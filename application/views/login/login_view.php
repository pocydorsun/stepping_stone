<div class="container">
	<?php echo validation_errors(); ?>
	<?php echo form_open('VerifyLogin'); ?>
		<div class="row">
			<div class="col-lg-4 col-lg-offset-4">
				<br><br>
				<h3>เข้าสู่ระบบ</h3>
				<input type="username" class="form-control" name="txtUsername" placeholder="ชื่อผู้ใช้">
				<br>
				<input type="password" class="form-control" name="txtPassword" placeholder="รหัสผ่าน">
				<br>
				<button type="submit" class="btn btn-success">
					เข้าสู่ระบบ
				</button>
			</div>
		</div>
	</form>
	<br><br>
</div>