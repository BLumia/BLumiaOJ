<body style="background:url(./sitefiles/pic/loginbg.png);">

    <div class="container" style="max-width:400px; padding-top:61px;">
		<div class="panel" style="padding:20px 20px;">
			<form action="./api/user_register.php" method="post">
			<h2>Please Sign Up</h2>
			<label class="sr-only">User ID</label>
			<div class="control-group">
				<input 
					name="username" 
					class="form-control" 
					minlength="3" 
					maxlength="20" 
					placeholder="(*) User ID" 
					data-validation-minlength-message="UserID Should be longer than 3 char." 
					type="text" 
					required
				/>
				<p class="help-block"></p>
			</div>
			<label class="sr-only">Nick Name</label>
			<div class="control-group">
				<input name="nickname" class="form-control" placeholder="Nick Name" type="text">
				<p class="help-block"></p>
			</div>
			<label class="sr-only">Password</label>
			<div class="control-group">
				<input
					name="password" 
					class="form-control" 
					placeholder="(*) Password" 
					type="password"
					minlength="6"
					data-validation-minlength-message="Password Should be longer than 6 char."
					required
				>
				<p class="help-block"></p>
			</div>
			<label class="sr-only">Repeat Password</label>
			<div class="control-group">
				<input 
					name="password_again" 
					class="form-control" 
					data-validation-match-match="password" 
					data-validation-match-message = "Password NOT Matched"
					placeholder="(*) Password Again" 
					type="password"
				>
				<p class="help-block"></p>
			</div>
			<label class="sr-only">School</label>
			<div class="control-group">
				<input name="school" class="form-control" placeholder="School" type="text">
				<p class="help-block"></p>
			</div>
			<label class="sr-only">E-Mail</label>
			<div class="control-group">
				<input name="email" class="form-control" placeholder="(*) E-Mail" type="email" required>
				<p class="help-block"></p>
			</div>
			<div class="control-group">
				<div class="checkbox btn-block">
					<label>
						<input 
							name="eula" 
							type="checkbox" 
							required
						> Accept End-user license agreements
					</label>
					<p class="help-block"></p>
				</div>
			</div>
			
			<?php require_once('./include/pageauth_post.php'); ?>
		
			<button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
			</form>
		</div>
    </div> <!-- /container -->

<script>
	$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );
</script>
</body>