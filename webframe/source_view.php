<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Source Viewer</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	//Prepares
	$jresult=Array("MSG_PD","MSG_PR","MSG_CI","MSG_RJ","MSG_AC","MSG_PE","MSG_WA","MSG_TLE","MSG_MLE","MSG_OLE","MSG_RE","MSG_CE","MSG_CO","MSG_TR");
	
	if (!isset($_GET['id'])) {
		echo "Null Source ID.";
		exit(0);
	}
	
	//尚不准备关于代码权限访问相关的代码
	$code_id = intval($_GET['id']);
	$sql = $pdo->prepare("SELECT * FROM `solution` WHERE `solution_id`=?");
	$sql->execute(array($code_id));
	$codeInfo=$sql->fetch();
	
	$sql = $pdo->prepare("SELECT * FROM `source_code` WHERE `solution_id`=?");
	$sql->execute(array($code_id));
	$codeContent=$sql->fetch();
	
	$can_view = false;
	if (isset($_SESSION['source_browser'])) $can_view=true;
	if (isset($_SESSION['user_id'])&&$codeInfo['user_id']==$_SESSION['user_id']) $can_view=true;
	//if (shared) $can_view = true;
	if (!$can_view) {
		echo "No Permission to visit this code";
		exit(0);
	}
	
	//var_dump($codeInfo);
	$code_author = $codeInfo['user_id'];
	$code_src = $codeContent['source'];
	$code_date = $codeInfo['in_date'];
	$code_result = $jresult[$codeInfo['result']];
	$code_time = $codeInfo['time'];
	$code_memory = $codeInfo['memory'];
	
	//if (shared from submit)
	$code_title = "Problem ".$codeInfo['solution_id'];
	//else
	//$code_title = "Code Paster Title"
	
	
	//Page Includes
	require("./pages/source_view.php");
?>
	
</html>