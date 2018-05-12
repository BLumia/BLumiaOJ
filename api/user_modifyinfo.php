<?php
	session_start();

	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_functions.inc.php");
	require_once("../include/login_functions.php");
	
	if(!isset($_SESSION['SessionAuth']) || !isset($_POST['pageauth'])) {
		fire(403, "Direct access is forbidden");
	}
	
	if($_SESSION['SessionAuth'] != $_POST['pageauth']) {
		fire(401, "Session not valid");
	}
	
	if($OJ_LARGE_CONTEST_MODE == true) {
		fire(403, "Not able to modify information while large contest mode is enabled.");
	}
    
	$user_id=$_SESSION['user_id'];
	$user_name=$_POST['user_nick'];
	$password=$_POST['ori_pwd'];
	$new_password=$_POST['new_pwd'];
	$new_password_ii=$_POST['new_pwd_ii'];
	$user_school=$_POST['user_school'];
	$user_email=$_POST['user_email'];
	
	if (get_magic_quotes_gpc()) {
		$user_id = stripslashes($user_id);
		$password = stripslashes($password);
	}

	$sql=$pdo->prepare("SELECT `user_id`,`password` FROM `users` WHERE `user_id`=?");
	$sql->execute(array($user_id));
	$result=$sql->fetch(PDO::FETCH_ASSOC);
	if ($result && pwCheck($password,$result['password'])) $pwdCheck_ok = true;
	else $pwdCheck_ok = false;
	$sql->closeCursor();
	
	if ($pwdCheck_ok) {
		if ($new_password != NULL) {
			if ($new_password != $new_password_ii) {
				fire(401, "New password not match.");
			}
			$password = pwGen($new_password);
		} else {
			$password = pwGen($password);
		}
			
		$sql=$pdo->prepare("UPDATE `users` 
			SET `password`=?, `nick`=?, `school`=?, `email`=? 
			WHERE `user_id`=?");
		$sql->execute(array($password,$user_name,$user_school,$user_email,$user_id));
		
		$_SESSION['user_name'] = $user_name;
		
		fire(200, L_USERINFO_UPDATED);
	} else {
		fire(401, L_INCORRECT_PSW);
	}

?>
