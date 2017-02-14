<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title><?php echo L_PROB_SET." - {$OJ_NAME}";?></title>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xs-12">
					<div class="btn-group" role="group" id="oj-ps-pager">
						<?php
							for($i=1;$i<=$pageCnt;$i++) {
								$pageNavBtnClass = ($i == $p) ? "btn-primary" : "btn-default";
								echo "<a type='button' class='btn {$pageNavBtnClass}' href='problemset.php?p={$i}'>{$i}</a>";
							}
						?>
					</div>
				</div>
				<div class="col-md-3 col-xs-6">
					<form method="get" action="./problem.php">
					<div class="input-group">
						<input type="text" class="form-control" name="pid" placeholder="输入题目编号">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">走起</button>
						</span>
					</div><!-- /input-group -->
					</form>
				</div><!-- /.col-lg-3 -->
				<div class="col-md-3 col-xs-6">
				<form method="get">
					<div class="input-group">
						<input type="text" name="wd" class="form-control" placeholder="输入标题关键字">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">搜索</button>
						</span>
					</div><!-- /input-group -->
				</form>
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
						<tbody id="oj-ps-problemlist">
						<?php foreach ($problemList as $row) { //problem list ------------  ?>
							<tr>
								<?php 
									if ($row['submit'] == 0) {
										$pctText = "N/A";
										$procBarNum = 0;
										$pctNum = 0;
									} else {
										$pctNum = ($row['accepted']/$row['submit'])*100;
										$procBarNum = (1-($row['accepted']/$row['submit']))*100;
										$pctText = sprintf("%.2f%%",$pctNum);
									}
								?>
								<td>
								<?php 
									if ($row['defunct'] == 'Y') echo "<i class='fa fa-lock'></i>";
									if (isset($probIDUCList[$row['problem_id']])) echo "<i class='fa fa-clock-o'></i>";
									if (isset($probStatusList[$row['problem_id']])) {
										$thisProbState = $probStatusList[$row['problem_id']];
										switch($thisProbState) {
										case "accepted":
											echo "<i style='color: green;' class='fa fa-check'></i>";
											break;
										default:
											echo "<i style='color: orange;' class='fa fa-dot-circle-o'></i>";
											break;
										}
									}
								?>
								</td>
								<td><?php echo $row['problem_id'];?></td>
								<td>
									<a href="problem.php?pid=<?php echo $row['problem_id'];?>"><?php echo $row['title'];?></a>
									<!--<div class="tr-tag"><span>搜索</span></div>-->
								</td>
								<td><div class="progress maxwidth150px"><div class="progress-bar" style="width:<?php echo $procBarNum;?>%;"></div></div></td>
								<td><?php echo utf8_substr($row['source'],0,14);?></td>
								<td>(<?php echo $row['accepted']." / ".$row['submit'];?>) <?php echo $pctText;?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>

	</body>
</html>