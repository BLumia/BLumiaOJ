<?php 
	session_start(); 
	$ON_ADMIN_PAGE="Yap";
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once("../include/user_check_functions.php");
	$announcementFilePath = "./announcement.txt";
	
	//Privilege Check
	if (!havePrivilege("PAGE_EDITOR")) {
		exit("403");
	}
	
	//Prepares
	$page_helper = "你可以在这里编辑首部广播";
	if (isset($_POST['broadcast_content'])) {
		//echo $_POST['broadcast_content'];
		$fp=fopen($announcementFilePath,"w");
		fputs($fp, stripslashes($_POST['broadcast_content']));
		fclose($fp);
		echo "<div class='container alert alert-info alert-dismissible' role='alert'>
				<i class='fa fa-bell-o'></i>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
				<span class='sr-only'>Message:</span>
				Update Successful~
			</div>";
	}
	if (file_exists($announcementFilePath)) {
		$OJ_ANNOUNCEMENT = file_get_contents($announcementFilePath);
	} else {
		$OJ_ANNOUNCEMENT = "";
	}
	//Page Includes
	require("./pages/broadcast_editor.php");
?>
