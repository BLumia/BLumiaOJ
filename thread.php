<?php 
	session_start();
	//Vars
	require_once('./include/setting_oj.inc.php');
	//Prepares
	if (!$FORUM_ENABLED) exit(0);
	
	if(!isset($_GET["tid"])) exit(0);
	
	//Page Includes
	require("./pages/thread.php");
?>
