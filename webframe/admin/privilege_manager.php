<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<link rel="stylesheet" type="text/css" href="../sitefiles/css/bootstrap-select.min.css">
		<script type="text/javascript" src="../sitefiles/js/bootstrap-select.min.js"></script>
		<title>Private Manager</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once('../include/common_const.inc.php');
	require_once('../include/login_functions.php');
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("USER_MANAGER")) {
		echo "403";
		exit(403);
	}
	
	//Prepares
	if (!isset($_GET['more'])) {
		$sql=$pdo->prepare("select * FROM privilege where rightstr in ('administrator','http_judge','op_ProblemEditor','op_ContestEditor','op_UserManager','op_PageModifier')");
	} else {
		$sql=$pdo->prepare("select * FROM privilege where rightstr in ('administrator','source_browser','contest_creator','http_judge','problem_editor')");
	}
	
	$sql->execute();
	$opList=$sql->fetchAll(PDO::FETCH_ASSOC);
	
	//Page Includes
	require("./pages/privilege_man.php");
?>
	
</html>