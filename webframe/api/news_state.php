<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
    
	if (!(isset($_SESSION['administrator'])) && !isset( $_SESSION['op_PageModifier'] )){
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
	
	if (!isset($_GET['nid'])) {
		echo "Not Got an News Id";
		exit(0);
	}
	
	if (!isset($_GET['do'])) {
		echo "Not Got an News Id";
		exit(0);
	}
	
	$news_do		= intval($_GET['do']);
	$news_id		= intval($_GET['nid']);
	
	/*
	removexss
	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	/* do check work*/
	$news_id = intval($news_id);
	$sql=$pdo->prepare("SELECT * FROM `news` WHERE `news_id`=?");
	$sql->execute(array($news_id));
	$affected_rows = $sql->rowCount();
	$news_exist = ($affected_rows == 1) ? true : false;
	
	if($news_exist) {
		
		switch($news_do) {
			case 1:
				$news_importance = 0;
				$news_defunct = "N";
				break;
			case 2:
				$news_importance = 1;
				$news_defunct = "N";
				break;
			case 3:
				$news_importance = 0;
				$news_defunct = "Y";
				break;
			default:
				$news_importance = 0;
				$news_defunct = "N";
				break;
		}
		
		$sql=$pdo->prepare("UPDATE `news` set `importance`=?,`defunct`=? WHERE `news_id`=?");
		$sql->execute(array($news_importance,$news_defunct,$news_id));
		echo "News Modified Successful";
		
	} else {
		echo "News NOT Exist!";
		exit(0);
	}
	
	
?>
