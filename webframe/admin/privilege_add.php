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
	//Prepares
	$rightarray=array("administrator","http_judge","op_ProblemEditor","op_ContestEditor","op_UserManager","op_PageModifier" );
	//Page Includes
	require("./pages/privilege_add.php");
?>
	
</html>