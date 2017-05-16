<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
	require_once("../include/user_check_functions.php");
    
	$contest_title	=$_POST['contest_title'];
	$start_year		=intval($_POST['start_year']);
	$start_month	=intval($_POST['start_month']);
	$start_day		=intval($_POST['start_day']);
	$start_hour		=intval($_POST['start_hour']);
	$start_minute	=intval($_POST['start_minute']);
	$end_year		=intval($_POST['end_year']);
	$end_month		=intval($_POST['end_month']);
	$end_day		=intval($_POST['end_day']);
	$end_hour		=intval($_POST['end_hour']);
	$end_minute		=intval($_POST['end_minute']);
	$language		=$_POST['language'];
	$permission		=$_POST['permission'];
	$contest_desc	=$_POST['contest_desc'];
	$user_list		=$_POST['userlist'];
	$cont_password	=$_POST['cont_password'];
	$problem_list	=trim($_POST['problem_list']);
	$cid			=intval($_POST['contest_id']);
	
	$start_time		=$start_year."-".$start_month."-".$start_day." ".$start_hour.":".$start_minute.":00";
	$end_time		=$end_year."-".$end_month."-".$end_day." ".$end_hour.":".$end_minute.":00";
	
	//Privilege Check
	if (!(isset($_SESSION["m$cid"])||havePrivilege("CONTEST_EDITOR"))) {
		exit("403");
	}
	/*
	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}
	*/
	
	$langmask=0;
    foreach($language as $t){
		$langmask+=1<<$t;
	} 
	$langmask=(~$langmask);
	
	// TODO: check if contest is exist.
	if ($cid == 0) {
		$sql=$pdo->prepare("INSERT INTO `contest`
		(`title`,`start_time`,`end_time`,`private`,`langmask`,`description`,`password`)
		VALUES
		(?,?,?,?,?,?,?)");
		$sql->execute(array($contest_title,$start_time,$end_time,$permission,$langmask,$contest_desc,$cont_password));
		$cid = $pdo->lastinsertid(); // TODO: check if insert failed
		echo "Add Contest ".$cid."<br/>";
	} else {
		$sql=$pdo->prepare("UPDATE `contest` set `title`=?,description=?,`start_time`=?,`end_time`=?,`private`=?,`langmask`=?,`password`=? WHERE `contest_id`=?");
		$sql->execute(array($contest_title,$contest_desc,$start_time,$end_time,$permission,$langmask,$cont_password,$cid));
		echo "Now Modifing Contest ".$cid."<br/>";
	}
	
	$sql_str="DELETE FROM `contest_problem` WHERE `contest_id`=$cid";
	$affectedRowCnt = $pdo->exec($sql_str);
	if ($affectedRowCnt > 0) echo "Delete ".$affectedRowCnt." rows from Problem of Contests database.<br/>";
	
	$problem_array = explode(",",$problem_list);
	if (count($problem_array)>0 && strlen($problem_array[0])>0){
		$sql_str="INSERT INTO 
				`contest_problem`(`contest_id`,`problem_id`,`num`) 
				VALUES ('$cid','$problem_array[0]',0)";
		for ($i=1;$i<count($problem_array);$i++){
			$sql_str=$sql_str.",('$cid','$problem_array[$i]',$i)";
		}
		//echo $sql_str;
		$affectedRowCnt = $pdo->exec($sql_str);
		if ($affectedRowCnt > 0) echo "Insert ".$affectedRowCnt." rows to Problem of Contests database.<br/>";
		$sql_str="update `problem` set defunct='N' where `problem_id` in ($problem_list)";
		$affectedRowCnt = $pdo->exec($sql_str);
		if ($affectedRowCnt > 0) echo "Update ".$affectedRowCnt." rows to Problems database.<br/>";
	}
	
	$sql_str="DELETE FROM `privilege` WHERE `rightstr`='m$cid'";
	$affectedRowCnt = $pdo->exec($sql_str);
	if ($affectedRowCnt > 0) echo "Delete ".$affectedRowCnt." rows from database.<br/>";
	$sql_str="INSERT into `privilege` (`user_id`,`rightstr`)  
				values('".$_SESSION['user_id']."','m$cid')";
	$affectedRowCnt = $pdo->exec($sql_str);
	if ($affectedRowCnt > 0) echo "Insert ".$affectedRowCnt." rows to Privilege database for manager of the contest.<br/>";
	
	//$_SESSION["m$cid"]=true; // what did this line do...
	
	$user_array = explode("\n", trim($user_list));
	if (count($user_array)>0 && strlen($user_array[0])>0){
		$sql_str="INSERT INTO `privilege`(`user_id`,`rightstr`) 
			VALUES ('".trim($user_array[0])."','c$cid')";
		for ($i=1;$i<count($user_array);$i++)
			$sql_str=$sql_str.",('".trim($user_array[$i])."','c$cid')";
		//echo $sql_str;
		$affectedRowCnt = $pdo->exec($sql_str);
		if ($affectedRowCnt > 0) echo "Insert ".$affectedRowCnt." rows to Privilege database for required member of a contest.<br/>";
	}
	
	echo "Task Complete.<br/>"
	echo "<a href='../admin/contest_editor.php?cid={$cid}'>Click HERE</a> to continue edit or <a href='../contest.php?cid={$cid}'>Click HERE</a> to see this contest.";
	/*
	echo "<script>window.location.href=\"contest_list.php\";</script>";
	*/
?>
