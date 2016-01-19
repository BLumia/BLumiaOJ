<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
    
	$pid		   =intval($_POST['problem_id']);
	$problem_title =$_POST['problem_title'];
	$time_limit    =$_POST['time_limit'];
	$memory_limit  =$_POST['memory_limit'];
	$problem_desc  =$_POST['problem_desc'];
	$problem_input =$_POST['problem_input'];
	$problem_output=$_POST['problem_output'];
	$samp_in_data  =$_POST['samp_in_data'];
	$samp_out_data =$_POST['samp_out_data'];
	$test_in_data  =$_POST['test_in_data'];
	$test_out_data =$_POST['test_out_data'];
	$problem_hint  =$_POST['problem_hint'];
	$problem_spj   =$_POST['problem_spj'];
	$problem_source=$_POST['problem_source'];
	
	$isAddProblem = ($pid == 0) ? true : false;
	
	if (!(isset($_SESSION['administrator'])) && !isset( $_SESSION['op_ProblemEditor'] )){
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
	
	/*if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	if ($isAddProblem) {
		$sql=$pdo->prepare("INSERT into `problem`
						(`title`,`time_limit`,`memory_limit`,`description`,`input`,`output`,`sample_input`,`sample_output`,`hint`,`source`,`spj`,`in_date`,`defunct`)
						VALUES(?,?,?,?,?,?,?,?,?,?,?,NOW(),'Y')");
		$sql->execute(array($problem_title,$time_limit,$memory_limit,$problem_desc,$problem_input,$problem_output,$samp_in_data,$samp_out_data,$problem_hint,$problem_source,$problem_spj));
		$pid = $pdo->lastinsertid();
		echo "Now Added Problem ".$pid."<br/>";
	} else {
		$sql=$pdo->prepare("UPDATE `problem` 
						set `title`=?,`time_limit`=?,`memory_limit`=?,
						`description`=?,`input`=?,`output`=?,
						`sample_input`=?,`sample_output`=?,`hint`=?,
						`source`=?,`spj`=?,`in_date`=NOW()
						WHERE `problem_id`=?");
		$sql->execute(array($problem_title,$time_limit,$memory_limit,$problem_desc,$problem_input,$problem_output,$samp_in_data,$samp_out_data,$problem_hint,$problem_source,$problem_spj,$pid));
		echo "Now Modifing Problem ".$pid."<br/>";
	}
	
	$basedir = "$OJ_PROBLEM_DATA/$pid";
	
	if ($isAddProblem) {
		if($ENV_CASE!="SAE"){
			mkdir($basedir);
			echo "Now Adding data at ".$basedir."<br/>";
			if(strlen($samp_out_data)&&!strlen($samp_in_data)) $samp_in_data="0";
			if(strlen($samp_in_data)) mkdata($pid,"sample.in",$samp_in_data,$OJ_PROBLEM_DATA);
			if(strlen($samp_out_data))mkdata($pid,"sample.out",$samp_out_data,$OJ_PROBLEM_DATA);
			if(strlen($test_out_data)&&!strlen($test_in_data)) $test_in_data="0";
			if(strlen($test_in_data))mkdata($pid,"test.in",$test_in_data,$OJ_PROBLEM_DATA);
			if(strlen($test_out_data))mkdata($pid,"test.out",$test_out_data,$OJ_PROBLEM_DATA);
			
			echo "[$problem_title] data in $basedir <br/>";
		}
	} else {
	
		if($ENV_CASE!="SAE"){
			//mkdir($basedir);
			
			if($samp_in_data){
				echo "Now Updating data at: ".$basedir."<br/>";
				$fp=fopen($basedir."/sample.in","w");
				fputs($fp,preg_replace("(\r\n)","\n",$samp_in_data));
				fclose($fp);
				$fp=fopen($basedir."/sample.out","w");
				fputs($fp,preg_replace("(\r\n)","\n",$samp_out_data));
				fclose($fp);
			}
			
			if($test_in_data){
				echo "Now Updating data at: ".$basedir."<br/>";
				$fp=fopen($basedir."/test.in","w");
				fputs($fp,preg_replace("(\r\n)","\n",$test_in_data));
				fclose($fp);
				$fp=fopen($basedir."/test.out","w");
				fputs($fp,preg_replace("(\r\n)","\n",$test_out_data));
				fclose($fp);
			}
			
			echo "[$problem_title] data in $basedir <br/>";
		}
	}
?>
