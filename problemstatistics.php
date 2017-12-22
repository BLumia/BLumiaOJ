<?php 
	session_start(); 

	// Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_const.inc.php');
	
	// Prepares
	if (isset($_GET['pid'])) {
		$problem_id = intval($_GET['pid']);
	} else {
		exit("403 Missing Problem ID");
	}
	
	// Count solved
	$sql=$pdo->prepare("SELECT `title`,`accepted`,`submit` FROM problem WHERE problem_id = ?");
	$sql->execute(array($problem_id));
	$problemInfo=$sql->fetch(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	
	$sql=$pdo->prepare("SELECT `result`,count(1) count FROM solution WHERE problem_id=? AND result>=4 GROUP BY result ORDER BY result");
	$sql->execute(array($problem_id));
	$problemSubmits=$sql->fetchAll(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	
	// Count other [TODO: Pages, Order by NOT score]
	$sql=$pdo->prepare(
		"SELECT * FROM (
			SELECT solution_id, user_id, language, 10000000000000000000 + time *100000000000 + memory *100000 + code_length score, in_date 
			FROM solution
			WHERE problem_id =? AND result =4 ORDER BY score, in_date
		)b
		RIGHT JOIN (
			SELECT count( * ) att, user_id, min( 10000000000000000000 + time *100000000000 + memory *100000 + code_length ) score
			FROM solution
			WHERE problem_id =? AND result =4 GROUP BY user_id ORDER BY score, in_date
		)c ON b.score = c.score AND b.user_id = c.user_id ORDER BY c.score, in_date LIMIT 0, 50"
	);
	$sql->execute(array($problem_id,$problem_id));
	$acceptedList = $sql->fetchAll(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	//print_r($acceptedList);
	
	
	
	//Page Includes
	require("./pages/problemstatistics.php");
?>
	
