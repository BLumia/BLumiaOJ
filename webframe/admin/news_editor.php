<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Add Problem</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	//Prepares
	if (isset($_GET['nid'])) {
		//check nid if exist
		$NEWS_NID = intval($_GET['nid']);
		
		$page_helper = "Maybe you need some help?";
		$NEWS_TITLE = "";
		$NEWS_CONTENT = "";
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