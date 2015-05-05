<body style="background:url(./sitefiles/pic/loginbg.png);">

    <div class="container" style="max-width:400px; padding-top:61px;">
		<div class="panel" style="padding:20px 20px;">
			<form action="./api/login.php" method="post">
			<h2>Please sign in</h2>
			<label class="sr-only">User ID</label>
			<input name="username" class="form-control" placeholder="User ID" autofocus="" type="text"><br/>
			<label class="sr-only">Password</label>
			<input name="password" class="form-control" placeholder="Password" type="password"><br/>
			
			<?php require_once('./include/pageauth_post.php'); ?>
		
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
			</form>
		</div>
    </div> <!-- /container -->
  

</body>