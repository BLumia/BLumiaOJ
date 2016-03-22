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
	
	
	// count other [TODO: Pages, Order by NOT score]
	$sql=$pdo->prepare("SELECT *
		FROM (
			SELECT solution_id, user_id, language, 10000000000000000000 + time *100000000000 + memory *100000 + code_length score, in_date 
			FROM solution
			WHERE problem_id =? AND result =4 ORDER BY score, in_date
		)b
		RIGHT JOIN (
			SELECT count( * ) att, user_id, min( 10000000000000000000 + time *100000000000 + memory *100000 + code_length ) score
			FROM solution
			WHERE problem_id =? AND result =4 GROUP BY user_id ORDER BY score, in_date
		)c ON b.score = c.score AND b.user_id = c.user_id ORDER BY c.score, in_date
	");
	$sql->execute(array($problem_id,$problem_id));
	$acceptedList = $sql->fetchAll(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	print_r($acceptedList);
	
	
	
	//Page Includes
	require("./pages/problemstatistics.php");
?>
	
</html>