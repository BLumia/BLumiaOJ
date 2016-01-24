
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				
					<h1><?php echo $user_name; ?> <small>ID: <?php echo $user_id;?></small></h1>
					<ol class="breadcrumb">
						<li><a href="userinfo.php"><i class="icon-dashboard"></i> User Page</a></li>
						<li class="active"><i class="icon-file-alt"></i> Private Message</li>
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
								<label>To:</label>
								<input class="form-control" name=to_user placeholder="Enter User Name Here">
							</div>
							
							<div class="form-group">
								<label>Title:</label>
								<input class="form-control" name=title>
							</div>
				
							<div class="form-group">
								<label>Content</label>
								<textarea class="form-control" name=content rows="4"></textarea>
							</div>
				
							<button type="submit" class="btn btn-default">发送</button>
							<button type="reset" class="btn btn-default">清空</button>  
				
							</form>
						</div>
						
						<div class="col-lg-12">
							<h2>My In-box<small> <a class="" data-toggle="collapse" href="#create-mail" aria-expanded="true">Write New Mail</a></small></h2>
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
			<!-- 显示一个统计图 -->
			<!-- 显示其他信息 -->
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>