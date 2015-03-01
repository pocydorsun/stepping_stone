<div class="container">
	<h1>SOURCE PAGE</h1>
	<div>
		<?php
		$attributes = array('class' => 'form-inline');
		echo form_open('user/add_source', $attributes);
	?>
		<button type="submit" class="btn btn-success">
			เพิ่มต้นทาง
		</button>
		</form>
	</div>
	<br>
	<div class="container" >
		<div class="col-sm-6">
			<a href="#" class="list-group-item active"><strong>รายชื่อต้นทาง </strong></a>
			<ul class="list-group ">

				<style>
					.x_user {
						color: red;
					}
				</style>

				<?php foreach($sources as $source) {
				?>
				<li class="list-group-item">
					<?php echo $source -> source_name; ?>
					<div class="pull-right">
						<a data-toggle="modal" data-id="" data-toggle="modal" title="Add this item" class="open-ConfirmDialog x_user" data-target=".bs-example-modal-sm" href="#addBookDialog"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </a>
					</div>

				</li>
				<?php } ?>
			</ul>
		</div>
	</div><?php print_r($sources); ?>
