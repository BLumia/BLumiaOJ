<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Source Viewer</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	//Prepares
	if (!isset($_GET['id'])) {
		echo "Null Source ID.";
		exit(0);
	}
	//尚不准备关于代码权限访问相关的代码
	$code_id = intval($_GET['id']);
	$sql = $pdo->prepare("SELECT * FROM `solution` WHERE `solution_id`=?");
	$sql->execute(array($code_id));
	$codeContent=$sql->fetch();
	
	var_dump($codeContent);
	$code_Src = $codeContent;
	
	//Page Includes
	require("./pages/source_view.php");
?>
	
</html>