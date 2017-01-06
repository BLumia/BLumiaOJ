<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Problem</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_const.inc.php');
	require_once('./include/user_check_functions.php');
	
	//Prepares
	$pid=isset($_GET['pid']) ? intval($_GET['pid']) : -1;
	$gpid=isset($_GET['gpid']) ? intval($_GET['gpid']) : -1;
	if ($gpid==-1 && $pid==-1) {
		echo "No such problem";
		exit(0);
	}
	$cid=isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	if ($cid==0) {
		echo "No such contest";
		exit(0);
	}
	
	$sql=$pdo->prepare("SELECT * FROM contest WHERE contest_id = ?");
	$sql->execute(array($cid));
	$contestItem=$sql->fetch(PDO::FETCH_ASSOC);
	
	//TODO: Grobal Problem ID
	$sql=$pdo->prepare("
		SELECT * FROM `problem` WHERE `defunct`='N' AND `problem_id`=(
			SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=? AND `num`=?
		)
	");
	$sql->execute(array($cid,$pid));
	$problemItem=$sql->fetch(PDO::FETCH_ASSOC);
	
	//Page Includes
	require("./pages/contest_problem.php");
?>
	
</html>