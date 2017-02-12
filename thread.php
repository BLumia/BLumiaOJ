<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/highcharts.js"></script>
		<title>BLumiaOJ</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	//Prepares
	if (!$FORUM_ENABLED) exit(0);
	
	//Page Includes
	require("./pages/thread.php");
?>
	
</html>