<div class="container">
	<h1>ADMIN HOME</h1>
	<form class="form-inline">
		<div class="form-group">
			<label for="exampleInputEmail2">ชื่อผู้ใช้</label>
			<input type="email" class="form-control" id="exampleInputEmail2" placeholder="กรอกชื่อผู้ใช้">
		</div>
		<button type="submit" class="btn btn-success">เพิ่ม</button>
	</form>
</div>
<br>
<div class="container" >
	<div class="col-lg-6">
		<a href="#" class="list-group-item active">รายชื่อ </a>
		<ul class="list-group ">
			
			<?php foreach($users as $user) { ?>
			<li class="list-group-item">
				<?php echo $user->username; ?> <?php echo $user->id; ?>
				<span class="glyphicon glyphicon-remove pull-right" aria-hidden="true"></span> 
			</li>
			<?php } ?>
			
		</ul>
	</div>
</div>

<?php print_r($users); ?>