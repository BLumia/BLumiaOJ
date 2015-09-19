<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
    
	$contest_title	=$_POST['contest_title'];
	$start_year		=$_POST['start_year'];
	$start_month	=$_POST['start_month'];
	$start_day		=$_POST['start_day'];
	$start_hour		=$_POST['start_hour'];
	$start_minute	=$_POST['start_minute'];
	$end_year		=$_POST['end_year'];
	$end_month		=$_POST['end_month'];
	$end_day		=$_POST['end_day'];
	$end_hour		=$_POST['end_hour'];
	$end_minute		=$_POST['end_minute'];
	$language		=$_POST['language'];
	$permission		=$_POST['permission'];
	$contest_desc	=$_POST['contest_desc'];
	$userlist		=$_POST['userlist'];
	$cont_password	=$_POST['cont_password'];
	$problem_list	=$_POST['problem_list'];
	
	/*if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	$langmask=0;
    foreach($language as $t){
		$langmask+=1<<$t;
	} 
	$langmask=(~$langmask);
	
	$sql=$pdo->prepare("INSERT into `problem`
						(`title`,`time_limit`,`memory_limit`,`description`,`input`,`output`,`sample_input`,`sample_output`,`hint`,`source`,`spj`,`in_date`,`defunct`)
						VALUES(?,?,?,?,?,?,?,?,?,?,?,NOW(),'Y')");
	$sql->execute(array($problem_title,$time_limit,$memory_limit,$problem_desc,$problem_input,$problem_output,$samp_in_data,$samp_out_data,$problem_hint,$problem_source,$problem_spj));
	$pid = $pdo->lastinsertid();
	
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
