<div class="container">
	<h1>ADMIN HOME</h1>
	<div>
		<?php
		$attributes = array('class' => 'form-inline');
		echo form_open('admin/add_user', $attributes);
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

		<?php $users_json = json_encode($users);?>
		<ul class="list-group" <?php echo "ng-init='users = $users_json'"; ?>>
			
			<!-- SEARCH -->
			<li class="list-group-item">
			    <div class="input-group">
			      <input type="text" class="form-control" ng-model="searchText" placeholder="ค้นหา...">
			      <span class="input-group-btn">
			        <button class="btn btn-default" type="button">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			        </button>
			      </span>
				</div>
			</li>
			
			<!-- LIST USERNAME -->
			<li class="list-group-item" ng-repeat="user in filtered = (users | filter:searchText)">
				{{user.username}}
				
				<!-- link remove user for admin (CONFIRM by MODAL) -->
				<div class="pull-right">
					<a href="" data-toggle="modal" data-msg="ยืนยันการลบผู้ใช้" data-id=<?php echo site_url("admin/remove_user/"); ?>{{"/"+user.id}} data-toggle="modal" class="open-ConfirmDialog" title="Add this item" style="color: red" data-target=".bs-example-modal-sm">
						<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
					</a>
				</div>

			</li>
			
			<!-- NO LIST USERNAME -->
			<li class="list-group-item" ng-show="filtered == 0">ไม่พบข้อมูล</li>
			
		</ul>
	</div>
</div>

