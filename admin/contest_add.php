<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<link rel="stylesheet" type="text/css" href="../sitefiles/css/bootstrap-select.min.css">
		<script type="text/javascript" src="../sitefiles/js/bootstrap-select.min.js"></script>
		<title>Add Contest</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once('../include/common_const.inc.php');
	require_once('../include/common_functions.inc.php');
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("CONTEST_EDITOR")) {
		echo "403";
		exit(403);
	}
	
	//Prepares
	$cid = "0"; // 0 as add new contest.
	$lang_count=count($LANGUAGE_EXT);
	$langmask=$OJ_LANGMASK;
	
	$page_helper = "Add a contest is very simple.";
	$CONT_TITLE = "";
	$CONT_PROBLEMS = "";
	$CONT_S_TIME_Y = date('Y');
	$CONT_S_TIME_MO= date('m');
	$CONT_S_TIME_D = date('d');
	$CONT_S_TIME_H = date('H');
	$CONT_S_TIME_MI = "00";
	$CONT_E_TIME_Y = date('Y');
	$CONT_E_TIME_MO= date('m');
	$CONT_E_TIME_D = date('d')+(date('H')+4>23?1:0);
	$CONT_E_TIME_H = (date('H')+4)%24;
	$CONT_E_TIME_MI = "00";
	$CONT_USERLIST = "";
	$CONT_PASSWORD = "";
	$CONT_DESC = "";
	$CONT_PERMISSION = 0;
	//Page Includes
	require("./pages/contest_mod.php");
?>
	
</html>