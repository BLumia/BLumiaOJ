<?php 
	session_start(); 
	$ON_ADMIN_PAGE="Yap";
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("USER_MANAGER")) {
		echo "403";
		exit(403);
	}
	//Prepares
	//Page Includes
	require("./pages/reset_password.php");
?>
