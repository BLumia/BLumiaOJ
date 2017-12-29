<?php
	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	
	//Prepare
	$sql=$pdo->prepare(
		"SELECT COUNT(*) , COUNT(1) , DATE(in_date) submit_time , result
		FROM solution
		WHERE in_date > DATE_ADD(NOW() , INTERVAL -7 DAY) 
		GROUP BY submit_time, result
		ORDER BY submit_time"
	);
	$sql->execute();
	$weekyResult=$sql->fetchAll(PDO::FETCH_ASSOC);
	$tableResult = null;
	$returnResult = null;
	$weekIdx = null; //$weekIdx['Y-m-d'] = index;
	
	for($i=-6;$i<=0;$i++) {
		$idx = $i + 6; // 0~6
		$day = date('Y-m-d',strtotime("{$i} day"));
		$weekIdx[$day] = $idx;
		$tableResult[$i+6]['date'] = date('Y-m-d',strtotime("{$i} day"));
		$tableResult[$i+6]['4'] = 0;
		$tableResult[$i+6]['6'] = 0;
		$tableResult[$i+6]['count'] = 0;
	}
	
	foreach($weekyResult as $row) {
		if(!isset($weekIdx[$row['submit_time']])) continue;
		$idx = $weekIdx[$row['submit_time']];
		$tableResult[$idx]['count'] += intval($row['COUNT(*)']);
		$tableResult[$idx][$row['result']] = intval($row['COUNT(*)']);
	}
	
	$returnResult['today'] = date('Y-m-d',time());
	$returnResult['data'] = $tableResult;
	
	echo json_encode($returnResult);
?>