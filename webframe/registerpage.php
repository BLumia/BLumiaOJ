<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/jqBootstrapValidation.js"></script>
		<title>Register</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	//Prepares
	if (isset($_SESSION['user_id'])) {
		echo "Please Log Out First";
		exit(0);
	}
	//Page Includes
	require("./pages/registerpage.php");
?>
	
</html>