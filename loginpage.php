<?php 
	session_start(); 
	//Vars
	require_once('./include/setting_oj.inc.php');
	//Prepares
	if (isset($_SESSION['user_id'])) {
		exit("Please Log Out First");
	}
	//Page Includes
	require("./pages/loginpage.php");
?>
