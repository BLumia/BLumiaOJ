
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<?php require("./pages/components/contest_heading.php");?>
			<div class="row">
				<div class="col-md-8">
					<h2><?php echo $contestItem[0]['title'];?> <small>Contest Description </small></h2>
					<p class="lead">
						<?php echo $contestItem[0]['description'];?>
					</p>
				</div>
				<div class="col-md-4">
					<h3>Contest Infomation</h3>
					<p>
						比赛编号: <font class="text-muted"><?php echo $contestItem[0]['contest_id'];?></font><br/>
						开始时间: <font class="text-primary"><?php echo $contestItem[0]['start_time'];?></font><br/>
						截止时间: <font class="text-primary"><?php echo $contestItem[0]['end_time'];?></font><br/>
						比赛性质: <font class="text-success"><?php echo $contestItem[0]['private']?"Private":"Public";?></font><br/>
						比赛状态: Ended
					</p>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>