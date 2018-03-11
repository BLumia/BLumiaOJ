<?php if (!defined("OJ_INITED")) exit(0); ?>
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
			<h1><?php echo LA_WELCOME;?> <small><?php echo $isCurUserOperator?"Manager":"Hacker";?></small></h1>
		</div>
		<p class="lead">
			<?php echo $isCurUserOperator ? LA_INDEX_LEAD : LA_HACKER_ROCKS;?>
		</p>
		<p>
			<?php if ($isCurUserOperator) echo LA_INDEX_MORE;?>
		</p>
		<?php if (get_magic_quotes_gpc()) { ?>
		<div class="alert alert-danger" role="alert"><h4><?php echo L_WARNING;?> </h4><?php echo LA_MAGIC_QUOTE_WARN;?></div>
		<?php } ?>
		<?php if (!extension_loaded('mbstring')) { ?>
		<div class="alert alert-danger" role="alert"><h4><?php echo L_WARNING;?> </h4><?php echo LA_MBSTRING_WARN;?></div>
		<?php } ?>
		<?php if (!extension_loaded('xml')) { ?>
		<div class="alert alert-danger" role="alert"><h4><?php echo L_WARNING;?> </h4><?php echo LA_XML_DOM_WARN;?></div>
		<?php } ?>
		<?php if (!extension_loaded('gd')) { ?>
		<div class="alert alert-warning" role="alert"><h4><?php echo L_WARNING;?> </h4><?php echo LA_IMG_GD_WARN;?></div>
		<?php } ?>
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