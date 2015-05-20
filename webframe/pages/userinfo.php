
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				
					<h1><?php echo $user_name; ?> <small>ID: <?php echo $user_id;?></small></h1>
					<ol class="breadcrumb">
						<li><a href="userinfo.php"><i class="icon-dashboard"></i> User Page</a></li>
						<li class="active"><i class="icon-file-alt"></i> User Info</li>
					</ol>
					
					<div class="row">
						<div class="col-lg-3 col-sm-3">
							<div class="panel panel-info">
							<div class="panel-heading">
								<div class="row">
								<div class="col-xs-6">
									<i class="fa fa-check fa-5x"></i>
								</div>
								<div class="col-xs-6 text-right">
									<p class="medal-heading"><?php echo $user_ac; ?></p>
									<p class="medal-text">Accepted!</p>
								</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer medal-bottom">
								<div class="row">
									<div class="col-xs-9">
									Recent Accepted
									</div>
									<div class="col-xs-3 text-right">
									<i class="fa fa-arrow-circle-right"></i>
									</div>
								</div>
								</div>
							</a>
							</div>
						</div>
						<div class="col-lg-3 col-sm-3">
							<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
								<div class="col-xs-6">
									<i class="fa fa-code fa-5x"></i>
								</div>
								<div class="col-xs-6 text-right">
									<p class="medal-heading"><?php echo $user_submit;?></p>
									<p class="medal-text">Challenged!</p>
								</div>
								</div>
							</div>
							<a href="ranking.php">
								<div class="panel-footer medal-bottom">
								<div class="row">
									<div class="col-xs-9">
									Full Challenged
									</div>
									<div class="col-xs-3 text-right">
									<i class="fa fa-arrow-circle-right"></i>
									</div>
								</div>
								</div>
							</a>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6">
							<div class="panel panel-default">
							<div class="panel-heading">
								<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-user fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<p class="medal-heading"><?php echo $user_name; ?></p>
									<p class="medal-text">e-mail: <?php echo $user_email; ?></p>
								</div>
								</div>
							</div>
							<a href="#">
								<div class="panel-footer medal-bottom">
								<div class="row">
									<div class="col-xs-6">
									(See Introduction)
									</div>
									<div class="col-xs-6 text-right">
									<i class="fa fa-arrow-circle-right"></i>
									</div>
								</div>
								</div>
							</a>
							</div>
						</div>
					</div><!-- /.row -->
			
				</div>
			</div><!-- /.row, 3 medal -->
			<!-- 显示一个统计图 -->
			<!-- 显示其他信息 -->
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>