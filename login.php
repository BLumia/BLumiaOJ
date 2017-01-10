<?php
	/*  
		This is a HUST OJ adapter.
		HUST OJ's Judged (Judge Daemon) use this as an api to auth and login http_judge account.
		
		Normal user (admin/operater incl.) CAN NOT login via this api.
		
		POST:
			'user_id', 'password'
		RETURN:
			Not important. Judge daemon only use this to get session to pass session check in problem_judge.php.
			Login success: got right session, http_judge session incl. (Also return a "1" on page, but the judged don't care)
			Login fail(Not a judger account): can't get anything, oh, i can give a "0" for you (= =||)
			Login fail(Username or password not correct): get a "403" on this page.
	*/
	session_start();
	require_once("./include/setting_oj.inc.php");
	require_once("./include/login_functions.php");
	require_once("./include/user_check_functions.php");
	
	$user_id=$_POST['user_id'];
	$password=$_POST['password'];
	if (get_magic_quotes_gpc ()) {
		$user_id = stripslashes ($user_id);
		$password = stripslashes ($password);
	}
	
	$login=check_login($user_id,$password,$pdo);
	
	if ($login) {
		$_SESSION['user_id']=$login;
		
		$sql=$pdo->prepare("SELECT * FROM `users` WHERE `user_id`=?");
		$sql->execute(array($login));
		$res=$sql->fetch(PDO::FETCH_ASSOC);
		
		$_SESSION['user_name'] = $res['nick'];
		
		$sql=$pdo->prepare("SELECT `rightstr` FROM `privilege` WHERE `user_id`=?");
		$sql->execute(array($user_id));
		$op_result=$sql->fetchAll(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		
		foreach ($op_result as $row) {
			$rightStr = ($OJ_HUSTOJ_COMPATIBLE) ? opTagConverter($row['rightstr']) : $row['rightstr'];
			$_SESSION[$rightStr]=true;
		}
		$_SESSION['is_operator'] = isOperator();
		
		if (isset($_SESSION['http_judge'])) {
			exit("1");
		} else {
			unset($_SESSION['user_id']);
			unset($_SESSION['is_operator']);
			session_destroy();
			exit("0");
		}
		

	} else {
		exit("403");
	}
	
?>
