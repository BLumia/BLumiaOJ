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
	
	//Prepares
	$cid=isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	if ($cid==0) {
		echo "No such contest";
		exit(0);
	}
	
	$sql=$pdo->prepare("select * from contest where contest_id = ?");
	$sql->execute(array($cid));
	$contestItem=$sql->fetchAll();
	
	//Page Includes
	require("./pages/contest.php");
?>
	
</html>