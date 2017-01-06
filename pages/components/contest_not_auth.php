<div class="jumbotron">
	<div class="container" style="text-align:center;">
	<h2><i class="fa fa-lock" aria-hidden="true"></i> <?php echo L_CONTEST_NOT_AUTH;?> <i class="fa fa-lock" aria-hidden="true"></i></h2>
	
	<?php if ($contestUsePassword && isset($_SESSION['user_id']) ) { ?>
		<p>You can also access this contest by using a password. Enter the password if you know.</p>
		<form method="post" action="./contest.php?cid=<?php echo $cid;?>">
		<div class="input-group">
			<input type="text" class="form-control" name="psw" placeholder="输入密码">
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit">加入比赛</button>
			</span>
		</div><!-- /input-group -->
		</form>
	<?php } ?>
	<?php if (!isset($_SESSION['user_id']) ) { ?>
		<p>An account is required to take part in any contest.</p>
		<p>
		<a class="btn btn-primary btn-lg" href="./loginpage.php" role="button"><?php echo L_LOGIN;?></a> <?php echo L_OR;?> 
		<a class="btn btn-primary btn-lg" href="./registerpage.php" role="button"><?php echo L_SIGNUP;?></a>
		</p>
	<?php } ?>
	</div>
</div>