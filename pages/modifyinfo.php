<!DOCTYPE html>
<html>
<head>
	<?php require_once('./include/common_head.inc.php'); ?>
	<script src="./sitefiles/js/jqBootstrapValidation.js"></script>
	<title><?php echo L_MOD_INFO." - {$OJ_NAME}";?></title>
</head>	
<body>
	<?php require("./pages/components/navbar.php");?>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
			
				<h1><?php echo $user_name; ?> <small><?php echo L_UID.": {$user_id}";?></small></h1>
				<ol class="breadcrumb">
					<li><a href="userinfo.php"><i class="icon-dashboard"></i> <?php echo L_USER_PAGE;?></a></li>
					<li class="active"><i class="icon-file-alt"></i> <?php echo L_MODIFY_INFO;?></li>
				</ol>
				
				<div class="row">
					<div class="col-lg-12">
						<div class="control-group">
							<label class="control-label"><?php echo L_UID;?> (<?php echo L_NOT_EDITABLE;?>):</label>
							<div class="controls">
								<input type="text" value="<?php echo htmlspecialchars($user_id);?>" class="form-control" readonly />
							</div>
						</div>
						<form id="modifyinfo-form" class="form-horizontal">
							<div class="control-group">
								<label class="control-label"><?php echo L_NICK;?></label>
								<div class="controls">
									<input type="text" class="form-control" name="user_nick" value="<?php echo htmlspecialchars($user_name)?>" required />
									<p class="help-block"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><?php echo L_ORI_PSW;?> (*)</label>
								<div class="controls">
									<input type="password" class="form-control" name="ori_pwd" required />
									<p class="help-block"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><?php echo L_NEW_PSW;?></label>
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
								<label class="control-label"><?php echo L_NEW_PSW_AGAIN;?></label>
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
								<label class="control-label"><?php echo L_SCHOOL;?></label>
								<div class="controls">
									<input type="text" class="form-control" name="user_school" value="<?php echo htmlspecialchars($user_school)?>" />
									<p class="help-block"></p>
								</div>
							</div>
							<div class="control-group">
								<label class="control-label"><?php echo L_EMAIL;?></label>
								<div class="controls">
									<input type="email" class="form-control" name="user_email" value="<?php echo htmlspecialchars($user_email)?>" required />
									<p class="help-block"></p>
								</div>
							</div>
							<?php require_once('./include/pageauth_post.php'); ?>
							<button type="submit" class="btn btn-info"><?php echo L_SUBMIT;?></button><br/><br/>
						</form>
					</div>
				</div>
			</div>
		</div><!-- /.row, 3 medal -->
	</div><!--main wrapper end-->
	<?php require("./pages/components/footer.php");?>
	<div id="modal" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo L_INFOLABEL;?></h4>
		  </div>
		  <div class="modal-body">
			<p id="response-text"></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-primary" onclick="window.location.reload()"><?php echo L_OK;?></button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<script>
	$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation( {
		preventSubmit: true,
		submitSuccess: function ($form, event) { 
			submitForm();
			event.preventDefault();
		}
	}
	); } );
	function submitForm() {
		$.ajax({  
			url:"./api/user_modifyinfo.php",  
			type:'POST',  
			data:$('#modifyinfo-form').serialize(),
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				$('#response-text').text(data.message);
				$("#modal").modal("show");
			},
			error: function(data) {
				$('#response-text').text(data.responseJSON.message);
				$("#modal").modal("show");
			}
		});
	}
</script>
</body>
</html>