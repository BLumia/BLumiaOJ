<?php 
	session_start();
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
	$sql=$pdo->prepare("SELECT * FROM contest WHERE contest_id = ?");
	$sql->execute(array($cid));
	$contestItem=$sql->fetch(PDO::FETCH_ASSOC);
	
	$now = time();
	$startTime = strtotime($contestItem['start_time']);
	$endTime = strtotime($contestItem['end_time']);
	$contestState = "";
	
	// Not a good idea to hardcode bs-css class here.
	if ($now > $endTime)
		$contestState = "<font class='text-muted'>".L_Ended."</font>";
	else if ($now < $startTime)
		$contestState = "<font class='text-primary'>".L_Not_Start."</font>";
	else {
		$contestState = "<font class='text-danger'>".L_Running."</font>";
	}
	
	if(isset($_POST['psw']) && ($contestItem['password'] != '')) {
		if ($_POST['psw'] == $contestItem['password']) {
			$_SESSION["c{$cid}"] = "true";
		}
	}
	
	//Page Includes
	require("./pages/contest.php");
?>
