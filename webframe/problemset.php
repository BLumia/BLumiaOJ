<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php 
			require_once('./include/common_head.inc.php'); 
			require_once('./include/common_functions.inc.php'); 
		?>
		<title>Problem Set</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	
	//Prepare
	$p=isset($_GET['p']) ? $_GET['p'] : 0;
	if($p<0){$p=0;}
	$front=intval($p*$PAGE_ITEMS);
	
	/*
	Ajax Load Problemlist Now
	$sql=$pdo->prepare("select * from problem limit $front,$PAGE_ITEMS");
	$sql->execute();
	$problemList=$sql->fetchAll();
	$problemCount=count($problemList);
	*/
	
	$sql=$pdo->prepare("select * from problem where `defunct`!='Y'");
	$sql->execute();
	$totalProblem=$sql->fetchAll(PDO::FETCH_ASSOC);
	$totalCount=count($totalProblem);
	
	//Page Includes
	require("./pages/problemset.php");
?>
	
</html>