<!DOCTYPE html>
<html>
<head>
	<?php require_once('../include/admin_head.inc.php'); ?>
	<title><?php echo LA_PROB_MAN." - {$OJ_NAME}";?></title>
</head>	
<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1><?php echo LA_PROB_MAN;?> <small>Control Panel</small></h1>
		</div>
		<p class="lead">
			<?php echo LA_PROB_MAN_HEAD;?>
		</p>
		<div class="list-group">
			<a href="./problem_add.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-plus-circle"></i> Add Problem</h4>
				<p class="list-group-item-text"><?php echo LA_ADD_A_PROBLEM;?></p>
			</a>
			<a href="./problem_list.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-th-list"></i> Problem List</h4>
				<p class="list-group-item-text"><?php echo LA_VIEW_PROB_LIST;?></p>
			</a>
			<a href="./problem_import_file.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-file-o"></i> Import Problem From File</h4>
				<p class="list-group-item-text">从文件导入..</p>
			</a>
			<a href="./problem_copy.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-link"></i> Import Problem From URL</h4>
				<p class="list-group-item-text">从网址导入..</p>
			</a>
			<a href="./problem_rejudge.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-gavel"></i> Problen Rejudger</h4>
				<p class="list-group-item-text">重判题目/重判一次提交</p>
			</a>
		</div>
	</div>
</body>
</html>