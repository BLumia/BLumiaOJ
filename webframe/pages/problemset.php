
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="btn-group" role="group" aria-label="...">
						<button type="button" class="btn btn-default">1</button>
						<button type="button" class="btn btn-default">2</button>
						<button type="button" class="btn btn-default">3</button>
					</div>
				</div>
				<div class="col-md-3 col-xs-6">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="输入题目编号">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">走起</button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-3 -->
				<div class="col-md-3 col-xs-6">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="输入标题关键字">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">搜索</button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-3 -->
			</div><!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-hover" id="tableID">
						<thead>
							<tr>
								<th width="5%">AC</th>
								<th width="5%">ID</th>
								<th width="40%">Title</th>
								<th width="20%">Difficulty</th>
								<th width="16%">Source</th>
								<th width="14%">AC/Submit</th>
							</tr>
						</thead>
						<tbody>
						<?php for($i=0;$i<$problemCount;$i++) { //topic list ------------ ?>
							<tr>
								<?php 
									if ($problemList[$i]['submit'] == 0) {
										$pctText = "Unavalible";
										$procBarNum = 0;
										$pctNum = 0;
									} else {
										$pctNum = ($problemList[$i]['accepted']/$problemList[$i]['submit'])*100;
										$procBarNum = (1-($problemList[$i]['accepted']/$problemList[$i]['submit']))*100;
										$pctText = sprintf("%.2f%%",$pctNum);
									}
								?>
								<td></td>
								<td><?php echo $problemList[$i]['problem_id'];?></td>
								<td>
									<a href="problem.php?pid=<?php echo $problemList[$i]['problem_id'];?>"><?php echo $problemList[$i]['title'];?></a>
									<div class="tr-tag">
										<span>搜索</span>
									</div>
								</td>
								<td><div class="progress"><div class="progress-bar" style="width:<?php echo $procBarNum;?>%;"></div></div></td>
								<td><?php echo $problemList[$i]['source'];?></td>
								<td>(<?php echo $problemList[$i]['accepted']." / ".$problemList[$i]['submit'];?>) <?php echo $pctText;?></td>
							</tr>
						<?php } //topic list end --------------------------------------- ?>
						</tbody>
					</table>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>