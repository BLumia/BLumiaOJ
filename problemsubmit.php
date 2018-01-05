<?php 
	session_start(); 

	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_const.inc.php');
	require_once('./include/common_functions.inc.php');
	require_once('./include/user_check_functions.php');
	
	// Prepares
	if (!isset($_SESSION['user_id'])) {
		exit("403 Please Login First"); 
	}

	$problem_id = @defined_int_or_die($_GET['pid']);
	$contest_id = isset($_GET['cid']) ? intval($_GET['cid']) : false;
	
	// Edit code if provide a solution id.
	$can_edit = false;
	if(isset($_GET['sid'])) {
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
	}
	
	// Language Mask
	$langMask = $OJ_LANGMASK;
	if ($contest_id != false) {
		$sql = $pdo->prepare("SELECT `langmask` FROM `contest` WHERE `contest_id`=?");
		$sql->execute(array($contest_id));
		$contestInfo=$sql->fetch(PDO::FETCH_ASSOC);
		if ($contestInfo != false) {
			$langMask = intval($contestInfo["langmask"]);
		} else {
			fire(404, "Contest not exist");
		}
	}
	
	$lang_count=count($LANGUAGE_EXT);
	$lang=(~((int)$langMask))&((1<<($lang_count))-1);
	if (isset($_COOKIE['lastlang'])) $lastlang=$_COOKIE['lastlang'];
	else $lastlang=0;
	
	//Page Includes
	require("./pages/problemsubmit.php");
?>
