<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Problem Management <small>Control Panel</small></h1>
		</div>
		<p class="lead">
			您可以从这里开始进行问题的导入和管理。<br/>
			若要对问题进行编辑和其他针对某个问题的操作，请进入“问题列表”。
		</p>
		<div class="list-group">
			<a href="./problem_add.php" class="list-group-item">
				<h4 class="list-group-item-heading">Add Problem</h4>
				<p class="list-group-item-text">添加一个问题</p>
			</a>
			<a href="#" class="list-group-item">
				<h4 class="list-group-item-heading">Problem List</h4>
				<p class="list-group-item-text">查看问题列表</p>
			</a>
			<a href="#" class="list-group-item">
				<h4 class="list-group-item-heading">Import Problem</h4>
				<p class="list-group-item-text">导入一个问题</p>
			</a>
		</div>
	</div>
</body>