<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Problem Management <small>Problem Copy</small></h1>
		</div>
		<p class="lead">
			您可以通过这里开始从其他OJ导入问题，但请注意：
			<ul>
				<li>尊重题目所有权，请不要导入有版权争议的题目</li>
				<li>导入题目仅为通过URL解析题目，您需要手动添加非样例的数据</li>
			</ul><br/>
		</p>
		<div class="well">
			<form class="form-inline" action="./problem_import_url.php" method="GET">
				<div class="form-group">
					<label>从HDU导入: </label>
					<input type="text" class="form-control" name="hdu_id" placeholder="输入题目ID，如1001">
				</div>
				<button type="submit" class="btn btn-default">开始解析</button>
			</form><br/>
			<form class="form-inline" action="./problem_import_url.php" method="GET">
				<div class="form-group">
					<label>从POJ导入: </label>
					<input type="text" class="form-control" name="poj_id" placeholder="输入题目ID，如1001">
				</div>
				<button type="submit" class="btn btn-default">开始解析</button>
			</form><br/>
		</div>
	</div>
</body>