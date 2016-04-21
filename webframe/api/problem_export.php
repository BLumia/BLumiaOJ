<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("SUPERUSER")) {
		echo "403";
		exit(403);
	}
	
	//Functions
	function getTestFileIn($pid, $testfile, $OJ_DATA) {
		if ($testfile != "")
			return file_get_contents("$OJ_DATA/$pid/" . $testfile . ".in");
		else
			return "";
	}
	
	function getTestFileOut($pid, $testfile, $OJ_DATA) {
		if ($testfile != "")
			return file_get_contents();
		else
			return "";
	}
	
	//Header
	$pageType = isset($_REQUEST['dl_type']) ? $_REQUEST['dl_type'] : "TEXT";
	switch($pageType) {
		case "TEXT": header('Content-Type: text/plain; charset=utf-8'); break;
		case "XML":
		case "FPS": header('Content-Type: text/xml'); break;
		case "JSON": header('Content-Type: application/json'); break;
		default: header('Content-Type: text/plain; charset=utf-8'); break;
	}
	if(isset($_REQUEST['dl'])) {
		header("content-disposition: attachment; filename=\"{$saveFileName}\"");
	}
	
	//Get Problems
	if(isset($_GET['cid'])) {
		$cid = intval($_GET['cid']);
		$sql=$pdo->prepare("SELECT * FROM problem WHERE problem_id IN(SELECT problem_id FROM contest_problem WHERE contest_id=?)");
		$sql->execute(array($cid));
		$problemList = $sql->fetchAll(PDO::FETCH_ASSOC);
	} else if (isset($_POST['start']) && isset($_POST['end'])) {
		$sql=$pdo->prepare("SELECT * FROM problem WHERE problem_id>=? AND problem_id<=?");
		$sql->execute(array(intval($_POST['start']),intval($_POST['end'])));
		$problemList = $sql->fetchAll(PDO::FETCH_ASSOC);
	}
	
	var_dump($problemList);
	
?>