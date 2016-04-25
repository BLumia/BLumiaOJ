<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Contest</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_const.inc.php');
	
	//Prepares
	$cid=isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	if ($cid==0) {
		echo "No such contest";
		exit(0);
	}
	
	$sql=$pdo->prepare("SELECT * FROM contest WHERE contest_id = ?");
	$sql->execute(array($cid));
	$contestItem=$sql->fetch(PDO::FETCH_ASSOC);
	
	$sql=$pdo->prepare("
		SELECT * FROM (
			SELECT `problem`.`title` AS `title`,`problem`.`problem_id` AS `pid`,source AS source,contest_problem.num AS pnum
			FROM `contest_problem`,`problem`
			WHERE `contest_problem`.`problem_id`=`problem`.`problem_id` 
			AND `contest_problem`.`contest_id`=? ORDER BY `contest_problem`.`num` 
		) problem
		left join (
			SELECT problem_id pid1,count(1) accepted FROM solution WHERE result=4 AND contest_id=? GROUP BY pid1
		) p1 on problem.pid=p1.pid1
        left join (
			SELECT problem_id pid2,count(1) submit FROM solution WHERE contest_id=? GROUP BY pid2
		) p2 on problem.pid=p2.pid2
		ORDER BY pnum
	");
	$sql->execute(array($cid,$cid,$cid));
	$problemList=$sql->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($problemList);
	$problemCount=count($problemList);
	
	//Page Includes
	require("./pages/contest_problemset.php");
?>
	
</html>