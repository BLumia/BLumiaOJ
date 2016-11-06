<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<?php require_once('./include/contest_functions.inc.php'); ?>
		<title>Contest</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/user_check_functions.php');
	
	//Prepares
	$cid=isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	if ($cid==0) {
		echo "No such contest";
		exit(0);
	}
	
	//需要根据时间排序，新比赛在前，未进行的比赛在前，尚未这样做
	$sql=$pdo->prepare("select * from contest where contest_id = ?");
	$sql->execute(array($cid));
	$contestItem=$sql->fetch(PDO::FETCH_ASSOC);
	
	$now = time();
	$startTime = strtotime($contestItem['start_time']);
	$endTime = strtotime($contestItem['end_time']);
	$contestState = "";
	
	// Not a good idea to hardcode bs-css class here.
	if ($now > $endTime)
		$contestState = "<font class='text-muted'>Ended</font>";
	else if ($now < $startTime)
		$contestState = "<font class='text-primary'>Not Started</font>";
	else {
		$contestState = "<font class='text-danger'>Running</font>";
	}
	
	//Page Includes
	require("./pages/contest.php");
?>
	
</html>