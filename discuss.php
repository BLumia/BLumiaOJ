<?php 
	session_start();
	//Vars
	require_once('./include/setting_oj.inc.php');
	//Prepares
	if (!$FORUM_ENABLED) exit(0);
	
	$pid = (isset($_GET["pid"])) ? intval($_GET["pid"]) : null;
	
	if (isset($_SESSION['user_id']) || isset($_GET['uid'])) {
		//User Logged in and wanna see him/herself's info.
		if (!isset($_GET['uid']))
			$user_id = $_SESSION['user_id']; 
		else
			$user_id = $_GET['uid'];
		
		$sql=$pdo->prepare("SELECT * FROM users WHERE user_id=?");
		$sql->execute(array($user_id));
		$res=$sql->fetch(PDO::FETCH_ASSOC);
		//var_dump($res);
		$sql->closeCursor();
		
		if($res == false) {
			exit("403");
		}
		
		$user_name = $res['nick'];
		$user_school = $res['school'];
		$user_email = $res['email'];
		
	}
	
	//Page Includes
	require("./pages/discuss.php");
?>
