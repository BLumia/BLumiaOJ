<?php 
	session_start();
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_functions.inc.php'); 
	require_once('./include/user_check_functions.php');
	
	//Prepare
	if ($PROBLEM_TAG_ENABLED == false) fire(503, "Problem tag system not enabled.");
	
	//Page Includes
	require("./pages/taglist.php");
?>
