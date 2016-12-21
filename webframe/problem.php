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
	require_once('./include/user_check_functions.php');
	
	$isProblemManager = havePrivilege("PROBLEM_EDITOR");
	
	//Prepares
	$pid=isset($_GET['pid']) ? intval($_GET['pid']) : 0;
	
	if ($pid==0) {
		echo "No such problem";
		exit(0);
	}
	
	$sql=$pdo->prepare("select * from problem where problem_id = ?");
	$sql->execute(array($pid));
	$problemItem=$sql->fetch(PDO::FETCH_ASSOC);
	
	//Page Includes
	require("./pages/problem.php");
?>
	
</html>