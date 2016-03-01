<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Problem Management <small>Problem Import</small></h1>
		</div>
		<p class="lead">
			您可以通过这里开始导入来自HustOJ(FreeProblemSet)或是BLOJ导出的问题
		</p>
		<div class="well">
			<form class="form-inline" action="./problem_import_file.php" method="GET">
				<div class="form-group">
					<label>从FreeProblemSet xml格式导入: </label>
					<input type="file" name="xmlFile">
					<?php require_once("../include/pageauth_post.php");?><br/>
					<button type="submit" class="btn btn-default">开始导入</button>
				</div>
			</form><br/>
		</div>
	</div>
</body>