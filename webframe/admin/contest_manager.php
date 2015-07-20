<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Content Manager</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	//Prepares
	//Page Includes
	require("./pages/contest_manager.php");
?>
	
</html>