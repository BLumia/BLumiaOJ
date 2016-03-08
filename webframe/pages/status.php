
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="btn-group" role="group" aria-label="...">
						<button type="button" class="btn btn-default">《</button>
						<button type="button" class="btn btn-default">1</button>
						<button type="button" class="btn btn-default">》</button>
					</div>
				</div>
				<div class="col-md-9">
					<form class="form-inline text-right">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="题目编号">
							<input type="text" class="form-control" placeholder="用户名">
							<select class="form-control">
								<option>==语言==</option>
								<option>C</option>
							</select>
							<select class="form-control">
								<option>==结果==</option>
								<option>Accept</option>
							</select>
						</div>
						<button type="submit" class="btn btn-default">找</button>
					</form>
				</div><!-- /.col-md-6 -->
			</div><!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-hover" id="tableID">
						<thead>
							<tr>
								<th width="10%">Run ID</th>
								<th width="14%">User ID</th>
								<th width="10%">Problem ID</th>
								<th width="20%" style="text-align: center;">Result</th>
								<th width="8%">Memory</th>
								<th width="8%">Time</th>
								<th width="8%">Compiler</th>
								<th width="8%">Length</th>
								<th width="14%">Submit Time</th>
							</tr>
						</thead>
						<tbody id="oj-statue-list">
							<!-- use ajax to load result -->
							
						<?php 
						foreach($statusResult as $row) { 
							$codeUrl = "<a href='./source_view.php?id={$row['solution_id']}'>{$LANGUAGE_NAME[$row['language']]}</a>"; // TODO: can i see this code?
						?>
							<tr class="<?php echo $JUDGE_ROW_CSS_CLASS[$row['result']]; ?>">
								<td><?php echo $row['solution_id']; ?></td>
								<td><?php echo $row['user_id']; ?></td>
								<td><?php echo $row['problem_id']; ?></td>
								<td class="result">
								<?php 
								echo "<span class='label label-{$JUDGE_ROW_CSS_CLASS[$row['result']]}'>{$JUDGE_RESULT[$row['result']]}</span>"; 
								?></td>
								<td><?php echo $row['memory']; ?></td>
								<td><?php echo $row['time']; ?></td>
								<td><?php echo $codeUrl; ?></td>
								<td><?php echo $row['code_length']; ?></td>
								<td><?php echo $row['in_date']; ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	<script type="text/javascript">
	function changepage(num){
		NProgress.start();
		$.ajax({
			url:"./api/ajax_status.php?p="+num,
			async:false,
			contentType:"application/x-www-form-urlencoded; charset=utf-8",
			success:function(data/*返回的数据*/, textStatus, jqXHR){
				$("#oj-statue-list").html(data);
				$("tr").fadeIn();
			},
			complete:function(jqXHR, textStatus){
				NProgress.done();
			}
		});
	}
	
	changepage(<?php echo $p;?>);
	</script>
	</body>