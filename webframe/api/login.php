<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/login_functions.php");
	
	if(!isset($_SESSION['SessionAuth']) || !isset($_POST['pageauth'])) {
		echo "认证失败";
		exit(0);
	}
	if($_SESSION['SessionAuth'] != $_POST['pageauth']) {
		echo $_POST['pageauth']."Auth failed";
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
		echo "<script language='javascript'>\n";
		echo "alert('比赛期间非比赛帐号不允许登录!');\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
	}
	*/
	
	$sql=$pdo->prepare("SELECT `rightstr` FROM `privilege` WHERE `user_id`='?'");
	$sql->execute(array($user_id));
	$result=$sql->fetchAll();
	
	$login=check_login($user_id,$password,$pdo);
	
	if ($login) {
		$_SESSION['user_id']=$login;
		//权限部分未添加
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
