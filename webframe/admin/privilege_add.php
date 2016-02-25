<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Add Problem</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("USER_MANAGER")) {
		echo "403";
		exit(403);
	}
	
	//Prepares
	$rightarray=array("administrator","http_judge","op_ProblemEditor","op_ContestEditor","op_UserManager","op_PageModifier" );
	//Page Includes
	require("./pages/privilege_add.php");
?>
	
</html>