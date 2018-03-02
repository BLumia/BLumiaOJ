<?php 
	session_start(); $ON_ADMIN_PAGE="Yap"; 
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("PROBLEM_EDITOR")) {
		exit("403");
	}
	
	//Prepares
	$PROB_ID = 0;
	$page_helper = "Add a problem is very simple.";
	$PROB_TITLE = "";
	$PROB_TIME = "";
	$PROB_MEMORY = "";
	$PROB_DESC = "Problem Description Placed at here, we recommended that please do <b>not</b> use PRE label since it was did by OJ's problem display system.";
	$PROB_INPUT = "Input Description Placed at here, we recommended that please do <b>not</b> use PRE label since it was did by OJ's problem display system.";
	$PROB_OUTPUT = "Output Description Placed at here, we recommended that please do <b>not</b> use PRE label since it was did by OJ's problem display system.";
	$PROB_SAMP_IN = "";
	$PROB_SAMP_OUT = "";
	$PROB_HINT = "";
	$PROB_SPJ = 0;
	//Page Includes
	require("./pages/problem_mod.php");
?>
	
</html>