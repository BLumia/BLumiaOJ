<?php 
	session_start(); 
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_const.inc.php');
	require_once('./include/user_check_functions.php');
	//Prepares
	
	if (!isset($_GET['id'])) {
		echo "Null Source ID.";
		exit(0);
	}
	
	//尚不准备关于代码权限访问相关的代码
	$code_id = intval($_GET['id']);
	$sql = $pdo->prepare("SELECT * FROM `solution` WHERE `solution_id`=?");
	$sql->execute(array($code_id));
	$codeInfo=$sql->fetch(PDO::FETCH_ASSOC);
	
	$sql = $pdo->prepare("SELECT * FROM `source_code` WHERE `solution_id`=?");
	$sql->execute(array($code_id));
	$codeContent=$sql->fetch(PDO::FETCH_ASSOC);
	
	$can_view = false;
	if (havePrivilege("SOURCE_VIEWER")) $can_view=true;
	if (isset($_SESSION['user_id'])&&$codeInfo['user_id']==$_SESSION['user_id']) $can_view=true;
	//if (shared) $can_view = true;
	if (!$can_view) {
		echo "No Permission to visit this code";
		exit(0);
	}
	
	$code_author = $codeInfo['user_id'];
	$code_src = str_replace(array('<', '>'), array('&lt;', '&gt;'), $codeContent['source']);
	$code_date = $codeInfo['in_date'];
	$code_result = $JUDGE_RESULT[$codeInfo['result']];
	$code_time = $codeInfo['time'];
	$code_memory = $codeInfo['memory'];
	$code_lang = $codeInfo['language'];
	
	//if (shared from submit)
	$code_title = "Problem ".$codeInfo['problem_id'];
	//else
	//$code_title = "Code Paster Title"
	
	//Page Includes
	require("./pages/source_view.php");
?>
