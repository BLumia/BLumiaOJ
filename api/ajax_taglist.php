<?php
	/*  
		API for tag listing page.
		All request send via POST method:
		
		Fetch tag list of a level:
			`do` = 'list' (can leave blank, default value is 'list')
			`level` required, a number, tag level. default is '1'
			
		Fetch tag list have the same parent by given parent id:
			`do` = 'sublist' (can leave blank, default value is 'list')
			`parent` required, a number, parent's tag_id
			
	*/
	session_start();
	
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_functions.inc.php");
	require_once('../include/safe_func.inc.php');
	//require_once('../include/user_check_functions.php');
	
	//Prepare
	if ($PROBLEM_TAG_ENABLED == false) fire(503, "Problem tag system not enabled.");
	$action = isset($_REQUEST['do']) ? $_REQUEST['do'] : "list";
	
	switch($action) {
		case 'list':
			$tagLevel = (isset($_REQUEST['level']) && $_REQUEST['level']!='') ? intval($_REQUEST['level']) : 1;
			$sql=$pdo->prepare("SELECT * FROM `problem_tag` WHERE `tag_level`=?");
			$sql->execute(array($tagLevel));
			$result=$sql->fetchAll(PDO::FETCH_ASSOC);
			fire(200, "OK", $result);
			break;
			
		case 'sublist':
			$parentLevel = (isset($_REQUEST['parent']) && $_REQUEST['parent']!='') ? intval($_REQUEST['parent']) : null;
			if (is_null($parentLevel)) fire(400, "Missing 'parent' parameter.");
			$sql=$pdo->prepare("SELECT * FROM `problem_tag` WHERE `tag_parent_id`=?");
			$sql->execute(array($parentLevel));
			$result=$sql->fetchAll(PDO::FETCH_ASSOC);
			fire(200, "OK", $result);
			break;

		default:
			fire(400, "Wrong 'do' parameter.");
	}
	

?>