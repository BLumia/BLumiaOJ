<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Contest List</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	//Prepares
	$sql=$pdo->prepare("SELECT max(`contest_id`) as upid, min(`contest_id`) as btid  FROM `contest`");
	$sql->execute();
	$contestScale=$sql->fetch(PDO::FETCH_ASSOC);
	$contestCnt = intval($contestScale['upid']) - intval($contestScale['btid']);//plus 1
	//var_dump($contestCnt);
	$pageCnt = intval($contestCnt/$PAGE_ITEMS)+(($contestCnt%$PAGE_ITEMS)>0?1:0);
	
	$curPage = isset($_GET['p']) ? intval($_GET['p']) : $pageCnt;
	$pageStart=intval($contestScale['btid'])+$PAGE_ITEMS*intval($curPage-1);
	$pageEnd=$pageStart+$PAGE_ITEMS;
	/*
	for ($i=1;$i<=$cnt;$i++){
        if ($i>1) echo '&nbsp;';
        if ($i==$page) echo "<span class=red>$i</span>";
        else echo "<a href='contest_list.php?page=".$i."'>".$i."</a>";
	}
	*/
	if (isset($_GET['keyword'])) {
		$keyword=$_GET['keyword'];
		// TODO: 安全处理keyword
		$sql=$pdo->prepare("select `contest_id`,`title`,`start_time`,`end_time`,`private`,`defunct` FROM `contest` where title like '%$keyword%' ");
		$sql->execute();
		$contestList=$sql->fetchAll(PDO::FETCH_ASSOC);
	} else {
		$sql=$pdo->prepare("select `contest_id`,`title`,`start_time`,`end_time`,`private`,`defunct` FROM `contest` where contest_id>=? and contest_id <=? order by `contest_id` desc");
		$sql->execute(array($pageStart,$pageEnd));
		$contestList=$sql->fetchAll(PDO::FETCH_ASSOC);
	}
	//var_dump($contestList);
	
	//Page Includes
	require("./pages/contest_list.php");
?>
	
</html>