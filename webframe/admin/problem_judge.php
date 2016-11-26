<?php
	/*  
		This is a HUST OJ adapter.
		HUST OJ's Judged (Judge Daemon) use this as an api to set solution judge result.
		
		POST:
		'manual'
			'sid','result',
			'explain' // optional, judge result explain.
		'update_solution'
			'sid','result',
			'time','memory','pass_rate',
			'sim','simid' // optional, for sim (cheat check)
	*/

	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	
	// Permission check
	if (!(isset($_SESSION['http_judge']))){
		echo "403";
		exit(1);
	}
	
	if (isset($_POST['manual'])) {
		$sid = intval($_POST['sid']);
        $result = intval($_POST['result']);
		if ($result >= 0) {
			$sql=$pdo->prepare("UPDATE solution SET result=? WHERE solution_id=? LIMIT 1");
			$sql->execute(array($result,$sid));
		}
		if(isset($_POST['explain'])){
			$sql=$pdo->prepare("DELETE FROM runtimeinfo WHERE solution_id=?");
			$sql->execute(array($sid));
			
			// make sure $reinfo safe for db?
			$sql=$pdo->prepare("INSERT INTO runtimeinfo VALUES(?,?)");
			$sql->execute(array($sid,$reinfo));
        }
		echo "<script>history.go(-1);</script>";
		exit(1);
	}
	
	if(isset($_POST['update_solution'])) {
		$sid = intval($_POST['sid']);
		$result = intval($_POST['result']);
		$time = intval($_POST['time']);
		$memory = intval($_POST['memory']);
		$sim = intval($_POST['sim']);
		$simid = intval($_POST['simid']);
		$pass_rate = floatval($_POST['pass_rate']);
		
		$sql=$pdo->prepare("UPDATE solution SET result=?,time=?,memory=?,judgetime=NOW(),pass_rate=? WHERE solution_id=? LIMIT 1");
		$sql->execute(array($result,$time,$memory,$pass_rate,$sid));
		
		if ($sim) {
			$sql=$pdo->prepare("INSERT INTO sim(s_id,sim_s_id,sim) VALUES(?,?,?) ON DUPLICATE KEY UPDATE sim_s_id=?,sim=?");
			$sql->execute(array($sid,$simid,$sim,$simid,$sim));
		}
		
		exit(1);
	}
	
	

?>