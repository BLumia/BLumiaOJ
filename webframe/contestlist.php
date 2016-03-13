<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<?php require_once('./include/contest_functions.inc.php'); ?>
		<title>Contest List</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	
	//Prepare
	$p=isset($_GET['p']) ? $_GET['p'] : 0;
	if($p<0){$p=0;}
	$front=intval($p*$PAGE_ITEMS);
	
	$sql=$pdo->prepare("select * from contest
						left join (select * from privilege where rightstr like 'm%') p on concat('m',contest_id)=rightstr
						where contest.`defunct`='N' order by contest_id desc limit $front,$PAGE_ITEMS ");
	$sql->execute();
	$contestList=$sql->fetchAll(PDO::FETCH_ASSOC);
	$contestCount=count($contestList);
	//var_dump($contestList);
	
	$sql=$pdo->prepare("select * from contest where `defunct`='N' ORDER BY `contest_id` DESC");
	$sql->execute();
	$totalContest=$sql->fetchAll(PDO::FETCH_ASSOC);
	$totalCount=count($totalContest);
	//var_dump($totalContest);
	
	$i=0;
	foreach ($contestList as $row){
	//for($i=0;$i<$contestCount;$i++) {
		//var_dump($row);
		$start_time=strtotime($row["start_time"]);
		$end_time=strtotime($row["end_time"]);
		$now=time();          
		$length=$end_time-$start_time;
		$left=$end_time-$now;
		// past
		if ($now>$end_time) {
			$contestList[$i]['content_status'] = "<span class='label label-success'>".L_Ended."</span>&nbsp;<span class='label label-success'>".$row["end_time"]."</span>";
		// pending
		} else if ($now<$start_time){
			$contestList[$i]['content_status'] = "<span class='label label-primary'>".L_Start."</span>&nbsp;<span class='label label-info'>".$row["start_time"]."</span>&nbsp;";
			$contestList[$i]['content_status'].= "<span class='label label-success'>$L_TotalTime".formatTimeLength($length)."</span>";
		// running
		}else{
			$contestList[$i]['content_status'] = "<span class='label label-danger'>".L_Running."</span>&nbsp;";
			$contestList[$i]['content_status'].= "<span class='label label-success'>".L_LeftTime.":".formatTimeLength($left)." </span>";
		}
		$private=intval($row["private"]);
		if ($private==0)
			$contestList[$i]['private'] = "<span class='label label-primary'>".L_Public."</span>";
		else
			$contestList[$i]['private'] = "<span class='label label-danger'>".L_Private."</span>";
		$i++;
	}
	
	//Page Includes
	require("./pages/contestlist.php");
?>
	
</html>