<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Edit Problem</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	
	//Prepares
	if (!isset($_GET['nid'])) {
		echo "no nid founded";
		exit(0);
	}
	
	$PROB_ID = intval($_GET['nid']);
	
	$sql=$pdo->prepare("select * from problem where problem_id = ?");
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
	$PROB_TEST_IN = "WORKING IN PROGRESS";
	$PROB_TEST_OUT = "WORKING IN PROGRESS";
	//Page Includes
	require("./pages/problem_mod.php");
?>
	
</html>