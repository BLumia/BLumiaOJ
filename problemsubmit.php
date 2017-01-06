<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<link rel="stylesheet" href="./sitefiles/codemirror/codemirror.css">
		<script src="./sitefiles/codemirror/codemirror.js"></script>
		<script src="./sitefiles/codemirror/mode/javascript/javascript.js"></script>
		<title>BLumiaOJ</title>
		<style>
.CodeMirror {
	border-style: solid;
	border-width: 2px;
	border-color: rgba(76, 5, 247, 0.3);
}
		</style>
	</head>	
	
<?php
	// Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_const.inc.php');
	require_once('./include/user_check_functions.php');
	// Prepares
	if (!isset($_SESSION['user_id'])) {
		exit("403 Please Login First");
	}
	if (!isset($_GET['pid'])) {
		exit("403 No Problem ID");
	}
	$problem_id = intval($_GET['pid']);
	$contest_id = isset($_GET['cid']) ? intval($_GET['cid']) : false;
	
	// Edit code if provide a solution id.
	$code_id = intval($_GET['sid']);
	$sql = $pdo->prepare("SELECT * FROM `solution` WHERE `solution_id`=?");
	$sql->execute(array($code_id));
	$codeInfo=$sql->fetch(PDO::FETCH_ASSOC);
	
	$sql = $pdo->prepare("SELECT * FROM `source_code` WHERE `solution_id`=?");
	$sql->execute(array($code_id));
	$codeContent=$sql->fetch(PDO::FETCH_ASSOC);
	$code_src = str_replace(array('<', '>'), array('&lt;', '&gt;'), $codeContent['source']);
	
	$can_edit = false;
	if (havePrivilege("SOURCE_VIEWER")) $can_edit=true;
	if (isset($_SESSION['user_id'])&&$codeInfo['user_id']==$_SESSION['user_id']) $can_edit=true;
	
	// Language Mask
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