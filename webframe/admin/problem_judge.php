<?php
	/*  
		This is a HUST OJ adapter.
		HUST OJ's Judged (Judge Daemon) use this as an api to set solution judge result.
		
		POST:
		'manual' // Set sid solution's result, also optional explain
			'sid','result',
			'explain' // optional, judge result explain.
		'update_solution'
			'sid','result',
			'time','memory','pass_rate',
			'sim','simid' // optional, for sim (cheat check)
		'checkout' // [`judged` use this] Update all unjudged sumbit as {$result} ???
			'sid','result'
		'getpending' // [`judged` use this] Return a list of pending status solution_id, one sid per line.
			'max_running'
			'oj_lang_set'
		'getsolutioninfo' // Return problem_id, user_id and language of given sid.
			'sid'
		'getsolution' // Get solution source of given sid. 
			'sid'
		'getcustominput' // Custon input of given sid. wait, wtf is it?
			'sid'
		'getprobleminfo' // given pid. finally one not using sid.
			'pid'
		'addceinfo' // Add compile error info
			'sid'
			'ceinfo'
		'addreinfo' // Add runtime error info
			'sid'
			'reinfo'
		'updateuser' // Update user solved count and submit count
			'user_id'
		'updateproblem' // Update how many people solved this problem
			'pid'
		'checklogin' // [`judged` use this] What's the **** man? Always return 1 ?
		'gettestdatalist'
			'pid'
		'gettestdata' 
			'filename'
	*/

	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	
	// Permission check
	if (!(isset($_SESSION['http_judge']))){
		exit("0"); // Should return "0", used by checklogin. return a zero if don't have the rights to use this api.
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
		exit(0); // should return now?
	}
	
	if (isset($_POST['update_solution'])) {
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
		
		exit(0);
	}
	
	if (isset($_POST['checkout'])) {
		$sid = intval($_POST['sid']);
		$result = intval($_POST['result']);
		$sql=$pdo->prepare("UPDATE solution SET result=?,time=0,memory=0,judgetime=NOW() WHERE solution_id=? and (result<2 or (result<4 and NOW()-judgetime>60)) LIMIT 1");
		$affectedRowCnt = $sql->execute(array($result, $sid));
		
		echo ($affectedRowCnt > 0) ? "1" : "0";
		exit(0);
	}
	
	if (isset($_POST['getpending'])) {
		$max_running = intval($_POST['max_running']);
		$oj_lang_set = $_POST['oj_lang_set'];
		$sql=$pdo->prepare("SELECT solution_id FROM solution WHERE language in ($oj_lang_set) and (result<2 or (result<4 and NOW()-judgetime>60)) ORDER BY result ASC,solution_id ASC limit $max_running");
		$sql->execute();
		$result = $sql->fetchAll(PDO::FETCH_ASSOC);
		
		foreach($result as $row) {
			echo $row['solution_id']."\n";
		}
		
		exit(0);
	}
	
	if (isset($_POST['getsolutioninfo'])) {
		$sid = intval($_POST['sid']);
		$sql=$pdo->prepare("SELECT problem_id, user_id, language FROM solution WHERE solution_id=?");
		$sql->execute(array($sid));
		$result = $sql->fetch(PDO::FETCH_ASSOC);
		
		if(count($result) == 1) {
			echo $result['problem_id']."\n";
			echo $result['user_id']."\n";
			echo $result['language']."\n";	
		}
		
		exit(0);
	}
	
	if (isset($_POST['getsolution'])) {
		$sid = intval($_POST['sid']);
		$sql = $pdo->prepare("SELECT source FROM source_code WHERE solution_id=?");
		$sql->execute(array($sid));
		$result = $sql->fetch(PDO::FETCH_ASSOC);

		if(count($result) == 1) {
			echo $result['source']."\n";
		}
		
		exit(0);
	}
	
	if (isset($_POST['getcustominput'])) {
		$sid = intval($_POST['sid']);
		$sql = $pdo->prepare("SELECT input_text FROM custominput WHERE solution_id=?");
		$sql->execute(array($sid));
		$result = $sql->fetch(PDO::FETCH_ASSOC);

		if(count($result) == 1) {
			echo $result['input_text']."\n";
		}

		exit(0);
	}

	if (isset($_POST['getprobleminfo'])) {
		$pid = intval($_POST['pid']);
		$sql = $pdo->prepare("SELECT time_limit,memory_limit,spj FROM problem where problem_id=?");
		$sql->execute(array($pid));
		$result = $sql->fetch(PDO::FETCH_ASSOC);

		if(count($result) == 1) {
			echo $result['time_limit']."\n";
			echo $result['memory_limit']."\n";
			echo $result['spj']."\n";
		}

		exit(0);
	}
	
	if (isset($_POST['addceinfo'])) {
		$sid = intval($_POST['sid']);
		$ceinfo = $_POST['ceinfo'];
		
		$sql = $pdo->prepare("DELETE FROM compileinfo WHERE solution_id=?");
		$sql->execute(array($sid));
		
		// $ceinfo safe check?
		$sql = $pdo->prepare("INSERT INTO compileinfo VALUES(?,?)");
		$sql->execute(array($sid,$ceinfo));
		
		exit(0);
	}

	if (isset($_POST['addreinfo'])) {
		$sid = intval($_POST['sid']);
		$reinfo = $_POST['reinfo'];
		
		$sql = $pdo->prepare("DELETE FROM runtimeinfo WHERE solution_id=?");
		$sql->execute(array($sid));
		
		// $reinfo safe check?
		$sql = $pdo->prepare("INSERT INTO runtimeinfo VALUES(?,?)");
		$sql->execute(array($sid,$reinfo));
		
		exit(0);
	}
	
	if (isset($_POST['updateuser'])) {
		$user_id = $_POST['user_id']; // safe check?
		
		$sql = $pdo->prepare("UPDATE `users` SET `solved`=(SELECT count(DISTINCT `problem_id`) FROM `solution` WHERE `user_id`=? AND `result`=4) WHERE `user_id`=?");
		$sql->execute(array($user_id, $user_id));
		
		$sql = $pdo->prepare("UPDATE `users` SET `submit`=(SELECT count(*) FROM `solution` WHERE `user_id`=?) WHERE `user_id`=?");
		$sql->execute(array($user_id,$user_id));
		
		exit(0);
	}
	
	if (isset($_POST['updateproblem'])) {
		$pid = intval($_POST['pid']);
		
		$sql = $pdo->prepare("UPDATE `problem` SET `accepted`=(SELECT count(1) FROM `solution` WHERE `problem_id`=? AND `result`=4) WHERE `problem_id`=?");
		$sql->execute(array($pid, $pid));
		
		$sql = $pdo->prepare("UPDATE `problem` SET `submit`=(SELECT count(1) FROM `solution` WHERE `problem_id`=?) WHERE `problem_id`=?");
		$sql->execute(array($pid,$pid));
		
		exit(0);
	}
	
	if (isset($_POST['checklogin'])) {
		exit("1"); // WTF ???????!!!!!!!
	}
	
	if (isset($_POST['gettestdatalist'])) {
		$pid = intval($_POST['pid']);
		
		// SAE support unavaliable now.
		
		$dir = opendir($OJ_PROBLEM_DATA."/$pid");
		while (($file = readdir($dir)) != "") {
			if(!is_dir($file)){
				$file=pathinfo($file);
				$file=$file['basename'];
				echo "$file\n";
			}
		}
		closedir($dir);
		
		exit(0);
	}
	
	if (isset($_POST['gettestdata'])) {
		$file=$_POST['filename'];
		echo file_get_contents($OJ_PROBLEM_DATA.'/'.$file);
		exit(0);
	}
?>