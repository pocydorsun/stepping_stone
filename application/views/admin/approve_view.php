<div class="container">
	<div class=" well well-white">
		<div class="container">
			<font color="#0000FF" size="6">อนุมัติรายงาน</font>
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
							
							<a class="btn btn-default btn-xs" href=<?php echo site_url("admin/Aplan_view"); ?>{{"/"+plan.id}}><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a>
							
							<button data-toggle="modal"
							data-title="คำเตือน"
							data-msg="อนุมัติรายงาน"
							data-button="ยืนยัน"
							data-class="btn btn-success"
							data-id=<?php echo site_url("admin/plan_approve/"); ?>{{"/"+plan.id}}
							class="open-ConfirmDialog btn btn-xs btn-default"
							data-target=".my-modal">
								<span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
							</button>
							<button data-toggle="modal"
							data-title="คำเตือน"
							data-msg="ไม่อนุมัติรายงาน"
							data-button="ยืนยัน"
							data-class="btn btn-danger"
							data-id=<?php echo site_url("admin/plan_not_approve/"); ?>{{"/"+plan.id}}
							class="open-ConfirmDialog btn btn-xs btn-default"
							data-target=".my-modal">
								<span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
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