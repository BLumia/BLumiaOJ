<?php 
	session_start(); $ON_ADMIN_PAGE="Yap";
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("PAGE_EDITOR")) {
		exit("403");
	}
	
	//Prepares
	if (isset($_GET['nid'])) {
		//check nid if exist
		$NEWS_NID = intval($_GET['nid']);
		$sql=$pdo->prepare("SELECT * FROM `news` WHERE `news_id`=?");
		$sql->execute(array($NEWS_NID));
		$newsInfo = $sql->fetch(PDO::FETCH_ASSOC);
		$page_helper = LA_U_ARE_EDITING." [".L_NEWS.":{$NEWS_NID}]";
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
