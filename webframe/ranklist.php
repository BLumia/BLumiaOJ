<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Rank List</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	
	//Prepares
	$p=isset($_GET['p']) ? $_GET['p'] : 0;
	if($p<0){$p=0;}
	$front=intval($p*$PAGE_ITEMS);
	
	$sql=$pdo->prepare("select * from users order by solved desc limit $front,$PAGE_ITEMS");
	$sql->execute();
	$userList=$sql->fetchAll();
	$userCount=count($userList);
	
	//Page Includes
	require("./pages/ranklist.php");
?>
	
</html>