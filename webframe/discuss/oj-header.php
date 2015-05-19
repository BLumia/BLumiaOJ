<?php 
	require('./db_info.inc.php');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel=stylesheet href='./hojextend.css' type='text/css'>
	<?php echo "<title>".$OJ_NAME." WebBoard</title>";?>
	<link rel=stylesheet href='./css/cutter.css' type='text/css'>
	<link rel="stylesheet" href="./css/prettify.css" type="text/css">
	<script src="./js/prettify.js"></script>
<?php function checkcontest($MSG_CONTEST){
		require_once("./db_info.inc.php");
		$sql="SELECT count(*) FROM `contest` WHERE `end_time`>NOW() AND `defunct`='N'";
		$result=mysql_query($sql);
		$row=mysql_fetch_row($result);
		if (intval($row[0])==0) $retmsg=$MSG_CONTEST;
		else $retmsg=$row[0]."<font color=red>&nbsp;$MSG_CONTEST</font>";
		mysql_free_result($result);
		return $retmsg;
	}
	function checkmail(){
		require_once("./db_info.inc.php");
		$sql="SELECT count(1) FROM `mail` WHERE 
				new_mail=1 AND `to_user`='".$_SESSION['user_id']."'";
		$result=mysql_query($sql);
		if(!$result) return false;
		$row=mysql_fetch_row($result);
		$retmsg="<font color=red>(".$row[0].")</font>";
		mysql_free_result($result);
		return $retmsg;
	}
	
	if(isset($OJ_LANG)){
		require_once("./lang/$OJ_LANG.php");
	}else{
		require_once("./lang/en.php");
	}
	

	if($OJ_ONLINE){
		require_once('./online.php');
		$on = new online();
	}
?>
</head>
<body>
<div class="wrapper">
<div id=head>
<h3 class="phead"><?php echo $OJ_NAME?><small>讨论版</small></h3>
</div><!--end head-->
<div id=subhead> 
<div id=menu class=navbar>
	<a href="./discuss.php"><?php echo $MSG_BBS?></a>
	<a href="../"><?php echo $MSG_HOME?></a>&nbsp;|&nbsp;
<?php 
	if (isset($_SESSION['user_id'])){
		$sid=$_SESSION['user_id'];
		print "<a href='../userinfo.php?user=$sid'>$sid</a>";
		$mail=checkmail();
		if ($mail)
			print "<a href=../mail.php>$MSG_MAIL$mail</a>";
		print "<a href=../api/logout.php>$MSG_LOGOUT</a>";
	}else{
		print "<a href=../loginpage.php>$MSG_LOGIN</a>";
		print "<a href=../registerpage.php>$MSG_REGISTER</a>";
	}
	if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])){
		print "<a href=../admin>$MSG_ADMIN</a>";
	}
?>
	</div><!--end menu-->
</div><!--end subhead-->
<div id=broadcast>
<?php echo "<marquee id=broadcast scrollamount=1 direction=up scrolldelay=250>";
	echo "<font color=red>";
	echo file_get_contents($OJ_SAE?"saestor://web/msg.txt":"./msg.txt");
	echo "</font>";
	echo "</marquee>";


?>
</div><!--end broadcast-->
 
<div id=main>
