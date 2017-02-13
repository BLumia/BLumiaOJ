<?php 
	session_start();
	//Vars
	require_once('./include/setting_oj.inc.php');
	//Prepares
	if (!$FORUM_ENABLED) exit(0);
	
	$pid = (isset($_GET["pid"])) ? intval($_GET["pid"]) : null;
	
	//Page Includes
	require("./pages/discuss.php");
?>
