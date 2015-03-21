<?php 
	require_once("admin-header.php");
	if (!(isset($_SESSION['administrator'])|| isset($_SESSION['password_setter']) )) {
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
?>
<head>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<!-- 可选的Bootstrap主题文件（一般不用引入） -->
	<link rel="stylesheet" href="./css/bootstrap-theme.min.css">
</head>
<?php
if(isset($_POST['do'])){
	//echo $_POST['user_id'];
	require_once("../include/check_post_key.php");
	//echo $_POST['passwd'];
	require_once("../include/my_func.inc.php");
	
	$user_id=$_POST['user_id'];
    $passwd =$_POST['passwd'];
    if (get_magic_quotes_gpc ()) {
		$user_id = stripslashes ( $user_id);
		$passwd = stripslashes ( $passwd);
	}
	$user_id=mysql_real_escape_string($user_id);
	$passwd=pwGen($passwd);
	$sql="update `users` set `password`='$passwd' where `user_id`='$user_id'  and user_id not in( select user_id from privilege where rightstr='administrator') ";
	mysql_query($sql);
	if (mysql_affected_rows()==1) echo "Password Changed!";
  else echo "No such user! or He/Her is an administrator!";
}
?>

<div class="container">
    <form name="form1" class="form-horizontal" role="form" action="changepass.php" method="post">
		<h2>Change Password:</h2>
		<div class="form-group">
			<label class="col-sm-3 control-label">User: </label>
			<div class="col-sm-9">
                <input class="form-control" type="text" ID="user_id" name="user_id" placeholder="User Name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Pass: </label>
            <div class="col-sm-9">
                <input class="form-control" type="text" ID="passwd" name="passwd" placeholder="Password">
            </div>
        </div>
		
        <input type='hidden' name='do' value='do'>
		<?php require_once("../include/set_post_key.php");?>
		
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <button class="btn btn-default" type="submit" value='Change'>Change Password</button>
            </div>
        </div>
    </form>
</div>