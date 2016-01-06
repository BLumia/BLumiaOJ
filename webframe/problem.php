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
	
	//Prepares
	$pid=isset($_GET['pid']) ? intval($_GET['pid']) : 0;
	$gpid=isset($_GET['gpid']) ? intval($_GET['gpid']) : 0;
	if ($gpid==0 && $pid==0) {
		echo "No such problem";
		exit(0);
	}
	
	//TODO: Grobal Problem ID
	$sql=$pdo->prepare("select * from problem where problem_id = ?");
	$sql->execute(array($pid));
	$problemItem=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	//Page Includes
	require("./pages/problem.php");
?>
	
</html>