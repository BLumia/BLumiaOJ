<!DOCTYPE html>
<html>
<head>
	<?php require_once('../include/admin_head.inc.php'); ?>
	<link rel="stylesheet" type="text/css" href="../sitefiles/css/bootstrap-select.min.css">
	<script type="text/javascript" src="../sitefiles/js/bootstrap-select.min.js"></script>
	<title><?php echo LA_ACCOUNT_GEN." - {$OJ_NAME}";?></title>
</head>	
<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1><?php echo LA_ACCOUNT_GEN;?> <small>Control Panel</small></h1>
		</div>
		<p class="lead">
			您可以使用账号生成器生成账号，以便用于竞赛或其它用途。
		</p>
		<div class="well">
			<form class="form" method="POST">
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label>输入账号前缀（如team）: </label><br/>
						<input type='text' name='prefix' class="form-control" placeholder="Account ID prefix here">
					</div><br/>
					<div class="form-group">
						<label>输入要生成的账号数量: </label><br/>
						<input type="text" class="form-control" name='teamnumber' value=50 placeholder="A Number Here">
					</div><br/><br/>
					<?php require_once('../include/pageauth_post.php'); ?>
					<button value=Generate type="submit" class="btn btn-default"><?php echo L_SUBMIT;?></button>
					</div>
					<div class="col-md-6">
						<label>用户列表（如果需要）: </label><br/>
						<textarea class="form-control" name="ulist" rows="9"><?php if (isset($ulist)) { echo $ulist; } ?></textarea>
					</div>
				</div>
			</form><br/>
		</div>
	</div>
</body>
</html>