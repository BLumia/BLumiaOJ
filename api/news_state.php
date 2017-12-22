<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_functions.inc.php");
	require_once("../include/file_functions.php");
	require_once("../include/user_check_functions.php");
    
	if (!havePrivilege("PAGE_EDITOR")) fire(403, "Forbidden");
	
	if (!isset($_GET['nid'])) fire(400, "Missing news id argument");
	if (!isset($_GET['do'])) fire(400, "Missing action argument");
	
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
		fire(200, "success", array("success" => true));
		
	} else {
		fire(404, "News not exist");
	}
	
	
?>
