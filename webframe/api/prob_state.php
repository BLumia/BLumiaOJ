<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
    
	if (!isset($_GET['pid'])) {
		echo "Not Got an Problem Id";
		exit(0);
	}
	
	if (!isset($_GET['do'])) {
		echo "No Operation";
		exit(0);
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
		
	} else {
		echo "Problem NOT Exist!";
		exit(0);
	}
	
	
?>
