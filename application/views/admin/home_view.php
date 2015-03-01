<div class="container">
	<h1>ADMIN HOME</h1>
	
	<?php 
		$attributes = array('class' => 'form-inline');
		echo form_open('admin/add_user', $attributes);
	 ?>
		<div class="form-group">
			<label for="txtUsername">ชื่อผู้ใช้</label>
			<input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="กรอกชื่อผู้ใช้">
		</div>
		<button type="submit" class="btn btn-success">เพิ่ม</button>
	</form>
	
</div>

<br>

<div class="container" >
	<div class="col-sm-6">
		<a href="#" class="list-group-item active"><strong>รายชื่อ </strong></a>
		<ul class="list-group ">
			
			<?php foreach($users as $user) { ?>
			<li class="list-group-item">
				<?php echo $user->username; ?>
				
				<!-- link remove user for admin (CONFIRM by MODAL) -->
				<div class="pull-right">
					<a data-toggle="modal" data-msg="ยืนยันการลบผู้ใช้" data-id=<?php echo site_url("admin/remove_user/$user->id"); ?> data-toggle="modal" title="Add this item" style="color: red" data-target=".bs-example-modal-sm" href="#">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</a>
				</div>
				
			</li>
			<?php } ?>
			
		</ul>
	</div>
</div>