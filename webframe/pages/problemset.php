
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="btn-group" role="group" aria-label="...">
						<button type="button" class="btn btn-default">1</button>
						<button type="button" class="btn btn-default">2</button>
						<button type="button" class="btn btn-default">3</button>
					</div>
				</div>
				<div class="col-md-3">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="输入题目编号">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">走起</button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-3 -->
				<div class="col-md-3">
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
							<tr>
								<td></td>
								<td>1001</td>
								<td>
									<a href="#">Satellite Photographs </a>
									<div class="tr-tag">
										<span>搜索</span>
									</div>
								</td>
								<td><div class="progress"><div class="progress-bar" style="width:44%;"></div></div></td>
								<td>Test OJ</td>
								<td>(559 / 1014) 55.13%</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>