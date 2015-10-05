<?php
	session_start();
/*
	$isSchoolContest=false;
	if($isSchoolContest)
	{   header("Content-type:text/html;charset=UTF-8");
		echo "<script language='javascript'>\n";
		echo "alert('比赛期间禁止修改信息!');\n";
			echo "history.go(-1);\n";
			echo "</script>";
			exit(0);
	}
*/
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
    
	$user_id=$_SESSION['user_id'];
	$user_name=$_POST['user_nick'];
	$password=$_POST['ori_pwd'];
	$new_password=$_POST['new_pwd'];
	$new_password_ii=$_POST['new_pwd_ii'];
	$user_school=$_POST['user_school'];
	$user_email=$_POST['user_email'];
	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}

	$sql=$pdo->prepare("SELECT `user_id`,`password` FROM `users` WHERE `user_id`=?");
	$sql->execute(array($user_id));
	$result=$sql->fetch(PDO::FETCH_ASSOC);
	if ($result && pwCheck($password,$result['password'])) $pwdCheck_ok = true;
	else $pwdCheck_ok = false;
	$sql->closeCursor();
	
	//TODO:检测提交的数据是否符合要求
	
	if ($pwdCheck_ok) {
		if ($new_password != NULL)
			$password=pwGen($new_password);
		else
			$password=pwGen($password);
		$sql=$pdo->prepare("UPDATE `users` 
			SET `password`=?, `nick`=?, `school`=?, `email`=? 
			WHERE `user_id`=?");
		$sql->execute(array($password,$user_name,$user_school,$user_email,$user_id));
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
