<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once("oj-header.php"); require_once("setting_db.inc.php"); ?>
		<title>BLumiaOJ</title>
		<style>
.four {
	margin-bottom: 20px;
}
.bc-social {
	padding:15px 0;
	text-align:center;
	background-color:#f5f5f5;
	border-top:1px solid #fff;
	border-bottom:1px solid #ddd
}
.bc-social-buttons {
	margin-left:0;
	margin-bottom:0;
	padding-left:0;
	list-style:none
}
.bc-social-buttons li {
	display:inline-block;
	line-height:1;
	color:#555
}
.bc-social-buttons li .fa {
	font-size:18px;
	margin-right:3px
}
.bc-social-buttons li .fa-weibo {
	font-size:20px
}
.bc-social-buttons li a {
	color:#555
}
.bc-social-buttons li.social-qq:hover {
	color:#428bca
}
.bc-social-buttons li.social-weibo a:hover {
	color:#d9534f
}
.bc-social-buttons>li+li:before {
	padding:0 10px;
	color:#ccc;
	content:"|"
}
		</style>
	</head>	
	
<?php
	//Vars
	$VideoManager = (isset($_SESSION['administrator'])||isset( $_SESSION['op_PageModifier'] )) ? true:false;
	//Prepares
	if(isset($_POST['videoName'])) {
		if (!isset($_SESSION['SessionAuth'])||!isset($_POST['pageauth'])||$_SESSION['SessionAuth']!=$_POST['pageauth'])
			exit(403);
		
		$POST_Author_ID = $_POST['videoAuthor'];
		$POST_Video_Name = $_POST['videoName'];
		$POST_Video_URL = $_POST['videoURL'];
		$POST_Video_Desc = $_POST['videoDesc'];
		$POST_Problem_ID = intval($_POST['probID']);
		
		$sql=$pdo->prepare("INSERT INTO `videores` 
			(`author_id`,`title`,`url`,`time`,`videodesc`,`pid`)
			VALUES(?,?,?,NOW(),?,?)");
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