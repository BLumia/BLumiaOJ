
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				
					<h1><?php echo "Problem ".$problem_id; ?> <small> <?php echo $problemInfo['title'];?></small></h1>
					<ol class="breadcrumb">
						<li><a href="problem.php?pid=<?php echo $problem_id;?>"><i class="icon-dashboard"></i> Problem Page</a></li>
						<li class="active"><i class="icon-file-alt"></i> Problem Statistics</li>
					</ol>
					
					<div class="row">
						<div class="col-sm-4">
							<div class="row">
							<div class="col-sm-12">
							<ul class="list-group">
								<li class="list-group-item">Solved: <?php echo "<a href='status.php?judgeresult=4&pid={$problem_id}'>{$problemInfo['solved']} Solved</a>";?></li>
								<li class="list-group-item">Challenged: <?php echo "<a href='status.php?pid={$problem_id}'>{$problemInfo['submit']} Submits</a>";?></li>
								<?php 
								if (isset($problemSubmits)) {
									foreach($problemSubmits as $row){
										echo "<li class='list-group-item'>";
										//echo $JUDGE_RESULT[$row[0]]." - ".$row[1]; 与下一行功能一致
										echo $JUDGE_RESULT[$row['result']].": <a href='status.php?judgeresult={$row['result']}'>".$row['count'];
										echo "</a></li>";
									}
								}
								?>
							</ul>
							</div>
							<div class="col-sm-12">
							<?php if (isset($problemSubmits) && count($problemSubmits) != 0) { ?>
								<div id="cont" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
							<?php } else {
								echo "No one solved this problem, try be the 1st man :)";
							} ?>
							</div>
							</div>
						</div>
						<div class="col-sm-8">
							<table class="table table-striped table-hover" id="tableID">
								<thead>
									<tr>
										<th>#</th>
										<th>RunID</th>
										<th>UserID</th>
										<th>Memory</th>
										<th>Time</th>
										<th>Language</th>
										<th>Submit Time</th>
									</tr>
								</thead>
								<tbody id="oj-ps-problemlist">
								<?php foreach($acceptedList as $row) { ?>
									<tr>
										<td></td>
										<td><?php echo $row['solution_id'];?></td>
										<td><?php echo "<a href='./userinfo.php?uid={$row['user_id']}'>{$row['user_id']}</a>";?></td>
										<td><?php echo intval(substr($row['score'],9,6))." KB";?></td>
										<td><?php echo intval(substr($row['score'],1,8))." ms";?></td>
										<td><?php echo $LANGUAGE_NAME[intval($row['language'])];?></td>
										<td><?php echo $row['in_date'];?></td>
										
									</tr>
								<?php } ?>
								</tbody>
							</table>
						</div>
					</div><!-- /.row -->
			
				</div>
			</div><!-- /.row, 3 medal -->
			<!-- 显示一个统计图 -->
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
									if (isset($problemSubmits)) {
										foreach($problemSubmits as $row){
											//echo $JUDGE_RESULT[$row[0]]." - ".$row[1]; 与下一行功能一致
											echo "['".$JUDGE_RESULT[$row['result']]."', ".$row['count']."],";
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