<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Problem Management <small>Problem Copy</small></h1>
		</div>
		<p class="lead">
			您可以重判某个题目或某个用户的某次提交，但请留意您的操作是否的确有必要进行并慎重使用本功能。
			<br/>
		</p>
		<div class="well">
			<form class="form-inline" action="../api/problem_rejudge.php" method="POST">
				<div class="form-group">
					<label>重判问题: </label>
					<input type="text" class="form-control" name="rjpid" placeholder="输入题目ID，如1001">
				</div>
				<button type="submit" class="btn btn-default">开始重判</button>
			</form><br/>
			<form class="form-inline" action="../api/problem_rejudge.php" method="POST">
				<div class="form-group">
					<label>重判提交: </label>
					<input type="text" class="form-control" name="rjsid" placeholder="输入运行编号">
				</div>
				<button type="submit" class="btn btn-default">开始重判</button>
			</form><br/>
		</div>
	</div>
</body>