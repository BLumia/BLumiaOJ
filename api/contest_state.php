<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_functions.inc.php");
	require_once("../include/file_functions.php");
	require_once("../include/user_check_functions.php");
	
	$contest_do	= @defined_int_or_die($_GET['do']);
	$contest_id	= @defined_int_or_die($_GET['cid']);
	
	// m{cid}: contest modifier, c{cid}: contest user.
	if (!(isset($_SESSION["m{$contest_id}"])||havePrivilege("CONTEST_EDITOR"))) {
		fire(403, "No permission to access this api.");
	}
	
	/* do check work*/
	$sql=$pdo->prepare("SELECT * FROM `contest` WHERE `contest_id`=?");
	$sql->execute(array($contest_id));
	$affected_rows = $sql->rowCount();
	$it_exist = ($affected_rows == 1) ? true : false;
	
	if($it_exist) {
		switch($contest_do) {
			case 1:
				$is_private = 0;
				$contest_defunct = "N";
				break;
			case 2:
				$is_private = 1;
				$contest_defunct = "N";
				break;
			case 3:
				$is_private = 0;
				$contest_defunct = "Y";
				break;
			default:
				$is_private = 0;
				$contest_defunct = "N";
				break;
		}
		
		$sql=$pdo->prepare("UPDATE `contest` SET `private`=?,`defunct`=? WHERE `contest_id`=?");
		$sql->execute(array($is_private,$contest_defunct,$contest_id));
		fire(200, "Contest State Modified Successful");
		
	} else {
		fire(404, "Contest NOT Exist!");
	}
?>
