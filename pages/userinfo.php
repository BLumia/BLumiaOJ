<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/highcharts.js"></script>
		<title><?php echo L_USER_PAGE." - {$OJ_NAME}";?></title>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				
					<h1><?php echo $user_name; ?> <small><?php echo L_UID.": {$user_id}";?></small></h1>
					<ol class="breadcrumb">
						<li><a href="userinfo.php"><i class="icon-dashboard"></i> <?php echo L_USER_PAGE;?></a></li>
						<li class="active"><i class="icon-file-alt"></i> <?php echo L_USER_INFO;?></li>
					</ol>
					
					<div class="row">
						<div class="col-lg-3 col-sm-3">
							<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
								<div class="col-xs-6">
									<i class="fa fa-check fa-5x"></i>
								</div>
								<div class="col-xs-6 text-right">
									<p class="medal-heading"><?php echo $user_solved; ?></p>
									<p class="medal-text"><?php echo L_SOLVED;?>!</p>
								</div>
								</div>
							</div>
							<a href="#ls-accepted">
								<div class="panel-footer medal-bottom">
								<div class="row">
									<div class="col-xs-9">
									All Solved
									</div>
									<div class="col-xs-3 text-right">
									<i class="fa fa-arrow-circle-right"></i>
									</div>
								</div>
								</div>
							</a>
							</div>
						</div>
						<div class="col-lg-3 col-sm-3">
							<div class="panel panel-info">
							<div class="panel-heading">
								<div class="row">
								<div class="col-xs-6">
									<i class="fa fa-code fa-5x"></i>
								</div>
								<div class="col-xs-6 text-right">
									<p class="medal-heading"><?php echo $user_submit;?></p>
									<p class="medal-text"><?php echo L_CHALLENGED;?>!</p>
								</div>
								</div>
							</div>
							<a href="status.php?uid=<?php echo $user_id; ?>">
								<div class="panel-footer medal-bottom">
								<div class="row">
									<div class="col-xs-9">
									Full Challenged
									</div>
									<div class="col-xs-3 text-right">
									<i class="fa fa-arrow-circle-right"></i>
									</div>
								</div>
								</div>
							</a>
							</div>
						</div>
						<div class="col-lg-6 col-sm-6">
							<div class="panel panel-default">
							<div class="panel-heading">
								<div class="row">
								<div class="col-xs-3">
									<i class="fa fa-user fa-5x"></i>
								</div>
								<div class="col-xs-9 text-right">
									<p class="medal-heading"><?php echo $user_name; ?></p>
									<p class="medal-text"><?php echo L_EMAIL;?>: <?php echo $user_email; ?></p>
								</div>
								</div>
							</div>
							<a href="ranklist.php">
								<div class="panel-footer medal-bottom">
								<div class="row">
									<div class="col-xs-6">
									(See Ranking)
									</div>
									<div class="col-xs-6 text-right">
									<i class="fa fa-arrow-circle-right"></i>
									</div>
								</div>
								</div>
							</a>
							</div>
						</div>
					</div><!-- /.row -->
					<div class="row">
						<div class="col-sm-6">
							<ul class="list-group">
								<li class="list-group-item"><?php echo L_SOLVED;?>: <a href="#"><?php echo $user_solved;?> Solved</a></li>
								<li class="list-group-item"><?php echo L_CHALLENGED;?>: <a href="status.php?uid=<?php echo $user_id; ?>"><?php echo $user_submit;?> Submits</a></li>
								<?php 
								if (isset($user_other)) {
									foreach($user_other as $row){
										echo "<li class='list-group-item'>";
										//echo $JUDGE_RESULT[$row[0]]." - ".$row[1]; 与下一行功能一致
										echo $JUDGE_RESULT[$row['result']].": <a href='status.php?uid={$user_id}&judgeresult={$row['result']}'>".$row['count(1)'];
										echo "</a></li>";
									}
								}
								?>
							</ul>
						</div>
						<div class="col-sm-6">
						<?php if (isset($user_other)) { ?>
							<div id="cont" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						<?php } else {
							echo L_NO_SUBMIT_RECORD;
						} ?>
						</div>
					</div><!-- /.row -->
			
				</div>
				<div class="col-lg-12">
					<a class="" data-toggle="collapse" href="#ls-accepted" aria-expanded="true" aria-controls="ls-accepted"><h3>Accepted:</h3></a>
					<div style="" aria-expanded="true" class="well collapse in" id="ls-accepted">
						<i class="fa fa-check fa-3x"></i>
						<?php foreach($user_solved_list as $row) { echo "<a href='problem.php?pid={$row['problem_id']}'>{$row['problem_id']}</a> ";} ?>
					</div>
				</div>
			</div><!-- /.row, 3 medal -->
			<!-- 显示其他信息 -->
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		<script type="text/javascript">
			$(function () {
				var chart;
				$(document).ready(function () {
					// Build the chart
					$('#cont').highcharts({
						chart: {
							plotBackgroundColor: null,
							plotBorderWidth: null,
							plotShadow: false
						},
						title: {
							text: 'User Submits Map'
						},
						tooltip: {
							pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
						},
						plotOptions: {
							pie: {
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
									enabled: true
								},
								showInLegend: true
							}
						},
						series: [{
							type: 'pie',
							name: 'percentage',
							data: [
								<?php 
									if (isset($user_other)) {
										foreach($user_other as $row){
											//echo $JUDGE_RESULT[$row[0]]." - ".$row[1]; 与下一行功能一致
											echo "['".$JUDGE_RESULT[$row['result']]."', ".$row['count(1)']."],";
										}
									} else {
										echo "[ 'Challenged' , 0 ]";
									}
								?>
							]
						}]
					});
				});
			});
		</script>
	</body>
</html>