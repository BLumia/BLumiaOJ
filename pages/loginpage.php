<!DOCTYPE html>
<html>
<head>
	<?php require_once('./include/common_head.inc.php'); ?>
	<title><?php echo L_LOGIN." - {$OJ_NAME}";?></title>
</head>	
<body style="background:url(./sitefiles/pic/loginbg.png);">

    <div class="container" style="max-width:400px; padding-top:61px;">
		<div class="panel" style="padding:20px 20px;">
			<form action="./api/user_login.php" method="post">
			<h2><?php echo L_PLZ.' '.L_LOGIN;?></h2>
			<label class="control-label"><?php echo L_UID;?></label>
			<input name="username" class="form-control" placeholder="<?php echo L_UID;?>" autofocus="" type="text"><br/>
			<label class="control-label"><?php echo L_PSW;?></label>
			<input name="password" class="form-control" placeholder="<?php echo L_PSW;?>" type="password"><br/>
			
			<?php require_once('./include/pageauth_post.php'); ?>
		
			<button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo L_LOGIN;?></button>
			</form>
		</div>
    </div> <!-- /container -->
  
</body>
</html>