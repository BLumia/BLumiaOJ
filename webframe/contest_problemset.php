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
	
	$sql=$pdo->prepare("select * from contest where contest_id = ?");
	$sql->execute(array($cid));
	$contestItem=$sql->fetch(PDO::FETCH_ASSOC);
	
	$sql=$pdo->prepare("
		select * from (
			SELECT `problem`.`title` as `title`,`problem`.`problem_id` as `pid`,source as source,contest_problem.num as pnum
			FROM `contest_problem`,`problem`
			WHERE `contest_problem`.`problem_id`=`problem`.`problem_id` 
			AND `contest_problem`.`contest_id`=? ORDER BY `contest_problem`.`num` 
		) problem
		left join (
			select problem_id pid1,count(1) accepted from solution where result=4 and contest_id=? group by pid1
		) p1 on problem.pid=p1.pid1
        left join (
			select problem_id pid2,count(1) submit from solution where contest_id=? group by pid2
		) p2 on problem.pid=p2.pid2
		order by pnum
	");
	$sql->execute(array($cid,$cid,$cid));
	$problemList=$sql->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($problemList);
	$problemCount=count($problemList);
	
	//Page Includes
	require("./pages/contest_problemset.php");
?>
	
</html>