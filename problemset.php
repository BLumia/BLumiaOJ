<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Problem Set</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/common_functions.inc.php'); 
	require_once('./include/user_check_functions.php');
	
	//Prepare
	$p=isset($_GET['p']) ? $_GET['p'] : 1;
	if($p<=1){$p=1;}
	$front=intval(($p-1)*$PAGE_ITEMS) + 1000;
	$tail =$front + $PAGE_ITEMS;
	$curTime=strftime("%Y-%m-%d %H:%M",time());
	$isProblemManager = havePrivilege("PROBLEM_EDITOR");
	
	$sql=$pdo->prepare("SELECT max(`problem_id`) as upid FROM `problem`");
	$sql->execute();
	$maxProbID=$sql->fetch(PDO::FETCH_ASSOC);
	$maxProbID=intval($maxProbID['upid']);
	$minProbID=1000;
	
	$pstart = $minProbID + ($p-1)*$PAGE_ITEMS;
	$pend = $pstart + $PAGE_ITEMS;
	$pageCnt = ($maxProbID - $minProbID) / $PAGE_ITEMS + 1;
	
	//Challenged Problems
	if(isset($_SESSION['user_id'])) {
		$sql=$pdo->prepare("SELECT `problem_id` FROM `solution` WHERE `user_id`='{$_SESSION['user_id']}' GROUP BY `problem_id`"); //All
		$sql->execute();
		$challengedList=$sql->fetchAll(PDO::FETCH_ASSOC);
		$sql=$pdo->prepare("SELECT `problem_id` FROM `solution` WHERE `user_id`='{$_SESSION['user_id']}' AND `result`=4 GROUP BY `problem_id`"); //Accepted
		$sql->execute();
		$acceptedList=$sql->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($acceptedList);
		
		foreach($challengedList as $row) {
			$probStatusList[$row['problem_id']] = "challenged";
		}
		foreach($acceptedList as $row) {
			$probStatusList[$row['problem_id']] = "accepted";
		}
	}
	
	//Problem list(an problem manager can see all the problems)
	$any_running_contest = "
		SELECT `problem_id` FROM `contest_problem` WHERE `contest_id` IN (
			SELECT `contest_id` FROM `contest` WHERE 
			(`end_time`>'{$curTime}') AND `defunct`='N'
		)";
		
	//Keyword
	if(isset($_GET['wd']) && trim($_GET['wd'])!="") {
		$search = mysql_real_escape_string(urldecode($_GET['wd']));
		$common_filter = " ( title LIKE '%{$search}%' OR source LIKE '%{$search}%') ";
		$totalCount = 1; // all search result in one page
	} else {
		$common_filter = "`problem_id`>='{$front}' AND `problem_id`<'{$tail}'";
	}	
	
	if (!$isProblemManager) {
		$sql=$pdo->prepare("SELECT * FROM problem WHERE `defunct`='N' AND {$common_filter} AND `problem_id` NOT IN({$any_running_contest})");
	} else {
		$sql=$pdo->prepare("SELECT * FROM problem WHERE {$common_filter}");// limit $front,$PAGE_ITEMS
	}
	$sql->execute();
	$problemList=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	//Which problem is under a running contest
	if ($isProblemManager) {
		$sql=$pdo->prepare($any_running_contest);
		$sql->execute();
		$problemUnderContestList=$sql->fetchAll(PDO::FETCH_ASSOC);
		foreach ($problemUnderContestList as $item) {
			$probIDUCList[$item['problem_id']] = "contest";
		}
	}
	
	//Page Includes
	require("./pages/problemset.php");
?>
	
</html>