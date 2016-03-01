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
				<h4 class="list-group-item-heading"><i class="fa fa-plus-circle"></i> Add Problem</h4>
				<p class="list-group-item-text">添加一个问题</p>
			</a>
			<a href="./problem_list.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-th-list"></i> Problem List</h4>
				<p class="list-group-item-text">查看问题列表</p>
			</a>
			<a href="./problem_import_file.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-file-o"></i> Import Problem From File</h4>
				<p class="list-group-item-text">从文件导入..</p>
			</a>
			<a href="./problem_copy.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-link"></i> Import Problem From URL</h4>
				<p class="list-group-item-text">从网址导入..</p>
			</a>
			<a href="./problem_rejudge.php" class="list-group-item">
				<h4 class="list-group-item-heading"><i class="fa fa-gavel"></i> Problen Rejudger</h4>
				<p class="list-group-item-text">重判题目/重判一次提交</p>
			</a>
		</div>
	</div>
</body>