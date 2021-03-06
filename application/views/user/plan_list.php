<div class="container">
	<div class=" well well-white">
		<div class="container">

			<font color="#0000FF" size="6">รายการแผนการขนส่ง</font>
		</div>
		<br>

		<div class="container" >
			<div class="col-sm-6">

				<?php $plans_json = json_encode($plans); ?>
				<ul class="list-group" <?php echo "ng-init='plans = $plans_json'"; ?>>

					<li class="list-group-item">
						<div class="input-group">
							<input type="text" class="form-control" ng-model="searchText" placeholder="ค้นหา...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">
									<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
								</button> </span>
						</div>
					</li>

					<li class="list-group-item" ng-repeat="plan in filtered = (plans | filter:searchText)">

						{{plan.plan_name}}

						<span class="pull-right">
							<button data-toggle="modal"
							data-title="คำเตือน"
							data-msg="ออกรายงาน"
							data-button="ยืนยัน"
							data-class="btn btn-success"
							data-id=""
							class="open-ConfirmDialog btn btn-xs btn-default"
							data-target=".my-modal">
								<span class="glyphicon glyphicon-print" aria-hidden="true"></span>
							</button>
							
							<a class="btn btn-default btn-xs" href="" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
							
													
							<button data-toggle="modal"
							data-title="คำเตือน"
							data-msg="ยืนยันการลบ"
							data-button="ยืนยัน"
							data-class="btn btn-danger"
							data-id=<?php echo site_url("user/remove_plan/"); ?>{{"/"+plan.id}}
							class="open-ConfirmDialog btn btn-xs btn-default"
							data-target=".my-modal">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</button> </span>
					</li>
					<li class="list-group-item" ng-show="filtered == 0">
						ไม่พบข้อมูล
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>