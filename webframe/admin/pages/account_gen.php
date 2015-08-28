<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Account Generator <small>Control Panel</small></h1>
		</div>
		<p class="lead">
			您可以从这里开始进行竞赛的添加和管理。
		</p>
		<div class="well">
			<form class="form" method="POST">
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label>输入账号前缀（如team）: </label><br/>
						<input type='text' name='prefix' class="form-control" placeholder="Account ID prefix here">
					</div><br/>
					<div class="form-group">
						<label>输入要生成的账号数量: </label><br/>
						<input type="text" class="form-control" name='teamnumber' value=50 placeholder="A Number Here">
					</div><br/><br/>
					<?php require_once('../include/pageauth_post.php'); ?>
					<button value=Generate type="submit" class="btn btn-default">提交</button>
					</div>
					<div class="col-md-6">
						<label>用户列表（如果需要）: </label><br/>
						<textarea class="form-control" name="ulist" rows="9"><?php if (isset($ulist)) { echo $ulist; } ?></textarea>
					</div>
				</div>
			</form><br/>
		</div>
	</div>
</body>