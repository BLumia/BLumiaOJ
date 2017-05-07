<div class="jumbotron">
	<div class="container" style="text-align:center;">
	<h2><i class="fa fa-lock" aria-hidden="true"></i> <?php 
		if ($contestStarted == false) {
			echo L_CONTEST_NOT_START;
		} else {
			echo L_CONTEST_NOT_AUTH;
		}
	?> <i class="fa fa-lock" aria-hidden="true"></i></h2>
	
	<?php if ($contestUsePassword && isset($_SESSION['user_id']) ) { ?>
		<p><?php echo L_CONTEST_NEED_PSW;?></p>
		<form method="post" action="./contest.php?cid=<?php echo $cid;?>">
		<div class="input-group">
			<input type="text" class="form-control" name="psw" placeholder="输入密码">
			<span class="input-group-btn">
				<button class="btn btn-default" type="submit"><?php echo L_JOIN_CONTEST;?></button>
			</span>
		</div><!-- /input-group -->
		</form>
	<?php } ?>
	<?php if (!isset($_SESSION['user_id']) ) { ?>
		<p><?php echo L_CONTEST_NEED_ACCOUNT;?></p>
		<p>
		<a class="btn btn-primary btn-lg" href="./loginpage.php" role="button"><?php echo L_LOGIN;?></a> <?php echo L_OR;?> 
		<a class="btn btn-primary btn-lg" href="./registerpage.php" role="button"><?php echo L_SIGNUP;?></a>
		</p>
	<?php } ?>
	</div>
</div>