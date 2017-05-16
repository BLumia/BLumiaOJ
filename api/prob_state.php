<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
	require_once("../include/user_check_functions.php");
    
	if (!isset($_GET['pid'])) {
		exit("Not Got an Problem Id");
	}
	
	if (!isset($_GET['do'])) {
		exit("No Operation");
	}
	
	//Privilege Check
	if (!havePrivilege("PROBLEM_EDITOR")) {
		exit("403");
	}
	
	$problem_do		= intval($_GET['do']);
	$problem_id		= intval($_GET['pid']);
	
	/*
	removexss
	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	/* do check work*/
	$sql=$pdo->prepare("SELECT * FROM `problem` WHERE `problem_id`=?");
	$sql->execute(array($problem_id));
	$affected_rows = $sql->rowCount();
	$it_exist = ($affected_rows == 1) ? true : false;
	
	if($it_exist) {
		
		switch($problem_do) {
			case 1:
				$problem_defunct = "N";
				break;
			case 3:
				$problem_defunct = "Y";
				break;
			default:
				$problem_defunct = "N";
				break;
		}
		
		$sql=$pdo->prepare("UPDATE `problem` set `defunct`=? WHERE `problem_id`=?");
		$sql->execute(array($problem_defunct,$problem_id));
		echo "Problem State Modified Successful";
		header("Location: {$_SERVER['HTTP_REFERER']}");
		
	} else {
		echo "Problem NOT Exist!";
		exit(0);
	}
	
	
?>
