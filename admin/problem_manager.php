<?php 
	session_start(); 
	$ON_ADMIN_PAGE="Yap";
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("PROBLEM_EDITOR")) {
		echo "403";
		exit(403);
	}
	
	//Prepares
	//Page Includes
	require("./pages/problem_manager.php");
?>
