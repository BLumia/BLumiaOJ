<!DOCTYPE html>
<html>
<head>
	<?php require_once('../include/admin_head.inc.php'); ?>
	<title><?php echo LA_BKSTAGE_ADMIN." - {$OJ_NAME}";?></title>
</head>	
<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1><?php echo LA_WELCOME;?> <small>Manager</small></h1>
		</div>
		<p class="lead">
			<?php echo LA_INDEX_LEAD;?>
		</p>
		<p>
			<?php echo LA_INDEX_MORE;?>
		</p>
		<table class="table">
			<tr><th><?php echo LA_PROPERTY;?></th><th><?php echo LA_STATUS;?></th></tr>
			<?php if ($OJ_IS_SAMPLE_CFG == true) { ?>
			<tr><td><?php echo LA_DEFAULT_CFG;?></td><td><?php echo LA_DEFAULT_CFG_HELP;?></td></tr>
			<?php } ?>
			<tr><td><?php echo LA_SHOW_WA_INFO;?></td><td><?php echo $SOLUTION_WA_INFO ? LA_YES : LA_NO;?></td></tr>
			<tr><td><?php echo LA_ENABLED_LANG;?></td><td>
				<?php
					for($i=0;$i<$lang_count;$i++){
						if($lang&(1<<$i))
						echo "<span class='label label-default'>{$LANGUAGE_NAME[$i]}</span> ";
					}
				?>
			</td></tr>
			<tr><td><?php echo LA_CODE_SUBMIT_LIMIT;?></td><td><?php echo $OJ_SUBMIT_DELTATIME." sec";?></td></tr>
			<tr><td><?php echo LA_DO_LOCK_RANKLIST;?></td><td><?php echo $OJ_LOCKRANK ? LA_YES : LA_NO;?></td></tr>
			<tr><td><?php echo LA_LOCK_RANKLIST_PCT;?></td><td><?php echo $OJ_LOCKRANK ? $OJ_LOCKRANK_PERCENT : LA_NO;?></td></tr>
		</table>
	</div>
</body>
</html>