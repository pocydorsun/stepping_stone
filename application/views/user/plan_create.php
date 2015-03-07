<div class="container">
	<h1>PLAN CREATH</h1>
	<div>
		<?php
		$attributes = array('class' => 'form-inline');
		echo form_open('user/add_plan', $attributes);
		?>
		<div class="col-sm-6">
			<div class="form-group">
				<input type="text" class="form-control" name="txtPlan" id="txtPlan" placeholder="กรอกชื่อแผน">
			</div>
			<button type="submit" class="btn btn-success">
				สร้างแผน
			</button>
		</div>
		</form>
	</div>
</div>
<br>