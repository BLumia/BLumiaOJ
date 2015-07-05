<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<?php require_once('./include/contest_functions.inc.php'); ?>
		<title>Contest - Ranklist</title>
	</head>	
	
<?php
	//Vars & Functions
	require_once('./include/setting_oj.inc.php');
	
	class Player{
		var $solved=0;
		var $time=0;
		var $p_wa_num;
		var $p_ac_sec;
		var $user_id;
		var $nick;
		function Player(){
			$this->solved=0;
			$this->time=0;
			$this->p_wa_num=array(0);
			$this->p_ac_sec=array(0);
		}
		function Add($pid,$sec,$res){
			//echo "Add $pid $sec $res<br>";
			if (isset($this->p_ac_sec[$pid])&&$this->p_ac_sec[$pid]>0)
				return;
			if ($res!=4){
				if(isset($this->p_wa_num[$pid])){
					$this->p_wa_num[$pid]++;
				}else{
					$this->p_wa_num[$pid]=1;
				}
			}else{
				$this->p_ac_sec[$pid]=$sec;
				$this->solved++;
				if(!isset($this->p_wa_num[$pid])) $this->p_wa_num[$pid]=0;
				$this->time+=$sec+$this->p_wa_num[$pid]*1200;
				//echo "Time:".$this->time."<br>";
				//echo "Solved:".$this->solved."<br>";
			}
		}
	}
	
	function s_cmp($A,$B){
		//echo "Cmp....<br>";
		if ($A->solved!=$B->solved) return $A->solved<$B->solved;
		else return $A->time>$B->time;
	}
	
	//Prepares
	$cid=isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	if ($cid==0) {
		echo "No such contest";
		exit(0);
	}
	
	$sql=$pdo->prepare("select `start_time`,`title`,`end_time` from contest where contest_id = ?");
	$sql->execute(array($cid));
	$contestItem = $sql->fetch(PDO::FETCH_ASSOC);
	
	if ($contestItem) {
		$start_time=strtotime($contestItem['start_time']); //尚未检查这些值是否正确
		$end_time=strtotime($contestItem['end_time']);
		$contest_title=$contestItem['title'];
	} else {
		echo "Content Not Exist";
		exit(0);
	}
	
	if ($start_time>time()){
		$view_errors= "Contest Not Start!";
		exit(0);
	}
	
	if (!$OJ_LOCKRANK) $OJ_LOCKRANK_PERCENT = 0 ;
	$lock_time=$end_time-($end_time-$start_time)*$OJ_LOCKRANK_PERCENT;
	
	$sql=$pdo->prepare("SELECT count(1) as probCnt FROM `contest_problem` WHERE `contest_id`=?");
	$sql->execute(array($cid));
	$problemItem=$sql->fetch();
	$problemCount=count($problemItem);
	$probCnt = $problemCount;
	
	$sql=$pdo->prepare("SELECT users.user_id,users.nick,solution.result,solution.num,solution.in_date 
	FROM (
		select * from solution where solution.contest_id=? and num>=0 
	) solution left join users on users.user_id=solution.user_id 
	ORDER BY users.user_id,in_date");
	$sql->execute(array($cid));
	$playerList = $sql->fetchAll(PDO::FETCH_ASSOC);
	var_dump($playerList);
	
	
	
	//Page Includes
	require("./pages/contest_ranklist.php");
?>
	
</html>