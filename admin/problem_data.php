<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Problem Data</title>
		<style>
table#filelist a {
	cursor: pointer;
}
		</style>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("PROBLEM_EDITOR")) {
		exit("403");
	}
	
	if(!isset($_GET['pid'])) exit("403");
	
	//Prepares
	$problemID = intval($_GET['pid']);
	
	//Page Includes
	require("./pages/problem_data.php");
?>
	
</html>