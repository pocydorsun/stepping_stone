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


	<br>

	<div class="container" >
		<div class="col-sm-6">
			<a href="#" class="list-group-item active"><strong>รายชื่อ </strong></a>
			<ul class="list-group ">

				<style>
					.x_user {
						color: red;
					}
				</style>

				<?php foreach($users as $user) {
				?>
				<li class="list-group-item">
					<?php echo $user -> username; ?>
					<div class="pull-right">
						<a data-toggle="modal" data-id=<?php echo site_url("admin/remove_user/$user->id"); ?> data-toggle="modal" title="Add this item" class="open-ConfirmDialog x_user" data-target=".bs-example-modal-sm" href="#addBookDialog"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>
					</div>

				</li>
				<?php } ?>
			</ul>
		</div>
	</div>

	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
			<div class="modal-content">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="myModalLabel">คำเตือน</h4>
					</div>
					<div class="modal-body">
						ยืนยันการลบผู้ใช้
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">
							ยกเลิก
						</button>
						<a class="btn btn-danger" name="userId" id="userId" href="#">ยืนยัน</a>
					</div>
				</div>
			</div>
		</div>

		<script>
			$(document).on("click", ".open-ConfirmDialog", function() {
				var userId = $(this).data('id');
				$(".modal-footer #userId").attr("href", userId);
			});
		</script>
=======
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
>>>>>>> origin/master
