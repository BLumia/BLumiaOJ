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
    
	$user_id=trim($_POST['username']);
	$user_nick=$_POST['nickname'];
	$user_pwd=$_POST['password'];
	$user_pwdII=$_POST['password_again'];
	$user_school=$_POST['school'];
	$user_email=$_POST['email'];
	$user_ip=$_SERVER['REMOTE_ADDR'];
	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ($user_id);
		$user_nick= stripslashes ($user_nick);
		$user_pwd= stripslashes ($user_pwd);
	}
	
	$password=pwGen($user_pwd);
	
	$sql=$pdo->prepare("SELECT `user_id` FROM `users` WHERE `users`.`user_id` =?");
	$sql->execute(array($user_id));
	$result=$sql->fetchAll();
	$user_cnt = count($result); 
	if ($user_cnt >= 1){
		echo "User Exist!";
		var_dump($result);
		exit(0);
	}
	$sql=$pdo->prepare("INSERT INTO `users` 
	(`user_id`,`email`,`ip`,`accesstime`,`password`,`reg_time`,`nick`,`school`)
	VALUES(?,?,?,NOW(),?,NOW(),?,?)");
	$sql->execute(array($user_id,$user_email,$user_ip,$password,$user_nick,$user_school));
	
	$login=check_login($user_id,$user_pwd,$pdo);
	
	if ($login) {
		$_SESSION['user_id']=$login;
		//权限部分未添加
		$_SESSION['administrator']=true;
		//权限部分未添加
		echo "success";
		echo "<script language='javascript'>\n";
		echo "window.location.replace('../userinfo.php?guide=1');\n";
		echo "</script>";
	} else {
		echo "failed";
		//echo "<script language='javascript'>\n";
		//echo "alert('UserName or Password Wrong!');\n";
		//echo "history.go(-1);\n";
		//echo "</script>";
	}
	
?>
