<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");

	if (!(isset($_SESSION['administrator'])) && !isset( $_SESSION['op_PageModifier'] )){
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
	
	if (!isset($_POST['nid'])) {
		echo "Not Got an News Id";
		exit(0);
	}
	
	$news_title 	=$_POST['news_title'];
	$news_content	=$_POST['news_content'];
	$news_id		=$_POST['nid'];
	
	/*
	removexss
	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	if($news_id == "add") {
		
		$sql=$pdo->prepare("insert into news
				(`user_id`,`title`,`content`,`time`)
				values(?,?,?,now())");
		$sql->execute(array($_SESSION['user_id'],$news_title,$news_content));
		echo "News Added Successful";
		exit(0);
	}
	
	/* do check work*/
	$news_id = intval($news_id);
	$sql=$pdo->prepare("SELECT * FROM `news` WHERE `news_id`=?");
	$sql->execute(array($news_id));
	$affected_rows = $sql->rowCount();
	$news_exist = ($affected_rows == 1) ? true : false;
	
	if($news_exist) {
		$sql=$pdo->prepare("UPDATE `news` set `title`=?,`time`=now(),`content`=?,user_id=? WHERE `news_id`=?");
		$sql->execute(array($news_title,$news_content,$_SESSION['user_id'],$news_id));
		echo "News Modified Successful";
		
	} else {
		echo "News NOT Exist!";
		exit(0);
	}
	
	
?>
