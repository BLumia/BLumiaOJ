<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<link rel="stylesheet" type="text/css" href="../sitefiles/css/bootstrap-select.min.css">
		<script type="text/javascript" src="../sitefiles/js/bootstrap-select.min.js"></script>
		<title>Add Problem</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once('../include/common_const.inc.php');
	require_once('../include/login_functions.php');
	//Prepares
	if(isset($_POST['prefix'])) {
		$prefix=$_POST['prefix'];
		if (!preg_match("#^[a-zA-Z]{1}[a-zA-Z0-9_]{3,15}$#",$prefix)) {//字母开头，允许4-16字节，允许字母数字下划线
			echo "Prefix is not valid.";
			exit(0);
		} else {
			$teamnumber=intval($_POST['teamnumber']);
			$pieces = explode("\n", trim($_POST['ulist']));
			//注意：pjax正确时可能出现问题
			if ($teamnumber>0){
				echo "<div class='page-header'><h1>Generated Result <small>Copy these accounts to distribute</small></h1></div>";
				echo "<table class='table'>";
				echo "<tr><th>Account/Team Name</th><th>User ID</th><th>Password</th></tr>";
				for($i=1;$i<=$teamnumber;$i++) {
					$user_id=$prefix.($i<10?('0'.$i):$i);
					$password=strtoupper(substr(MD5($user_id.rand(0,9999999)),0,6));
					if(isset($pieces[$i-1]))
						$nick=$pieces[$i-1] === "" ? "your_own_nick" : $pieces[$i-1];
					else
						$nick="your_own_nick";
					echo "<tr><td>$nick<td>$user_id</td><td>$password</td></tr>";
					
					$password=pwGen($password);
					$email="your_own_email@internet";
							
					$school="your_own_school";
					$sql=$pdo->prepare("INSERT INTO `users`("."`user_id`,`email`,`ip`,`accesstime`,`password`,`reg_time`,`nick`,`school`)"."VALUES(?,?,?,NOW(),?,NOW(),?,?)on DUPLICATE KEY UPDATE `email`=?,`ip`=?,`accesstime`=NOW(),`password`=?,`reg_time`=now(),nick=?,`school`=?");
					$sql->execute(array($user_id,$email,$_SERVER['REMOTE_ADDR'],$password,$nick,$school,$email,$_SERVER['REMOTE_ADDR'],$password,$nick,$school));
				}
				echo  "</table>";	
			}
		}
	}
	//Page Includes
	require("./pages/account_gen.php");
?>
	
</html>