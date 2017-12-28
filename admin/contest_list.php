<?php 
	session_start(); 
	$ON_ADMIN_PAGE="Yap";
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once('../include/common_functions.inc.php');
	//Prepares
	$sql=$pdo->prepare("SELECT max(`contest_id`) as upid, min(`contest_id`) as btid  FROM `contest`");
	$sql->execute();
	$contestScale=$sql->fetch(PDO::FETCH_ASSOC);
	$contestCnt = intval($contestScale['upid']) - intval($contestScale['btid']);//plus 1
	//var_dump($contestCnt);
	$pageCnt = intval($contestCnt/$PAGE_ITEMS)+(($contestCnt%$PAGE_ITEMS)>0?1:0);
	
	$curPage = isset($_GET['page']) ? intval($_GET['page']) : $pageCnt;
	$pageStart=intval($contestScale['btid'])+$PAGE_ITEMS*intval($curPage-1);
	$pageEnd=$pageStart+$PAGE_ITEMS;

	if (isset($_GET['keyword'])) {
		$keyword= pdo_real_escape_string($_GET['keyword'], $pdo);
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
	
