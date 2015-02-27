<!DOCTYPE html>
<html lang="en">
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
				      <a class="navbar-brand" href="#">Stepping Stone</a>
				    </div>
					
					<!-- Collect the nav links, forms, and other content for toggling -->
					
					<!-- LOGIN -->
					<?php $login_sess = $this->session->userdata('logged_in'); ?>
					<?php if ($login_sess) : ?>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li>
								<a href=<?php echo site_url("admin");?>>จัดการผู้ใช้</a>
							</li>
							<li>
								<a href="#">อนุมัติรายงาน</a>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href=<?php echo site_url("logout");?>>ออกจากระบบ</a>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
					<?php endif; ?>
					
				</div><!-- /.container-fluid -->
			</nav>
		</div>
