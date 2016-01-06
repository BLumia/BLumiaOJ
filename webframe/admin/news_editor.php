<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Add Problem</title>
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
	if (isset($_GET['nid'])) {
		//check nid if exist
		$NEWS_NID = intval($_GET['nid']);
		$sql=$pdo->prepare("SELECT * FROM `news` WHERE `news_id`=?");
		$sql->execute(array($NEWS_NID));
		$newsInfo = $sql->fetch();
		//var_dump($newsInfo);
		$page_helper = "Maybe you need some help?";
		$NEWS_TITLE = $newsInfo['title'];
		$NEWS_CONTENT = $newsInfo['content'];
	} else {
		//new
		$NEWS_NID = "add";
		$page_helper = "Maybe you need some help?";
		$NEWS_TITLE = "";
		$NEWS_CONTENT = "";
	}
	//Page Includes
	require("./pages/news_editor.php");
?>
	
</html>