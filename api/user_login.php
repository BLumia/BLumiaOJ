<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/login_functions.php");
	require_once("../include/user_check_functions.php");
	
	if(!isset($_SESSION['SessionAuth']) || !isset($_POST['pageauth'])) {
		exit("Auth failed");
	}
	if($_SESSION['SessionAuth'] != $_POST['pageauth']) {
		exit("Auth failed");
	}
    
	$user_id=$_POST['username'];
	$password=$_POST['password'];
	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}
	
	$login=check_login($user_id,$password,$pdo);
	
	if ($login) {
		$_SESSION['user_id']=$login;
		
		$sql=$pdo->prepare("SELECT * FROM `users` WHERE `user_id`=?");
		$sql->execute(array($login));
		$res=$sql->fetch(PDO::FETCH_ASSOC);
		//var_dump($res);
		
		$_SESSION['user_name'] = $res['nick'];
		
		//权限部分
		$sql=$pdo->prepare("SELECT `rightstr` FROM `privilege` WHERE `user_id`=?");
		$sql->execute(array($user_id));
		$op_result=$sql->fetchAll(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		
		foreach ($op_result as $row) {
			$rightStr = ($OJ_HUSTOJ_COMPATIBLE) ? opTagConverter($row['rightstr']) : $row['rightstr'];
			$_SESSION[$rightStr]=true;
		}
		$_SESSION['is_operator'] = isOperator();
		
		if ($OJ_LARGE_CONTEST_MODE == true && $OJ_LOGIN_FILTER != false) {
			if ($_SESSION['is_operator'] != true && strpos($user_id, $OJ_LOGIN_FILTER) !== 0) {
				unset($_SESSION['user_id']);
				unset($_SESSION['is_operator']);
				session_destroy();
				exit("Large contest mode enabled, only appointed user can login.");
			}
		}
		
		echo "success";
		echo "<script language='javascript'>\n";
		echo "history.go(-2);\n";
		echo "</script>";
	} else {
		echo "failed";
		//echo "<script language='javascript'>\n";
		//echo "alert('UserName or Password Wrong!');\n";
		//echo "history.go(-1);\n";
		//echo "</script>";
	}
	
?>
