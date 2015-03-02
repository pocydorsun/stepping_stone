<div class="container">
	<h1>target PAGE</h1>
	<div>
		<?php
		$attributes = array('class' => 'form-inline');
		echo form_open('user/add_target', $attributes);
		?>
		<div class="col-sm-6">
			<div class="form-group">
				<!-- <label for="txtTarget">ชื่อเป้าหมาย</label> -->
				<input type="text" class="form-control" name="txtTarget" id="txtTarget" placeholder="กรอกชื่อเป้าหมาย">
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
		<a href="#" class="list-group-item active"><strong>รายชื่อเป้าหมาย </strong></a>
		<ul class="list-group ">

			<style>
				.x_user {
					color: red;
				}
			</style>

			<?php foreach($targets as $target) {
			?>
			<li class="list-group-item">
				<?php echo $target -> target_name; ?>
				<div class="pull-right">
					<a data-toggle="modal" data-id="" data-toggle="modal" title="Add this item" class="open-ConfirmDialog x_user" data-target=".bs-example-modal-sm" href="#addBookDialog"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>
				</div>

			</li>
			<?php } ?>
		</ul>
	</div>
</div><?php print_r($targets); ?>
