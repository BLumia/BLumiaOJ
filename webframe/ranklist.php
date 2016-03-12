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
	
	$keyword = isset($_GET["keyword"])? ($_GET["keyword"]."%") : false;
	if ($keyword) {
		$keyword = $pdo->quote($keyword);
		$keywordSQL = "WHERE user_id LIKE {$keyword}";
	} else {
		$keywordSQL = "";
	}

	
	$sql=$pdo->prepare("select * from users {$keywordSQL} order by solved desc limit $front,$PAGE_ITEMS");
	$sql->execute();
	$userList=$sql->fetchAll(PDO::FETCH_ASSOC);
	$userCount=count($userList);
	
	//Page Includes
	require("./pages/ranklist.php");
?>
	
</html>