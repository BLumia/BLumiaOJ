<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Problem Management <small>Problem Import</small></h1>
		</div>
		<p class="lead">
			您可以通过这里开始导入来自HustOJ(FreeProblemSet)或是BLOJ导出的问题<br/>
			您最大可以导入的文件大小是：<?php echo $maxFileSize; ?> [<a data-toggle="collapse" href="#detail" aria-expanded="true">为什么</a>]
			<div class="well collapse" id="detail">
				关于可上传的文件大小限制相关的帮助：<br/>
				可以上传的文件大小是在php配置文件中设定的。如果您希望进行调整，请参见 PHP.ini 中 upload_max_filesize 和 post_max_size 的值 。<br/>
				如果您导入超过10+ MiB大小的文件失败了并且上述两个值设置没有问题，您可能还需要调整 memory_limit 的值。同样是在PHP的配置文件中。
			</div>
		</p>
		<div class="well">
			<form class="form-inline" action="./problem_import_file.php" method="POST"  method=post enctype="multipart/form-data">
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