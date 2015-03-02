<div class="container">
	<h1>DESTINATION PAGE</h1>
	<div>
		<?php
		$attributes = array('class' => 'form-inline');
		echo form_open('user/add_destination', $attributes);
		?>
		<div class="col-sm-6">
			<div class="form-group">
				<!-- <label for="txtUsername">ชื่อผู้ใช้</label> -->
				<input type="text" class="form-control" name="txtUsername" id="txtUsername" placeholder="กรอกชื่อผู้ใช้">
			</div>
			<button type="submit" class="btn btn-success">
				เพิ่ม
			</button>
		</div>
		</form>
	</div>
</div>

<br>

<div class="container" >
	<div class="col-sm-6">
		<a href="#" class="list-group-item active"><strong>รายชื่อปลายทาง </strong></a>
		<ul class="list-group ">

			<style>
				.x_user {
					color: red;
				}
			</style>

			<?php foreach($destinations as $destination) {
			?>
			<li class="list-group-item">
				<?php echo $destination -> destination_name; ?>
				<div class="pull-right">
					<a data-toggle="modal" data-id="" data-toggle="modal" title="Add this item" class="open-ConfirmDialog x_user" data-target=".bs-example-modal-sm" href="#addBookDialog"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>
				</div>

			</li>
			<?php } ?>
		</ul>
	</div>
</div><?php print_r($destinations); ?>
