<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/login_functions.php");
	require_once("../include/user_check_functions.php");
	
	if(!isset($_SESSION['SessionAuth']) || !isset($_POST['pageauth'])) {
		exit("Auth Failed");
	}
	if($_SESSION['SessionAuth'] != $_POST['pageauth']) {
		echo $_POST['pageauth']."Auth failed";
		exit(0);
	}
	
	// No idea about password_setter in hustoj, check it here.
	// Make a standalone privilege to manage password? weird.
	if (!havePrivilege("SUPERUSER") && !isset($_SESSION["password_setter"])) {
		exit("403");
	}
    
	$user_id=trim($_POST['user_id']);
	$user_pwd=$_POST['new_password'];

	if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ($user_id);
		$user_pwd= stripslashes ($user_pwd);
	}
	
	$password=pwGen($user_pwd);
	
	$sql=$pdo->prepare("UPDATE `users` SET `password`=? WHERE `user_id`=? AND user_id NOT in( SELECT user_id FROM privilege WHERE rightstr='administrator') ");
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
