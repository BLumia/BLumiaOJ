<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Contest Management <small>Control Panel</small></h1>
		</div>
		<p class="lead">
			您可以从这里开始进行竞赛的管理。<br/>
			若要对竞赛进行编辑和其他针对某个竞赛的操作，请进入“竞赛列表”。
		</p>
		<div class="list-group">
			<a href="./contest_add.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-plus-circle"></i> Add Contest</h4>
				<p class="list-group-item-text">添加一个竞赛</p>
			</a>
			<a href="./contest_list.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-th-list"></i> Contest List</h4>
				<p class="list-group-item-text">查看竞赛列表</p>
			</a>
		</div>
	</div>
</body>