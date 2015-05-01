<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Login</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	//Prepares
	$_SESSION['SessionAuth'] = rand(1000,9999);
	//Page Includes
	require("./pages/loginpage.php");
?>
	
</html>