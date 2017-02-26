<?php
	/*
		This page accept provide contest judge status display.
		Normal judge status please see `status.php`
		
		GET:
		'cid' (REQUIRED) // contest_id
		'p' (default value 1) // Page number.
		'top' // The top `solution_id` of the result will be the value of 'top'
		'pid' // All status of the given problem. (TODO: Contest problem number, not real problem id)
		'uid' // All status of the given user.
		'language' // Language filter
		'judgeresult' // Judge result filter
	*/
	session_start();
	//Vars
	require_once("./include/setting_oj.inc.php");
	require_once('./include/common_const.inc.php');
	require_once('./include/user_check_functions.php');
	
	//Prepares
	$lang_count=count($LANGUAGE_EXT);
	$langmask=$OJ_LANGMASK;
	
	//Page
	$p=isset($_GET['p']) ? $_GET['p'] : 0;
	if($p<0){$p=0;}
	$front=intval($p*$PAGE_ITEMS);
	
	//Contest ID
	if (!isset($_GET['cid'])){
		echo "403";
		exit(0);
	}
	$cid=intval($_GET['cid']);
	
	// TODO: 时间范围

	// Problem ID match
	$sql=$pdo->prepare("
			SELECT `problem`.`problem_id` AS `pid`,`contest_problem`.`num` AS `pnum`
			FROM `contest_problem`,`problem`
			WHERE `contest_problem`.`problem_id`=`problem`.`problem_id` 
			AND `contest_problem`.`contest_id`=? ORDER BY `contest_problem`.`num` 
	");
	$sql->execute(array($cid));
	$problemList=$sql->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($problemList);
	foreach($problemList as $oneProblem) {
		$problemIDPair[$oneProblem['pid']] = $oneProblem['pnum'];
	}

	//SQL Basic
	if(havePrivilege("SOURCE_VIEWER")||(isset($_SESSION['user_id'])&&isset($_GET['user_id'])&&$_GET['user_id']==$_SESSION['user_id'])){
		if ($_SESSION['user_id']!="guest") $sql_str="SELECT * FROM `solution` WHERE `contest_id`='{$cid}' ";
	} else {
		$sql_str="SELECT * FROM `solution` WHERE problem_id>0 and `contest_id`='{$cid}' ";
	}
	$order_str=" ORDER BY `solution_id` DESC ";
	
	//Check "top" arg
	if (isset($_GET['top'])&&$_GET['top']!="") {
		$top=intval($_GET['top']);
		if ($top!=-1) $sql_str=$sql_str."AND `solution_id`<='{$top}' ";
	}
	
	//Check problem("pid") arg
	$problem_id="";
	if (isset($_GET['pid'])&&$_GET['pid']!="") {
		$problem_id=intval($_GET['pid']);
		$sql_str=$sql_str."AND `problem_id`=(SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`={$cid} AND `num`={$problem_id})";
		$problem_id = $ALPHABET_N_NUM[$problem_id];
	}
	
	//Check UserID("uid") arg
	$user_id="";
	if (isset($_GET['uid'])&&$_GET['uid']!=""){
		$user_id=trim($_GET['uid']);
		if (isUseridExist($user_id,$pdo) && $user_id!=""){
			$sql_str=$sql_str."AND `user_id`='{$user_id}' ";
        } else {
			$user_id="";
		}
	}
	
	//Check "language" arg
	if (isset($_GET['language'])) $language=intval($_GET['language']);
	else $language=-1;
	if ($language>count($LANGUAGE_EXT) || $language<0) $language=-1;
	if ($language!=-1) {
        $sql_str=$sql_str."AND `language`='{$language}' ";
	}
	
	//Check "judgeresult" arg
	if (isset($_GET['judgeresult'])) $result=intval($_GET['judgeresult']);
	else $result=-1;
	if ($result>count($JUDGE_RESULT) || $result<0) $result=-1;
	if ($result!=-1) {
        $sql_str=$sql_str."AND `result`='{$result}' ";
	}
	
	//Ignore SIM stuff
	
	//SQL Complete
	$sql_str=$sql_str.$order_str." LIMIT 20";
	
	$sql=$pdo->prepare($sql_str);
	$sql->execute();
	$statusResult=$sql->fetchAll(PDO::FETCH_ASSOC);
	$totalCount=count($statusResult);
	//print_r($statusResult);
	
	//Contest Item
	$sql=$pdo->prepare("SELECT * FROM contest WHERE contest_id = ?");
	$sql->execute(array($cid));
	$contestItem=$sql->fetch(PDO::FETCH_ASSOC);

	//Page Includes
	require("./pages/contest_status.php");
?>
