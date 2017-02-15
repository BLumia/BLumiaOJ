<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<?php require_once('./include/contest_functions.inc.php'); ?>
		<title><?php echo L_CONTEST." - {$OJ_NAME}";?></title>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<?php require("./pages/components/contest_heading.php");?>
			<div class="row">
				<div class="col-md-8">
					<h2><?php echo $contestItem['title'];?> <small><?php echo L_CONTEST_DESC;?> </small></h2>
					<p class="lead">
						<?php echo $contestItem['description'];?>
					</p>
				</div>
				<div class="col-md-4">
					<h3><?php echo L_CONTEST_INFO;?></h3>
					<p>
						<?php echo L_CONTEST_ID;?>: <font class="text-muted"><?php echo $contestItem['contest_id'];?></font><br/>
						<?php echo L_START_TIME;?>: <font class="text-primary"><?php echo $contestItem['start_time'];?></font><br/>
						<?php echo L_END_TIME;?>: <font class="text-primary"><?php echo $contestItem['end_time'];?></font><br/>
						比赛性质: <font class="text-success"><?php echo $contestItem['private']?L_Private:L_Public;?></font><br/>
						比赛状态: <?php echo $contestState;?>
					</p>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>
</html>
