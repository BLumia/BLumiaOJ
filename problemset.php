<?php 
	session_start();
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_functions.inc.php'); 
	require_once('./include/user_check_functions.php');
	
	//Prepare
	$p=isset($_GET['p']) ? $_GET['p'] : 1;
	if($p<=1){$p=1;}
	
	//Page Includes
	require("./pages/problemset.php");
?>
