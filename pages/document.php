<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title><?php echo "Document - {$OJ_NAME}";?></title>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php echo Parsedown::instance()->setBreaksEnabled(true)->setUrlsLinked(false)->text($content);?>
				</div>
			</div>
		</div>
		<?php require("./pages/components/footer.php");?>
	</body>
</html>