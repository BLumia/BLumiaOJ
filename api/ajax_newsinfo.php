<?php
	/*  ***UNFINISHED***  */

	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_functions.inc.php");
	
	// Prepare
	
	// Query
	$sql=$pdo->prepare("SELECT `news_id`,`user_id`,`title`,`time`,`importance`,`defunct` FROM `news` ORDER BY `news_id` DESC");
	$sql->execute();
	$newsList=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	fire(200, "success", $newsList);
?>