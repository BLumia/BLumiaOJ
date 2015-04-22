
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
				<div class="col-md-3">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="输入用户名">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">走起</button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-3 -->
				<div class="col-md-3">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="输入学号前几位">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">查询</button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-3 -->
				<div class="col-md-3">
					<form class="form-inline text-right">
						<div class="form-group">
							<select class="form-control">
								<option>==日期段==</option>
								<option>总</option>
								<option>日</option>
								<option>周</option>
								<option>月</option>
								<option>年</option>
							</select>
						</div>
						<button type="submit" class="btn btn-default">找</button>
					</form>
				</div><!-- /.col-lg-3 -->
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
						<tbody>
							<tr>
								<td>260726</td>
								<td>BLumia</td>
								<td><a href="#">1001</a></td>
								<td><span class="label label-success">Accept</span></td>
								<td>768</td>
								<td>0</td>
								<td>gcc</td>
								<td>61</td>
								<td>2015/4/18 00:37:57</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>