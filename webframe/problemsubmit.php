<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<link rel="stylesheet" href="./sitefiles/codemirror/codemirror.css">
		<script src="./sitefiles/codemirror/codemirror.js"></script>
		<script src="./sitefiles/codemirror/mode/javascript/javascript.js"></script>
		<title>BLumiaOJ</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_const.inc.php');
	//Prepares
	if (!isset($_GET['pid'])) {
		echo "No Problem ID";
		exit(0);
	}
	$prob_id = intval($_GET['pid']);
	
	if(isset($_GET['langmask'])) $langMask=$_GET['langmask'];
	else $langMask=$OJ_LANGMASK;
	
	$lang_count=count($LANGUAGE_EXT);
	$lang=(~((int)$langMask))&((1<<($lang_count))-1);
	if (isset($_COOKIE['lastlang'])) $lastlang=$_COOKIE['lastlang'];
	else $lastlang=0;
	
	//Page Includes
	require("./pages/problemsubmit.php");
?>
	
</html>