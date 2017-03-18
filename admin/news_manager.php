<?php 
	session_start(); $ON_ADMIN_PAGE="Yap"; 
	//Admin Auth
	if (!(isset($_SESSION['administrator'])||isset( $_SESSION['op_PageModifier'] ))) {
		exit("403");
	}
	//Vars
	require_once('../include/setting_oj.inc.php');
	//Prepares
	$sql=$pdo->prepare("SELECT `news_id`,`user_id`,`title`,`time`,`importance`,`defunct` FROM `news` ORDER BY `news_id` DESC");
	$sql->execute();
	$newsList=$sql->fetchAll(PDO::FETCH_ASSOC);
	//Page Includes
	require("./pages/news_manager.php");
?>
