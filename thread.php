<?php 
	session_start();
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/user_check_functions.php');
	//Prepares
	if (!$FORUM_ENABLED) exit(0);
	
	if(!isset($_GET["tid"])) exit(0);
	
	//Page Includes
	require("./pages/thread.php");
?>
