<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/jqBootstrapValidation.js"></script>
		<title>BLumiaOJ</title>
	</head>	
	
<?php
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
		//TODO： 访问指定用户的用户页面，$_GET['user'];传入user_id
		exit(0);
	}
	
	//Page Includes
	require("./pages/modifyinfo.php");
?>
	
</html>