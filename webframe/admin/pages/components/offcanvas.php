	<?php if (!is_pjax()) { ?>
	<nav nav-pjax class="navmenu navmenu-inverse navmenu-fixed-left offcanvas-sm" role="navigation">
		<a class="navmenu-brand" href="#">BLumia OJ Admin</a>
		
		<div class="navmenu-group-header">Problem Editor</div>
		<ul class="nav navmenu-nav">
			<li><a href="./problem_list.php">问题列表</a></li>
			<li><a href="./problem_manager.php">管理问题</a></li>
		</ul>
		<div class="navmenu-group-header">Contest Editor</div>
		<ul class="nav navmenu-nav">
			<li><a href="./contest_add.php">添加竞赛</a></li>
			<li><a href="./contest_manager.php">管理竞赛</a></li>
		</ul>
		<div class="navmenu-group-header">Page Modifier</div>
		<ul class="nav navmenu-nav">
			<li><a href="./news_manager.php">管理新闻</a></li>
			<li><a href="#">管理广播</a></li>
		</ul>
		<div class="navmenu-group-header">User Manager</div>
		<ul class="nav navmenu-nav">
			<li><a href="./reset_password.php">重置密码</a></li>
			<li><a href="#">账号生成器</a></li>
		</ul>
		<div class="navmenu-group-header">Super User</div>
		<ul class="nav navmenu-nav">
			<li><a href="#">权限管理</a></li>
		</ul>
		<div class="navmenu-divider"></div>
		<ul class="nav navmenu-nav">
			<li><a href="../index.php">退出管理页面</a></li>
		</ul>
		
	</nav>
	<div class="navbar navbar-inverse navbar-fixed-top hidden-md hidden-lg">
		<button type="button" class="navbar-toggle" data-toggle="offcanvas" data-target=".navmenu">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="#">BLumia OJ Admin</a>
	</div>
	<?php } ?>