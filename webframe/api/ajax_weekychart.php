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
		ORDER BY in_date"
	);
	$sql->execute();
	$weekyResult=$sql->fetchAll(PDO::FETCH_ASSOC);
	$tableResult = null;
	/*
	foreach($weekyResult as $row) {
		$submit_time = $row['submit_time'];
		$tableResult[$submit_time]['date'] = $submit_time;
		if(!isset($tableResult[$submit_time]['count'])) $tableResult[$submit_time]['count'] = 0;
		if(!isset($tableResult[$submit_time]['4'])) $tableResult[$submit_time]['4'] = 0;
		if(!isset($tableResult[$submit_time]['6'])) $tableResult[$submit_time]['6'] = 0;
		else {
			$tableResult[$submit_time]['count'] += $row['COUNT(*)'];
		}
		$tableResult[$submit_time][$row['result']] = $row['COUNT(*)'];
	}
	*/
	echo json_encode($weekyResult);
?>