<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Privilege Management <small>Add Operator</small></h1>
		</div>
		<p class="lead">
			您可以通过这里添加管理员
		</p>
		<div class="well">
			<form class="form-inline" action="../api/privilege_add.php" method="POST">
				<div class="form-group">
					<label>输入用户ID（非昵称）: </label><br/>
					<input type="text" class="form-control" name="user_id" placeholder="User ID Here">
				</div><br/>
				<div class="form-group">
					<label>选择权限组: </label><br/>
					<select class="form-control" name="opTag">
					<?php 
						foreach($rightarray as $opGroupName) {
							echo "<option value='{$opGroupName}'>{$opGroupName}</option>";
						}
					?>
					</select>
				</div><br/><br/>
				<?php require_once('../include/pageauth_post.php'); ?>
				<button type="submit" class="btn btn-default">Submit</button>
			</form><br/>
		</div>
	</div>
</body>