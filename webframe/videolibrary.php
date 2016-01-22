<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>BLumiaOJ</title>
		<style>
.panel {
	margin-bottom: 0px;
}
		</style>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	$VideoManager = (isset($_SESSION['administrator'])||isset( $_SESSION['op_PageModifier'] )) ? true:false;
	//Prepares
	if(!isset($_GET['man'])) {
		$sql=$pdo->prepare("select * from videores");
		$sql->execute();
		$totalVideos=$sql->fetchAll(PDO::FETCH_ASSOC);
		$totalCount=count($totalVideos);
	}
	//Page Includes
	if(isset($_GET['man']) && $VideoManager)
		require("./pages/videolibrary_man.php");
	else
		require("./pages/videolibrary.php");
?>
	
</html>