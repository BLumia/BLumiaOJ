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
	$curPageNum = isset($_GET['p'])?intval($_GET['p']):1;
	
	$sql=$pdo->prepare("SELECT max(`problem_id`) as upid FROM `problem`");
	$sql->execute();
	$maxProbID=$sql->fetch(PDO::FETCH_ASSOC);
	$maxProbID=intval($maxProbID['upid']);
	/*
	$sql=$pdo->prepare("SELECT min(`problem_id`) as upid FROM `problem`");
	$sql->execute();
	$minProbID=$sql->fetch(PDO::FETCH_ASSOC);
	var_dump($minProbID);//array(1) { ["upid"]=> string(4) "1000" } 
	*/
	$minProbID=1000;
	
	$pstart = $minProbID + ($curPageNum-1)*$PAGE_ITEMS;
	$pend = $pstart + $PAGE_ITEMS;
	$pageCnt = ($maxProbID - $minProbID) / $PAGE_ITEMS + 1;
	
	$sql=$pdo->prepare("select `problem_id`,`title`,`in_date`,`defunct` FROM `problem` where problem_id>=? and problem_id<=? order by `problem_id` asc");
	$sql->execute(array($pstart,$pend));
	$probList=$sql->fetchAll(PDO::FETCH_ASSOC);
	//Page Includes
	require("./pages/problem_list.php");
?>
	
</html>