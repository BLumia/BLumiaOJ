<body style="background:url(./sitefiles/pic/loginbg.png);">

    <div class="container" style="max-width:400px; padding-top:61px;">
		<div class="panel" style="padding:20px 20px;">
			<form action="./api/user_login.php" method="post">
			<h2>Please sign in</h2>
			<label class="control-label">User ID</label>
			<input name="username" class="form-control" placeholder="User ID" autofocus="" type="text"><br/>
			<label class="control-label">Password</label>
			<input name="password" class="form-control" placeholder="Password" type="password"><br/>
			
			<?php require_once('./include/pageauth_post.php'); ?>
		
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
		</div>
    </div> <!-- /container -->
  

</body>