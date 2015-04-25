<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Problem Set</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	
	//Prepare
	$p=isset($_GET['p']) ? $_GET['p'] : 0;
	if($p<0){$p=0;}
	$front=intval($p*$PAGE_ITEMS);
	
	$sql=$pdo->prepare("select * from contest
						left join (select * from privilege where rightstr like 'm%') p on concat('m',contest_id)=rightstr
						where contest.`defunct`='N' limit $front,$PAGE_ITEMS");
	$sql->execute();
	$contestList=$sql->fetchAll();
	$contestCount=count($contestList);
	
	$sql=$pdo->prepare("select * from contest where `defunct`='N'");
	$sql->execute();
	$totalContest=$sql->fetchAll();
	$totalCount=count($totalContest);
	
	//Page Includes
	require("./pages/contestlist.php");
?>
	
</html>