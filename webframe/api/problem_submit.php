<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_const.inc.php");
	require_once("../include/file_functions.php");
	require_once("../include/user_check_functions.php");
	
	//比赛和非比赛状态下对应$problem_id数值含义不同，比赛时为比赛对应的题目编号，普通则为题目id
	//非hustoj兼容版或将不使用这种方式，而对所有题目增加新的全局ID
    
	$contest_id    =isset($_POST['cid']) ? intval($_POST['cid']) : false;
	$problem_id    =intval($_POST['pid']);
	$user_id       =$_SESSION['user_id'];
	$submit_lang   =intval($_POST['language']);
	$submit_src    =$_POST['source'];
	$submit_time   =strftime("%Y-%m-%d %H:%M",time());
	$submit_ip	   =$_SERVER['REMOTE_ADDR'];
	
	// Process variable
	if ($submit_lang>count($LANGUAGE_NAME) || $submit_lang<0) $submit_lang=0;
	$submit_src=preg_replace ( "(\r\n)", "\n", $submit_src );
	
	//var_dump($problem_id);
	//var_dump($submit_lang);
	//var_dump($submit_src);
	
	//check code length
	$code_len=strlen($submit_src);
	if($code_len < 2) {
		echo "your code is tooooo short.";
		exit(403);
	}
	if($code_len > 65536) {
		echo "your code is tooooo long.";
		exit(403);
	}
	
	/*if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	// Check if in Contest and if Contest is start or not
	if ($contest_id) {
		$sql=$pdo->prepare("SELECT `private`,`password` FROM `contest` WHERE `contest_id`=? AND `start_time`<=? AND `end_time`>?");
		$sql->execute(array($contest_id,$submit_time,$submit_time));
		$contestChecker = $sql->fetch(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		if(count($contestChecker)!=2) { // Two are: private and password. Maybe another way to check if contest exist?
			echo "Contest not exist.";
			exit(0);
		} else {
			// Check private, private=1 means need invite
			if(intval($contestChecker['private']) == 1) {
				// Password or User in list.
				if (havePrivilege("CONTEST_EDITOR") || isset($_SESSION["m{$contest_id}"]) || isset($_SESSION["c{$contest_id}"])) {
					// Check done.
				} else {
					// Password session missed? user should enter the contest by using password to get a new session.
					$sql=$pdo->prepare("SELECT count(*) FROM `privilege` WHERE `user_id`='$user_id' AND `rightstr`='c{$contest_id}'");
					$sql->execute(array($user_id,"c{$contest_id}"));
					$privateChecker = $sql->fetch(PDO::FETCH_ASSOC);
					//var_dump($privateChecker);
					if (intval($privateChecker['count(*)']) != 1) {
						echo "No permission to taking part in this contest.<br/>";
						if ($contestChecker['password'] != '') echo "Or you maybe need to enter password again.<br/>";
						exit(403);
					}
				}
			}
		}
	}
	
	// Check if Problem Exist
	if ($contest_id) {
		$sql="SELECT `problem_id` from `contest_problem` 
				where `num`='{$problem_id}' and contest_id={$contest_id}";
	} else {
		$sql="SELECT `problem_id` from `problem` where `problem_id`='{$problem_id}' and problem_id not in (select distinct problem_id from contest_problem where `contest_id` IN (
			SELECT `contest_id` FROM `contest` WHERE 
			(`end_time`>'{$submit_time}' or private=1)and `defunct`='N'
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
	
	//ignore append code feature.
	//cookie
	setcookie('lastlang',$submit_lang,time()+360000);
	
	//check last submit time
	$ckeckTime=strftime("%Y-%m-%d %X",time()-$OJ_SUBMIT_DELTATIME);
	$sql=$pdo->prepare("SELECT `in_date` from `solution` where `user_id`=? and in_date>? order by `in_date` desc limit 1");
	$sql->execute(array($user_id,$ckeckTime));
	$existChecker = $sql->fetchAll(PDO::FETCH_ASSOC);
	$existCounter = count($existChecker);
	if ($existCounter == 1) {
		echo "Your submit frequence too high. try again after {$OJ_SUBMIT_DELTATIME} seconds.";
		exit(0);
	}
	
	// if in contest, what is the real problem id?
	if ($contest_id) {
		$problem_in_contest_id = $problem_id;
		$sql=$pdo->prepare("SELECT `problem_id` FROM `contest_problem` WHERE `contest_id`=? AND `num`=?");
		$sql->execute(array($contest_id,$problem_in_contest_id));
		$existChecker = $sql->fetch(PDO::FETCH_ASSOC);
		if (count($existChecker)!=1) {
			echo "403";
			exit(0);
		} else {
			$problem_id = $existChecker["problem_id"];
		}
	}

	// submit code info to db
	if ($contest_id) {
		$sql=$pdo->prepare("INSERT INTO solution
						(problem_id,user_id,in_date,language,ip,code_length,contest_id,num)
						VALUES(?,?,NOW(),?,?,?,?,?)");
		$sql->execute(array($problem_id,$user_id,$submit_lang,$submit_ip,$code_len,$contest_id,$problem_in_contest_id));
	} else {
		$sql=$pdo->prepare("INSERT INTO solution
						(problem_id,user_id,in_date,language,ip,code_length)
						VALUES(?,?,NOW(),?,?,?)");
		$sql->execute(array($problem_id,$user_id,$submit_lang,$submit_ip,$code_len));
	}
	$submit_id = $pdo->lastinsertid();
	
	// sumbit code to db
	$sql=$pdo->prepare("INSERT INTO `source_code`(`solution_id`,`source`)VALUES(?,?)");
	$sql->execute(array($submit_id,$submit_src));
	
	// redirect to 
	if ($contest_id) {
		//TODO: Currectly this to the right url location.
		$statusURI=strstr($_SERVER['REQUEST_URI'],"api",true)."status.php";
	} else {
		$toUrl = $statusURI=strstr($_SERVER['REQUEST_URI'],"api",true)."status.php";
	}
	
	//header("Location: {$statusURI}");
	echo $submit_id."(solution id) submit successful";
	exit(0);
	
	
?>
