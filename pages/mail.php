<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title><?php echo L_INBOX." - {$OJ_NAME}";?></title>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
		<?php if ($OJ_LARGE_CONTEST_MODE == true) { ?>
			<div class="row">
				<div class="alert alert-warning">
					&nbsp;Large contest mode enabled, private mail is unavaliabled for that. 
				</div>	
			</div>
		<?php } else { ?>
			<div class="row">
				<div class="col-lg-12">
				
					<h1><?php echo $user_name; ?> <small>ID: <?php echo $user_id;?></small></h1>
					<ol class="breadcrumb">
						<li><a href="userinfo.php"><i class="icon-dashboard"></i> <?php echo L_USER_PAGE;?></a></li>
						<li class="active"><i class="icon-file-alt"></i> <?php echo L_INBOX;?></li>
					</ol>
					
					<div class="row">
						<?php if($view_content){ ?>
						<div class="col-lg-12">
							<div class="panel panel-info">
								<div class="panel-heading">
									<?php 
										echo $to_user.": ".htmlspecialchars(str_replace("\n\r","\n",$view_title)); 
									?>
								</div>
								<div class="panel-body">
									<div class="row">
									<div class="col-xs-9">
										
										<?php
										//<pre>? btw.. htmlspecialchars removed
											echo RemoveXSS(str_replace("\n\r","\n",$view_content));
										?>
										
									</div>
									<div class="col-xs-3">
										<i class="fa fa-envelope fa-5x"></i>
									</div>
								</div>
							</div>
							
							<div class="panel-footer announcement-bottom">
								<div class="row">
									<div class="col-xs-6">
										<?php echo $view_date;?>
									</div>
									<div class="col-xs-6 text-right">
									<i class="fa fa-arrow-circle-right"></i>
									</div>
								</div>
							</div>
							
							</div>
						</div>
						<?php } ?>
						
						<div style="" aria-expanded="true" class="col-lg-12 collapse" id="create-mail">
				
							<form role="form" method=post action=mail.php>
				
							<div class="form-group">
								<label><?php echo L_SEND_TO;?>:</label>
								<input class="form-control" name=to_user placeholder="Enter User Name Here">
							</div>
							
							<div class="form-group">
								<label><?php echo L_TITLE;?>:</label>
								<input class="form-control" name=title>
							</div>
				
							<div class="form-group">
								<label><?php echo L_CONTENT;?>:</label>
								<textarea class="form-control" name=content rows="4"></textarea>
							</div>
				
							<button type="submit" class="btn btn-default"><?php echo L_SEND;?></button>
							<button type="reset" class="btn btn-default"><?php echo L_CLEAR;?></button>  
				
							</form>
						</div>
						
						<div class="col-lg-12">
							<h2><?php echo L_INBOX;?><small> <a class="" data-toggle="collapse" href="#create-mail" aria-expanded="true"><span class="label label-primary"><?php echo L_WRITE_NEW_MAIL;?></span></a></small></h2>
							<div class="table-responsive">
							<table class="table table-bordered table-hover tablesorter">
								<thead>
								<tr>
									<th>Mail ID</th>
									<th>Title</th>
									<th>From</th>
									<th>Date</th>
									<th>Control</th>
								</tr>
								</thead>
								<tbody>
								<?php
									$cnt=0;
									foreach($view_mail as $row){
										if ($cnt)
											echo "<tr class='oddrow'>";
										else
											echo "<tr class='evenrow'>";
										foreach($row as $table_cell){
											echo "<td>";
											echo "\t".$table_cell;
											echo "</td>";
										}
										echo "</tr>";
										$cnt=1-$cnt;
									}
								?>
								</tbody>
							</table>
							</div>
						</div>
					</div><!-- /.row -->
			
				</div>
			</div><!-- /.row, 3 medal -->
		<?php } ?>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>
</html>
