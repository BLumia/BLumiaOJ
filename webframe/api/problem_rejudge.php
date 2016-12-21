<?php
	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once('../include/setting_oj.inc.php');
	require_once("../include/user_check_functions.php");
	
	if (!havePrivilege("ANUBIS")) { 
		exit("403");
	}
	
	if (isset($_POST['rjsid'])) {
		// Rejudge one solution
		$rjsid = intval($_POST['rjsid']);
		if ($rjsid == 0) exit("Error: Solution ID not valid.");
		
		$sql=$pdo->prepare("UPDATE `solution` SET `result`=1 WHERE `solution_id`=?");
		$sql->execute(array($rjsid));
		
		$sql=$pdo->prepare("DELETE FROM `sim` WHERE `s_id`=?");
		$sql->execute(array($rjsid));

		echo "Rejudged RunID {$rjsid}.";
		// TODO: redirect to status page.
	}
	
	if (isset($_POST['rjpid'])) {
		// Rejudge one problem
		$rjpid = intval($_POST['rjpid']);
		if ($rjpid == 0) exit("Error: Problem ID not valid.");
		
		$sql=$pdo->prepare("UPDATE `solution` SET `result`=1 WHERE `problem_id`=?");
		$sql->execute(array($rjpid));
		
		$sql=$pdo->prepare("DELETE FROM `sim` WHERE `s_id` in (SELECT solution_id FROM solution WHERE `problem_id`=?)");
		$sql->execute(array($rjpid));

		echo "Rejudged Problem {$rjpid}.";
		// TODO: redirect to status page.
	}
?>
