<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<link rel="stylesheet" type="text/css" href="../sitefiles/css/bootstrap-select.min.css">
		<script type="text/javascript" src="../sitefiles/js/bootstrap-select.min.js"></script>
		<title>Edit Contest</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once('../include/common_const.inc.php');
	require_once('../include/common_functions.inc.php');
	
	//Prepares
	if(isset($_REQUEST['cid'])) {
		$cid = intval($_REQUEST['cid']);
		$sql=$pdo->prepare("SELECT * FROM contest WHERE contest_id = ?");
		$sql->execute(array($cid));
		$contestItem=$sql->fetch(PDO::FETCH_ASSOC);
		if (count($contestItem) == 0) {
			exit("Contest not exist");
		}
	}
	
	//Problem List
	$sql=$pdo->prepare("SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=? ORDER BY `num`");
	$sql->execute(array($cid));
	$result=$sql->fetchAll(PDO::FETCH_ASSOC);
	$prob_list = "";
	foreach($result as $one_prob) {
		if(empty($prob_list)) $prob_list.=$one_prob["problem_id"];
		else $prob_list.=','.$one_prob["problem_id"];
	}
	
	
	$tmpStr = 'c'.$cid;
	$sql=$pdo->prepare("SELECT `user_id` FROM `privilege` WHERE `rightstr`=? order by user_id");
	$sql->execute(array($tmpStr));
	$result=$sql->fetchAll(PDO::FETCH_ASSOC);
	$user_list="";
	foreach($result as $one_user){
		$user_list.=$one_user["user_id"]."\n";
	}
	
	$lang_count=count($LANGUAGE_EXT);
	$langmask=isset($contestItem["langmask"]) ? $contestItem["langmask"] : $OJ_LANGMASK;
	$start_time=$contestItem["start_time"];
	$end_time=$contestItem["end_time"];
	
	$page_helper = LA_U_ARE_EDITING.": [".L_CONTEST_ID.":{$cid}]";
	$CONT_TITLE = $contestItem["title"];
	$CONT_PROBLEMS = $prob_list;
	$CONT_S_TIME_Y = substr($start_time,0,4);
	$CONT_S_TIME_MO= substr($start_time,5,2);
	$CONT_S_TIME_D = substr($start_time,8,2);
	$CONT_S_TIME_H = substr($start_time,11,2);
	$CONT_S_TIME_MI = substr($start_time,14,2);
	$CONT_E_TIME_Y = substr($end_time,0,4);
	$CONT_E_TIME_MO= substr($end_time,5,2);
	$CONT_E_TIME_D = substr($end_time,8,2);
	$CONT_E_TIME_H = substr($end_time,11,2);
	$CONT_E_TIME_MI = substr($end_time,14,2);
	$CONT_USERLIST = $user_list;
	$CONT_PERMISSION = intval($contestItem["private"]);
	$CONT_PASSWORD = isset($contestItem["password"]) ? $contestItem["password"] : "";
	$CONT_DESC = $contestItem["description"];
	//Page Includes
	require("./pages/contest_mod.php");
?>
	
</html>