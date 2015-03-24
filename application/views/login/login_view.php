<div class="container">
	<div class="well well-white">
		<?php echo form_open('VerifyLogin'); ?>
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 well">
				<br>
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
		<br>
	</div>
</div>