<?php require("admin-header.php");

if (!(isset($_SESSION['administrator']))){
	echo "<a href='../loginpage.php'>Please Login First!</a>";
	exit(1);
}?>
<head>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<!-- 可选的Bootstrap主题文件（一般不用引入） -->
	<link rel="stylesheet" href="./css/bootstrap-theme.min.css">
</head>
<?php if(isset($_POST['do'])){
	require_once("../include/check_post_key.php");
	if (isset($_POST['rjpid'])){
		$rjpid=intval($_POST['rjpid']);
		$sql="UPDATE `solution` SET `result`=1 WHERE `problem_id`=".$rjpid;
		mysql_query($sql) or die(mysql_error());
		$sql="delete from `sim` WHERE `s_id` in (select solution_id from solution where `problem_id`=".$rjpid.")";
		mysql_query($sql) or die(mysql_error());
		$url="../status.php?problem_id=".$rjpid;
		echo "Rejudged Problem ".$rjpid;
		echo "<script>location.href='$url';</script>";
	}
	else if (isset($_POST['rjsid'])){
		$rjsid=intval($_POST['rjsid']);
		$sql="UPDATE `solution` SET `result`=1 WHERE `solution_id`=".$rjsid;
		mysql_query($sql) or die(mysql_error());
		$sql="delete from `sim` WHERE `s_id`=".$rjsid;
		mysql_query($sql) or die(mysql_error());
		$url="../status.php?top=".($rjsid+1);
		echo "Rejudged Runid ".$rjsid;
		echo "<script>location.href='$url';</script>";
	}
}
?>
<div class="container">
<h2>Rejudge</h2>
	<ol>
	<li>Problem
	<form action='rejudge.php' method=post>
		<input type=input name='rjpid'>	<input type='hidden' name='do' value='do'>
		<input type=submit value=submit>
		<?php require_once("../include/set_post_key.php");?>
	</form>
	<li>Solution
	<form action='rejudge.php' method=post>
		<input type=input name='rjsid'>	<input type='hidden' name='do' value='do'>
		<input type=hidden name="postkey" value="<?php echo $_SESSION['postkey']?>">
		<input type=submit value=submit>
	</form>
</div>