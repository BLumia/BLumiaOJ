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
	if (!isset($_GET['nid'])) {
		exit("no nid founded");
	}
	
	$PROB_ID = intval($_GET['nid']);
	
	$sql=$pdo->prepare("SELECT * FROM problem WHERE problem_id = ?");
	$sql->execute(array($PROB_ID));
	$problemItem=$sql->fetch(PDO::FETCH_ASSOC);
	//var_dump($problemItem);
	
	
	$page_helper = "Now you are editing problem {$PROB_ID}";
	$PROB_TITLE = $problemItem['title'];
	$PROB_TIME = $problemItem['time_limit'];
	$PROB_MEMORY = $problemItem['memory_limit'];
	$PROB_DESC = $problemItem['description'];
	$PROB_INPUT = $problemItem['input'];
	$PROB_OUTPUT = $problemItem['output'];
	$PROB_SAMP_IN = $problemItem['sample_input'];
	$PROB_SAMP_OUT = $problemItem['sample_output'];
	$PROB_HINT = $problemItem['hint'];
	$PROB_SPJ = intval($problemItem['spj']);
	//Page Includes
	require("./pages/problem_mod.php");
?>
	
</html>