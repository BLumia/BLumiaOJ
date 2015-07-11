<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
	
	//比赛和非比赛状态下对应$problem_id数值含义不同，比赛时为比赛对应的题目编号，普通则为题目id
	//非hustoj兼容版或将不使用这种方式，而对所有题目增加新的全局ID
    
	$contest_id    =isset($_POST['cid']) ? intval($_POST['cid']) : false;
	$problem_id    =intval($_POST['pid']);
	$user_id       =$_SESSION['user_id'];
	$submit_lang   =$_POST['language'];
	$submit_src    =$_POST['source'];
	$submit_time   =strftime("%Y-%m-%d %H:%M",time());
	
	var_dump($problem_id);
	var_dump($submit_lang);
	var_dump($submit_src);
	
	exit(0);
	
	/*if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	// Check if Problem Exist
	if ($contest_id) {
		$sql="SELECT `problem_id` from `contest_problem` 
				where `num`='$problem_id' and contest_id=$contest_id";
	} else {
		$sql="SELECT `problem_id` from `problem` where `problem_id`='$problem_id' and problem_id not in (select distinct problem_id from contest_problem where `contest_id` IN (
			SELECT `contest_id` FROM `contest` WHERE 
			(`end_time`>'$now' or private=1)and `defunct`='N'
			))";
		if(!isset($_SESSION['administrator']))
			$sql.=" and defunct='N'";
	}
	
	$sql=$pdo->prepare($sql);
	$sql->execute();
	$existChecker = $sql->fetchAll(PDO::FETCH_ASSOC);
	$sql->closeCursor();
	$existCounter = count($existChecker);
	if ($existCounter < 1) {
		echo "403";
		exit(0);
	}
	
	echo "done";
	exit(0);
	//--------------代码分割线
	
	$basedir = "$OJ_PROBLEM_DATA/$pid";
	
	if($ENV_CASE!="SAE"){
		mkdir($basedir);
		echo $basedir;
		if(strlen($samp_out_data)&&!strlen($samp_in_data)) $samp_in_data="0";
		if(strlen($samp_in_data)) mkdata($pid,"sample.in",$samp_in_data,$OJ_PROBLEM_DATA);
		if(strlen($samp_out_data))mkdata($pid,"sample.out",$samp_out_data,$OJ_PROBLEM_DATA);
		if(strlen($test_out_data)&&!strlen($test_in_data)) $test_in_data="0";
		if(strlen($test_in_data))mkdata($pid,"test.in",$test_in_data,$OJ_PROBLEM_DATA);
		if(strlen($test_out_data))mkdata($pid,"test.out",$test_out_data,$OJ_PROBLEM_DATA);
		
		echo "[$problem_title]data in $basedir";
	}
	
?>
