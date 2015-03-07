<!DOCTYPE html>
<html lang="en" ng-app>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Stepping Stone</title>

		<!-- CSS -->
		<link rel="stylesheet" href=<?php echo base_url("asset/bootstrap/css/bootstrap.min.css"); ?>>

		<!-- JS -->
		<script src=<?php echo base_url("asset/jquery/jquery.min.js"); ?>></script>
		<script src=<?php echo base_url("asset/bootstrap/js/bootstrap.min.js"); ?>></script>
		<script src=<?php echo base_url("asset/angular/angular.min.js"); ?>></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->

				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      
				      <?php $login_sess = $this->session->userdata('logged_in'); ?>
				      
				      <?php if ($login_sess['status'] == 'admin') :?>
				      <a class="navbar-brand" href=<?php echo site_url("admin");?>>Stepping Stone</a>
				      
				      <?php elseif ($login_sess['status'] == 'user') :?>
				      <a class="navbar-brand" href=<?php echo site_url("user/plan");?>>Stepping Stone</a>
				      
				      <?php else : ?>
				      <a class="navbar-brand" href=<?php echo base_url();?>>Stepping Stone</a>
				      <?php endif; ?>
				      
				    </div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					
					<!-- LOGIN ADMIN -->
					
					<?php if ($login_sess['status'] == 'admin') :?>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li>
								<a href=<?php echo site_url("admin");?>>จัดการผู้ใช้</a>
							</li>
							<li>
								<a href=<?php echo site_url("admin/approve");?>>อนุมัติรายงาน</a>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href=<?php echo site_url("admin/change_password");?>>แก้ไขรหัสผ่าน</a>
							</li>
							<li>
								<a href=<?php echo site_url("logout");?>>ออกจากระบบ</a>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
					<?php endif; ?>
					
					
					<!-- LOGIN USER -->
					<?php if ($login_sess['status'] == 'user') :?>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li>
								<a href="<?php echo site_url("user/plan");?>">จัดการแผนการขนส่ง</a>
							</li>
							<li>
								<a href="<?php echo site_url("user/target");?>">จัดการเป้าหมาย</a>
							</li>
							<li>
								<a href="<?php echo site_url("user/cost");?>">กำหนดค่าขนส่ง</a>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href=<?php echo site_url("user/profile");?>>แก้ไขข้อมูลส่วนตัว</a>
							</li>
							<li>
								<a href=<?php echo site_url("logout");?>>ออกจากระบบ</a>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
					<?php endif; ?>
					
				</div><!-- /.container-fluid -->
			</nav>
		</div>
		
		<!-- ALERT ERROR MESSAGE -->
		<?php if ($this->session->flashdata('error_msg')) : ?>
		<div class="container">
			<div class="alert alert-warning" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  				<span aria-hidden="true">&times;</span>
				</button><?php echo $this->session->flashdata('error_msg'); ?>
			</div>	
		</div>
		<?php endif; ?>
		
		<!-- ALERT SUCCESS MESSAGE -->
		<?php if ($this->session->flashdata('success_msg')) : ?>
		<div class="container">
			<div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  				<span aria-hidden="true">&times;</span>
				</button><?php echo $this->session->flashdata('success_msg'); ?>
			</div>	
		</div>
		<?php endif; ?>
