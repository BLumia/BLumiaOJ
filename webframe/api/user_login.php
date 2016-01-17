<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/login_functions.php");
	require_once("../include/user_check_functions.php");
	
	if(!isset($_SESSION['SessionAuth']) || !isset($_POST['pageauth'])) {
		echo "Auth failed";
		exit(0);
	}
	if($_SESSION['SessionAuth'] != $_POST['pageauth']) {
		echo "Auth failed";
		exit(0);
	}
    
	$user_id=$_POST['username'];
	$password=$_POST['password'];
	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}
	
	/* 额。。。。留着吧
	if($user_id!="admin" &&$user_id!="skay" && substr($user_id,0,2)!="BK") {
		header("Content-type:text/html;charset=UTF-8");
		echo "<script language='javascript'>\n";
		echo "alert('比赛期间非比赛帐号不允许登录!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
	}
	*/
	
	$login=check_login($user_id,$password,$pdo);
	
	if ($login) {
		$_SESSION['user_id']=$login;
		
		$sql=$pdo->prepare("select * from users where user_id=?");
		$sql->execute(array($login));
		$res=$sql->fetch(PDO::FETCH_ASSOC);
		//var_dump($res);
		
		$_SESSION['user_name'] = $res['nick'];
		
		//权限部分
		$sql=$pdo->prepare("SELECT `rightstr` FROM `privilege` WHERE `user_id`=?");
		$sql->execute(array($user_id));
		$op_result=$sql->fetchAll(PDO::FETCH_ASSOC);
		$sql->closeCursor();
		//var_dump($op_result);
		foreach ($op_result as $row) {
			//echo "{$row['rightstr']}";
			$_SESSION[$row['rightstr']]=true;
		}
		$_SESSION['is_operator'] = isOperator();
		
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
