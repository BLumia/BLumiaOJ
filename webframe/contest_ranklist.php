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
	require_once('./include/common_const.inc.php');
	require_once('./include/user_check_functions.php');
	
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
	
	$highlightID = isset($_REQUEST['user_id']) ? $_REQUEST['user_id'] : "";
	
	$sql=$pdo->prepare("SELECT `start_time`,`title`,`end_time`,`password` FROM contest WHERE contest_id = ?");
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
	
	if ($start_time>time()) {
		$view_errors= "Contest Not Start!";
		exit(0);
	}
	
	if (!$OJ_LOCKRANK) $OJ_LOCKRANK_PERCENT = 0 ;
	$lock_time=$end_time-($end_time-$start_time)*$OJ_LOCKRANK_PERCENT;
	
	$sql=$pdo->prepare("SELECT count(1) AS probCnt FROM `contest_problem` WHERE `contest_id`=?");
	$sql->execute(array($cid));
	$problemItem=$sql->fetch(PDO::FETCH_ASSOC);//必须写PDO::FETCH_ASSOC，否则默认值影响count
	$problemCount=$problemItem['probCnt'];
	
	$sql=$pdo->prepare("SELECT users.user_id,users.nick,solution.result,solution.num,solution.in_date 
	FROM (
		SELECT * FROM solution WHERE solution.contest_id=? AND num>=0 
	) solution LEFT JOIN users ON users.user_id=solution.user_id 
	ORDER BY users.user_id,in_date");
	$sql->execute(array($cid));
	$playerList = $sql->fetchAll(PDO::FETCH_ASSOC);
	//var_dump($playerList);
	$playerCount = count($playerList);
	
	$user_cnt=0;
	$user_name='';
	$playerArr=array();
	for ($i=0;$i<$playerCount;$i++){
		$onePlayer = $playerList[$i];
		$n_user=$onePlayer['user_id'];
		if (strcmp($user_name,$n_user)){
			$user_cnt++;
			$playerArr[$user_cnt]=new Player();
			$playerArr[$user_cnt]->user_id=$onePlayer['user_id'];
			$playerArr[$user_cnt]->nick=$onePlayer['nick'];
			$user_name=$n_user;
        }
		if(time()<$end_time&&$lock_time<strtotime($onePlayer['in_date']))
			$playerArr[$user_cnt]->Add($onePlayer['num'],strtotime($onePlayer['in_date'])-$start_time,0);
		else
			$playerArr[$user_cnt]->Add($onePlayer['num'],strtotime($onePlayer['in_date'])-$start_time,intval($onePlayer['result']));
	}
	usort($playerArr,"s_cmp");
	
	$first_blood=array();
	for($i=0;$i<$problemCount;$i++){
		$sql=$pdo->prepare("SELECT user_id FROM solution WHERE contest_id=? AND result=4 AND num=? ORDER BY in_date LIMIT 1");
		$sql->execute(array($cid,$i));
		$fbResult = $sql->fetch(PDO::FETCH_ASSOC);
		$fbResultCount=count($fbResult);
		$first_blood[$i] = ($fbResultCount) ? $fbResult['user_id'] : "";
	}
	
	//Page Includes
	require("./pages/contest_ranklist.php");
?>
	
</html>