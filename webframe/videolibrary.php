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
	if(isset($_POST['videoName'])) {
		require_once('./include/checkauth_post.php');
		
		$POST_Author_ID = $_POST['videoAuthor'];
		$POST_Video_Name = $_POST['videoName'];
		$POST_Video_URL = $_POST['videoURL'];
		$POST_Video_Desc = $_POST['videoDesc'];
		$POST_Problem_ID = intval($_POST['probID']);
		
		$sql=$pdo->prepare("INSERT INTO `videores` 
			(`author_id`,`title`,`url`,`time`,`videodesc`,`pid`)
			VALUES(?,?,?,NOW(),?)");
		$sql->execute(array($POST_Author_ID,$POST_Video_Name,$POST_Video_URL,$POST_Video_Desc,$POST_Problem_ID));
		$vid = $pdo->lastinsertid();
		
		if($vid==0) echo "Insert Failed";
	}
	
	if(!isset($_GET['man'])) {
		$sql=$pdo->prepare("select * from videores");
		$sql->execute();
		$totalVideos=$sql->fetchAll(PDO::FETCH_ASSOC);
		$totalCount=count($totalVideos);
		//var_dump($totalVideos);
	}
	//Page Includes
	if(isset($_GET['man']) && $VideoManager)
		require("./pages/videolibrary_man.php");
	else
		require("./pages/videolibrary.php");
?>
	
</html>