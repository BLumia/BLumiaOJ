<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>News Management</title>
	</head>	
	
<?php
	//Admin Auth
	if (!(isset($_SESSION['administrator']))) {
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
	//Vars
	require_once('../include/setting_oj.inc.php');
	//Prepares
	$sql=$pdo->prepare("select `news_id`,`user_id`,`title`,`time`,`importance`,`defunct` FROM `news` order by `news_id` desc");
	$sql->execute();
	$newsList=$sql->fetchAll();
	//$newsCount=count($newsList);
	//Page Includes
	require("./pages/news_manager.php");
?>
	
</html>