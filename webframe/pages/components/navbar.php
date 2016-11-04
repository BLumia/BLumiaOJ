<?php
	function checkmail($pdo){
	/*
		返回当前登录用户的未读邮件数
		要求登陆
		@param $pdo 数据库连接柄
	*/
		$sql=$pdo->prepare("SELECT count(1) FROM `mail` WHERE 
				new_mail=1 AND `to_user`=?");
		$sql->execute(array($_SESSION['user_id']));
		$result=$sql->fetch();
		//var_dump($result);
		if ($result['count(1)'] != 0)
			$ret = "<span class='badge'>".$result['count(1)']."</span>";
		else 
			$ret = "";
		return $ret;
	}
?>
<nav class="navbar navbar-default">
	<div class="container">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"><?php echo $OJ_NAME;?></a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="problemset.php"><?php echo L_PROB_SET;?></a></li>
				<li><a href="status.php"><?php echo L_STATUS;?></a></li>
				<li><a href="ranklist.php"><?php echo L_RANKLIST;?></a></li>
				<li><a href="contestlist.php"><?php echo L_CONTEST;?></a></li>
				
				<?php if ($VJ_ENABLED) {?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo L_VJ;?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li><a href="problemset_vj.php"><?php echo L_PROB_SET;?></a></li>
						<li><a href="status_vj.php"><?php echo L_STATUS;?></a></li>
					</ul>
				</li>
				<?php } ?>
				
			</ul>
			<?php if (isset($_SESSION['user_id'])) { 
				$navUsrName = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : $_SESSION['user_id'];?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="./mail.php"><i class="fa fa-inbox"></i> <?php echo L_INBOX." ".checkmail($pdo);?></a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $navUsrName;?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
					<li><a href="./modifyinfo.php"><i class="fa fa-edit"></i> <?php echo L_MOD_INFO;?></a></li>
					<li><a href="./userinfo.php"><i class="fa fa-at"></i> <?php echo L_USR_PAGE;?></a></li>
					<li><a href="./status.php?uid=<?php echo $_SESSION['user_id'];?>"><i class="fa fa-history"></i> <?php echo L_RECENTSUB;?></a></li>
					<?php if (isset($_SESSION['is_operator']) && $_SESSION['is_operator']) {?>
					<li class="divider"></li>
					<li><a href="./admin/index.php"><i class="fa fa-cogs"></i> <?php echo L_CTRLPANEL;?></a></li>
					<?php } ?>
					<li class="divider"></li>
					<li><a href="./api/logout.php"><i class="fa fa-sign-out"></i> <?php echo L_LOGOUT;?></a></li>
					</ul>
				</li>
			</ul>
			<?php } else { ?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="./registerpage.php"><i class="fa fa-user-plus"></i> <?php echo L_SIGNUP;?></a></li>
				<li><a href="./loginpage.php"><i class="fa fa-sign-in"></i> <?php echo L_LOGIN;?></a></li>
			</ul>
			<?php } ?>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>
<?php 
	if (file_exists("./admin/announcement.txt")) {
		$OJ_ANNOUNCEMENT = file_get_contents("./admin/announcement.txt");
		if ($OJ_ANNOUNCEMENT != "" && strlen($OJ_ANNOUNCEMENT)!=0 && $OJ_ANNOUNCEMENT!="<br>") {
?>
			<div class="container alert alert-info alert-dismissible" role="alert">
				<i class="fa fa-bell-o"></i>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<span class="sr-only">Announcement:</span>
				<?php echo $OJ_ANNOUNCEMENT; ?>
			</div>
<?php 
		} 
	} 
?>