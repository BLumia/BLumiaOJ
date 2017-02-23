<?php 
	session_start();
	//Vars
	require_once('./include/setting_oj.inc.php');
	
	//Prepares
	if (isset($_SESSION['user_id'])) {
		//User Logged in and wanna see him/herself's info.
		$user_id = $_SESSION['user_id'];
		
		$sql=$pdo->prepare("select * from users where user_id=?");
		$sql->execute(array($user_id));
		$res=$sql->fetch();
		//var_dump($res);
		$sql->closeCursor();
		
		$user_name = $res['nick'];
		$user_school = $res['school'];
		$user_email = $res['email'];
		
	} else {
		exit(0);
	}
	
	//Page Includes
	require("./pages/modifyinfo.php");
?>
