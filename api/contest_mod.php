<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
	require_once("../include/common_functions.inc.php");
	require_once("../include/user_check_functions.php");
	
	function problem_insert_sql($cid, $problem_arr) {
		$base_sql_str = "INSERT INTO `contest_problem`(`contest_id`,`problem_id`,`num`) VALUES ";
		$strArr = array();
		foreach($problem_arr as $oneProblem) array_push($strArr, "('{$cid}','{$oneProblem}',0)");
		$append_sql_str = implode(', ', $strArr);
		return $base_sql_str.$append_sql_str;
	}
    
	$contest_title	=@defined_or_die($_POST['contest_title']);
	$start_year		=@defined_int_or_die($_POST['start_year']);
	$start_month	=@defined_int_or_die($_POST['start_month']);
	$start_day		=@defined_int_or_die($_POST['start_day']);
	$start_hour		=@defined_int_or_die($_POST['start_hour']);
	$start_minute	=@defined_int_or_die($_POST['start_minute']);
	$end_year		=@defined_int_or_die($_POST['end_year']);
	$end_month		=@defined_int_or_die($_POST['end_month']);
	$end_day		=@defined_int_or_die($_POST['end_day']);
	$end_hour		=@defined_int_or_die($_POST['end_hour']);
	$end_minute		=@defined_int_or_die($_POST['end_minute']);
	$language		=@defined_or_die($_POST['language']);
	$permission		=@defined_int_or_die($_POST['permission']);
	$contest_desc	=@defined_or_die($_POST['contest_desc']);
	$user_list		=@defined_or_die($_POST['userlist']);
	$cont_password	=@defined_or_die($_POST['cont_password']);
	$problem_list	=@defined_or_die($_POST['problem_list']);
	$cid			=@defined_int_or_die($_POST['contest_id']);
	
	$start_time		=$start_year."-".$start_month."-".$start_day." ".$start_hour.":".$start_minute.":00";
	$end_time		=$end_year."-".$end_month."-".$end_day." ".$end_hour.":".$end_minute.":00";
	
	//Privilege Check
	if (!(isset($_SESSION["m$cid"])||havePrivilege("CONTEST_EDITOR"))) {
		fire(403, "Forbidden");
	}
	
	$langmask=0;
    foreach($language as $t){
		$langmask+=1<<$t;
	} 
	$langmask=(~$langmask);
	
	try {
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// in fact MyISAM engine doesn't support transaction at all, but just use transaction here, won't cause a exception.
		$pdo->beginTransaction();
		if ($cid == 0) {
			$sql=$pdo->prepare("INSERT INTO `contest`
			(`title`,`start_time`,`end_time`,`private`,`langmask`,`description`,`password`)
			VALUES (?,?,?,?,?,?,?)");
			$sql->execute(array($contest_title,$start_time,$end_time,$permission,$langmask,$contest_desc,$cont_password));
			$cid = $pdo->lastinsertid(); // TODO: check if insert failed
			echo "Add Contest ".$cid."<br/>";
		} else {
			// TODO: check if contest is exist.
			$sql=$pdo->prepare("UPDATE `contest` set `title`=?,description=?,`start_time`=?,`end_time`=?,`private`=?,`langmask`=?,`password`=? WHERE `contest_id`=?");
			$sql->execute(array($contest_title,$contest_desc,$start_time,$end_time,$permission,$langmask,$cont_password,$cid));
			echo "Now Modifing Contest ".$cid."<br/>";
		}
		$pdo->commit();
	} catch (Exception $e) {
		$pdo->rollBack();
		fire(500, "Error when insert or update the contest table.");
	}
	
	$sql_str="DELETE FROM `contest_problem` WHERE `contest_id`=$cid";
	$affectedRowCnt = $pdo->exec($sql_str);
	if ($affectedRowCnt > 0) echo "Delete ".$affectedRowCnt." rows from Problem of Contests database.<br/>";
	
	$problem_array = array_values(array_filter(explode(",",$problem_list))); 
	if (count($problem_array) > 0) {
		foreach($problem_array as $oneKey => $oneProblem) {
			if (!is_numeric($oneProblem)) {
				unset($problem_array[$oneKey]);
				continue;
			}
		}
		$problem_list = implode(',', $problem_array); // cleaned problem list string.
		$affectedRowCnt = $pdo->exec(problem_insert_sql($cid, $problem_array));
		if ($affectedRowCnt > 0) echo "Insert ".$affectedRowCnt." rows to Problem of Contests database.<br/>";
		$sql_str="UPDATE `problem` SET defunct='N' WHERE `problem_id` IN ({$problem_list})";
		$affectedRowCnt = $pdo->exec($sql_str);
		if ($affectedRowCnt > 0) echo "Update ".$affectedRowCnt." rows to Problems database.<br/>";
	}
	
	$sql_str="DELETE FROM `privilege` WHERE `rightstr`='m$cid'";
	$affectedRowCnt = $pdo->exec($sql_str);
	if ($affectedRowCnt > 0) echo "Delete ".$affectedRowCnt." rows from database.<br/>";
	$sql_str="INSERT INTO `privilege` (`user_id`,`rightstr`)  
				VALUES('".$_SESSION['user_id']."','m$cid')";
	$affectedRowCnt = $pdo->exec($sql_str);
	if ($affectedRowCnt > 0) echo "Insert ".$affectedRowCnt." rows to Privilege database for manager of the contest.<br/>";
	
	$user_array = explode("\n", trim($user_list)); // TODO: use array_filter() to remove the empty element
	if (count($user_array)>0 && strlen($user_array[0])>0){
		$sql_str="INSERT INTO `privilege`(`user_id`,`rightstr`) 
			VALUES ('".trim($user_array[0])."','c$cid')";
		for ($i=1;$i<count($user_array);$i++)
			$sql_str=$sql_str.",('".trim($user_array[$i])."','c$cid')";
		//echo $sql_str;
		$affectedRowCnt = $pdo->exec($sql_str);
		if ($affectedRowCnt > 0) echo "Insert ".$affectedRowCnt." rows to Privilege database for required member of a contest.<br/>";
	}
	
	echo "Task Complete.<br/>";
	echo "<a href='../admin/contest_editor.php?cid={$cid}'>Click HERE</a> to continue edit or <a href='../contest.php?cid={$cid}'>Click HERE</a> to see this contest.";
	/*
	echo "<script>window.location.href=\"contest_list.php\";</script>";
	*/
?>
