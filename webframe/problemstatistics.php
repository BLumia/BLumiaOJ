<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/highcharts.js"></script>
		<title>Problem Statistics</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_const.inc.php');
	
	//Prepares
	if (isset($_GET['pid'])) {
		$problem_id = intval($_GET['pid']);
	} else {
		echo "403";
		exit(0);
	}
	
	// count solved
	$sql=$pdo->prepare("select `title`,`accepted`,`submit`,`solved` from problem where problem_id = ?");
	$sql->execute(array($problem_id));
	$problemInfo=$sql->fetch(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	//var_dump($problemInfo);
	
	/*
	// count other
	$sql=$pdo->prepare("SELECT result,count(1) FROM solution WHERE `user_id`=? AND result>=4 group by result order by result");
	$sql->execute(array($user_id));
	$res=$sql->fetchAll(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	//print_r($res);
	$i = 0;
	foreach($res as $row) {
		//print_r($row);
		$user_other[$i++]=$row;
	}
	*/
	//Page Includes
	require("./pages/problemstatistics.php");
?>
	
</html>