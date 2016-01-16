
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
								<th width="20%">Result</th>
								<th width="8%">Memory</th>
								<th width="8%">Time</th>
								<th width="8%">Compiler</th>
								<th width="8%">Length</th>
								<th width="14%">Submit Time</th>
							</tr>
						</thead>
						<tbody id="oj-statue-list">
							<!-- use ajax to load result -->
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
				document.getElementById("oj-statue-list").innerHTML=data;
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