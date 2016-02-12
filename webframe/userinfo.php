<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/highcharts.js"></script>
		<title>User Informations</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_const.inc.php');
	
	//Prepares
	if (isset($_SESSION['user_id']) || isset($_GET['uid'])) {
		//User Logged in and wanna see him/herself's info.
		if (!isset($_GET['uid']))
			$user_id = $_SESSION['user_id']; 
		else
			$user_id = $_GET['uid'];
		
		$sql=$pdo->prepare("select * from users where user_id=?");
		$sql->execute(array($user_id));
		$res=$sql->fetch();
		//var_dump($res);
		$sql->closeCursor();
		
		$user_name = $res['nick'];
		$user_school = $res['school'];
		$user_email = $res['email'];
		
	} else {
		//退出
		exit(0);
	}
	
	// count solved
	$sql=$pdo->prepare("SELECT DISTINCT `problem_id` FROM `solution` WHERE `user_id`=? AND `result`=4 ORDER BY `problem_id` ASC");
	$sql->execute(array($user_id));
	$user_solved_list=$sql->fetchAll(PDO::FETCH_ASSOC);
	$user_solved = $res['ac'] = count($user_solved_list);
	$sql->closeCursor();
	//var_dump($user_solved_list);
	
	// count submission
	$sql=$pdo->prepare("SELECT count(solution_id) as `Submit` FROM `solution` WHERE `user_id`=?");
	$sql->execute(array($user_id));
	$res=$sql->fetch(PDO::FETCH_ASSOC);
	$user_submit = $res['Submit'];
	$sql->closeCursor();
	
	// count other
	$sql=$pdo->prepare("SELECT result,count(1) FROM solution WHERE `user_id`=? AND result>=4 group by result order by result");
	$sql->execute(array($user_id));
	$res=$sql->fetchAll(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	//print_r($res);
	$i = 0;
	foreach($res as $row) {
		//print_r($row);
		$user_other[$i++]=$row;
	}
	
	//Page Includes
	require("./pages/userinfo.php");
?>
	
</html>