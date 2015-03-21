<?php 
	require_once("admin-header.php");
	
	if(isset($OJ_LANG)) {
		require_once("../lang/$OJ_LANG.php");
	}
?>
<html>
<head>
	<title><?php echo $MSG_ADMIN?></title>
	<!-- 新 Bootstrap 核心 CSS 文件 -->
	<link rel="stylesheet" href="./css/bootstrap.min.css">
	<!-- 可选的Bootstrap主题文件（一般不用引入） -->
	<link rel="stylesheet" href="./css/bootstrap-theme.min.css">
</head>

<body>

<ul class="list-group">

	<a href="./watch.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_SEEOJ;?></li>
	</a>
	
	<?php if (isset($_SESSION['administrator'])||isset($_SESSION['problem_editor']))
	{ // 管理员，问题编辑可见?>
	<a href="./problem_add_page.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_ADD.$MSG_PROBLEM;?></li>
	</a>

	<?php } if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator'])||isset($_SESSION['problem_editor'])) { // 管理员,竞赛管理员,问题编辑可见部分 ?>
	<a href="./problem_list.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_PROBLEM.$MSG_LIST;?></li>
	</a>

	<?php } if (isset($_SESSION['administrator'])||isset($_SESSION['contest_creator']))
	{ // 管理员，竞赛管理员可见部分 ?>
	<a href="./contest_add.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_ADD.$MSG_CONTEST;?></li>
	</a>
	<a href="./contest_list.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_CONTEST.$MSG_LIST;?></li>
	</a>

	<?php } if (isset($_SESSION['administrator'])||isset( $_SESSION['password_setter'])) 
	{ // 管理员，密码重置人员可见部分 ?>
	<a href="./changepass.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_SETPASSWORD;?></li>
	</a>
	
	<?php } if (isset($_SESSION['administrator'])) { //管理员部分 ?>
	<a href="./news_add_page.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_ADD.$MSG_NEWS;?></li>
	</a>
	<a href="./news_list.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_NEWS.$MSG_LIST;?></li>
	</a>
	<a href="./team_generate.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_TEAMGENERATOR;?></li>
	</a>
	<a href="./setmsg.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_SETMESSAGE;?></li>
	</a>
	<a href="./rejudge.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_REJUDGE;?></li>
	</a>
	<a href="./privilege_add.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_ADD.$MSG_PRIVILEGE;?></li>
	</a>
	<a href="./privilege_list.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_PRIVILEGE.$MSG_LIST;?></li>
	</a>
	<a href="./source_give.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_GIVESOURCE;?></li>
	</a>
	<a href="./problem_export.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_EXPORT.$MSG_PROBLEM;?></li>
	</a>
	<a href="./problem_import.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_IMPORT.$MSG_PROBLEM;?></li>
	</a>
	<a href="./update_db.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_UPDATE_DATABASE;?></li>
	</a>
	
	<?php } if (isset($OJ_ONLINE)&&$OJ_ONLINE) { //OJ在线监控部分 ?>
	<a href="./online.php" target="main">
		<li class="list-group-item btn-primary"><?php echo $MSG_ONLINE;?></li>
	</a>
	
	<?php } // 任何有权限的人可见部分?>
	<a href="../" target="_parent">
		<li class="list-group-item btn-primary"><?php echo $MSG_HOME;?></li>
	</a>
</ul>
<?php if (isset($_SESSION['administrator'])&&!$OJ_SAE) { ?>
	<a href="problem_copy.php" target="main" title="Create your own data"><font color="eeeeee">CopyProblem</font></a> <br>
	<a href="problem_changeid.php" target="main" title="Danger,Use it on your own risk"><font color="eeeeee">ReOrderProblem</font></a>
   
<?php } ?>
</body>
</html>
