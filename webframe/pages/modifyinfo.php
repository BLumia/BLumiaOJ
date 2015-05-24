
<body>
	<?php require("./pages/components/navbar.php");?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
			
				<h1><?php echo $user_name; ?> <small>ID: <?php echo $user_id;?></small></h1>
				<ol class="breadcrumb">
					<li><a href="userinfo.php"><i class="icon-dashboard"></i> User Page</a></li>
					<li class="active"><i class="icon-file-alt"></i> Modify User Info</li>
				</ol>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="control-group">
							<label class="control-label">User ID (not editable):</label>
							<div class="controls">
								<input type="text" value="<?php echo htmlspecialchars($user_id);?>" class="form-control" readonly />
							</div>
						</div>
						<form class="form-horizontal" action="./api/user_modifyinfo.php" method="post">
							<div class="control-group">
								<label class="control-label">Nick Name</label>
								<div class="controls">
									<input type="text" class="form-control" name="user_nick" value="<?php echo htmlspecialchars($user_name)?>" required />
									<p class="help-block"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">Original Password (*)</label>
								<div class="controls">
									<input type="password" class="form-control" name="ori_pwd" required />
									<p class="help-block"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">New Password</label>
								<div class="controls">
									<input 
										type="password" 
										class="form-control" 
										name="new_pwd"
										minlength="6"
										data-validation-minlength-message="Password Should be longer than 6 char."
									/>
									<p class="help-block"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">New Password Again</label>
								<div class="controls">
								<input 
									type="password" 
									data-validation-match-match="new_pwd" 
									class="form-control"
									name="new_pwd_ii" 
								/>
								<p class="help-block"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">School</label>
								<div class="controls">
									<input type="text" class="form-control" name="user_school" value="<?php echo htmlspecialchars($user_school)?>" required />
									<p class="help-block"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label">E-Mail</label>
								<div class="controls">
									<input type="email" class="form-control" name="user_email" value="<?php echo htmlspecialchars($user_email)?>" required />
									<p class="help-block"></p>
								</div>
							</div>
							<?php require_once('./include/pageauth_post.php'); ?>
							<button type="submit" class="btn btn-info">Submit</button><br/><br/>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.row, 3 medal -->
		<!-- 显示一个统计图 -->
		<!-- 显示其他信息 -->
	</div><!--main wrapper end-->
	<?php require("./pages/components/footer.php");?>
<script>
	$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
</body>