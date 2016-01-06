<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Status</title>
	</head>	
	
<?php
	//Vars
	require_once("./include/setting_oj.inc.php");
	//Prepares
	$p=isset($_GET['p']) ? $_GET['p'] : 0;
	if($p<0){$p=0;}
	$front=intval($p*$PAGE_ITEMS);
	//Page Includes
	require("./pages/status.php");
?>
	
</html>