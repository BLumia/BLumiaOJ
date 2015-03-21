<?php 
require_once("admin-header.php");
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
	$from=mysql_real_escape_string($_POST['from']);
	$to=mysql_real_escape_string($_POST['to']);
	$start=intval($_POST['start']);
	$end=intval($_POST['end']);
	$sql="update `solution` set `user_id`='$to' where `user_id`='$from' and problem_id>=$start and problem_id<=$end and result=4";
	echo $sql;
	mysql_query($sql);
	echo mysql_affected_rows()." source file given!";
}
?>
<div class="container">
    <form name="form1" class="form-horizontal" role="form" action="source_give.php" method="post">
		<h2>Give Source:</h2>
		<div class="form-group">
			<label class="col-sm-3 control-label">From: </label>
			<div class="col-sm-9">
                <input class="form-control" type="text" ID="from" name="from" placeholder="617274873">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">To: </label>
            <div class="col-sm-9">
                <input class="form-control" type="text" ID="to" name="to" placeholder="BLumia">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Start PID:</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" ID="start" name="start">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">End PID:</label>
            <div class="col-sm-9">
                <input class="form-control" type="text" ID="end" name="end">
            </div>
        </div>
		
        <input type='hidden' name='do' value='do'>
		<?php require_once("../include/set_post_key.php");?>
		
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <button class="btn btn-default" type="submit" value='GiveMySourceToHim'>Give My Source to Him</button>
            </div>
        </div>
    </form>
</div>