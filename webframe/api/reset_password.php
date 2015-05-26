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
    
	$user_id=trim($_POST['user_id']);
	$user_pwd=$_POST['new_password'];

	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ($user_id);
		$user_pwd= stripslashes ($user_pwd);
	}
	
	$password=pwGen($user_pwd);
	
	$sql=$pdo->prepare("update `users` set `password`=? where `user_id`=? and user_id not in( select user_id from privilege where rightstr='administrator') ");
	$sql->execute(array($password,$user_id));
	$affected_rows = $sql->rowCount();
	if ($affected_rows == 1){
		echo "Password Changed!";
		echo "<script language='javascript'>\n";
		echo "history.go(-1);\n";
		echo "</script>";
		exit(0);
	} else {
		echo "No such user! or He/She is an administrator!";
		exit(0);
	}
	
?>
