<?php
	/*  
	Return a list of problems.
	All parameters are optional.
	GET / POST:
		'p':	page number, default value = 1
		'wd':	searching keyword.
	*/

	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_functions.inc.php");
	require_once('../include/user_check_functions.php');
	
	//Prepare
	$p=isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;
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
	if(isset($_REQUEST['wd']) && trim($_REQUEST['wd'])!="") {
		$search = pdo_real_escape_string(urldecode($_REQUEST['wd']), $pdo);
		$common_filter = " ( title LIKE '%{$search}%' OR source LIKE '%{$search}%') ";
		$pageCnt = 1; // all search result in one page
	} else {
		$common_filter = "`problem_id`>='{$front}' AND `problem_id`<'{$tail}' ";
	}
	
	if(isset($_REQUEST['tagid']) && trim($_REQUEST['tagid'])!="" && $PROBLEM_TAG_ENABLED) {
		$tag_id = intval($_REQUEST['tagid']);
		$common_filter.= "
			AND `problem_id` IN (
				SELECT `problem_id` FROM `problem_tag_match` WHERE `tag_id`={$tag_id}
			) ";
	}
	
	if (!$isProblemManager) {
		$sql=$pdo->prepare("SELECT `problem_id`,`title`,`source`,`submit`,`accepted`,`defunct` FROM `problem` WHERE `defunct`='N' AND {$common_filter} AND `problem_id` NOT IN({$any_running_contest})");
	} else {
		$sql=$pdo->prepare("SELECT `problem_id`,`title`,`source`,`submit`,`accepted`,`defunct` FROM `problem` WHERE {$common_filter}");// limit $front,$PAGE_ITEMS
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
	
	//---- construct result json container variable ----
	$resultArr = array();
	foreach ($problemList as $row) { 
		
		$oneResult['pid'] = $row['problem_id'];
		$oneResult['title'] = $row['title'];
		$oneResult['tags'] = array(); // WIP
		$oneResult['source'] = utf8_substr($row['source'],0,14); 
		$oneResult['accepted'] = intval($row['accepted']);
		$oneResult['submit'] = intval($row['submit']);
		$oneResult['defunct'] = ($row['defunct'] == 'Y');
		$oneResult['undercontest'] = isset($probIDUCList[$row['problem_id']]);
		$oneResult['usersolved'] = false;
		$oneResult['usertried'] = false;
		if (isset($probStatusList[$row['problem_id']])) {
			$thisProbState = $probStatusList[$row['problem_id']];
			switch($thisProbState) {
			case "accepted":
				$oneResult['usersolved'] = true;
				$oneResult['usertried'] = true;
				break;
			default:
				$oneResult['usersolved'] = false;
				$oneResult['usertried'] = true;
				break;
			}
		}

		array_push($resultArr, $oneResult);
	}
	
	$finalResult = array("currentpage"=>$p, "totalpages"=>$pageCnt, "data"=>$resultArr);
	
	fire(200, "OK", $finalResult);
?>
