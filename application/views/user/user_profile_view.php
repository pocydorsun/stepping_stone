<div class="container">
	<div class=" well well-white">
		<div class="container">
			<center>
				<font color="#0000FF" size="6">แก้ไขรหัสผ่าน</font>
			</center>

			<?php echo form_open('user/check_password'); ?>
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

<br>
<br>
<div class="container">
	<div class=" well well-white">
		<div class="container">
			<center>
				<font color="#0000FF" size="6">แก้ไขชื่อผู้ใช้</font>
			</center>
			<?php
			$firstname = $name[0]['firstname'];
			$lastname = $name[0]['lastname'];
			?>
			<?php echo form_open('user/change_name'); ?>
			<div class="col-md-6">
				<div class="form-group">
					<label for="txtFirstname">ชื่อ</label>
					<input type="text" class="form-control" name="txtFirstname" id="txtFirstname" placeholder="ชื่อ" value=<?php echo $firstname; ?>>
				</div>
				<div class="form-group">
					<label for="txtLastname">นามสกุล</label>
					<input type="text" class="form-control" name="txtLastname" id="txtLastname" placeholder="นามสกุล" value=<?php echo $lastname; ?>>
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