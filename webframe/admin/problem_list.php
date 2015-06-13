<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Problem Management</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	//Prepares
	$pstart = 1000;
	$pend = 1100;
	
	$sql=$pdo->prepare("select `problem_id`,`title`,`in_date`,`defunct` FROM `problem` where problem_id>=? and problem_id<=? order by `problem_id` asc");
	$sql->execute(array($pstart,$pend));
	$probList=$sql->fetchAll();
	//$newsCount=count($newsList);
	//Page Includes
	require("./pages/problem_list.php");
?>
	
</html>