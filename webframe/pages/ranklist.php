
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
								<th width="10%">Rank</th>
								<th width="20%">User ID</th>
								<th width="30%">User Name</th>
								<th width="20%">Submits</th>
								<th width="20%">Exp.</th>
							</tr>
						</thead>
						<tbody>
						<?php for($i=0;$i<$userCount;$i++) { //topic list ------------ ?>
							<tr>
								<td><?php echo ($i+1);?></td>
								<td><?php echo $userList[$i]['user_id'];?></td>
								<td><a href="#"><?php echo $userList[$i]['nick'];?></a></td>
								<td><a href="#"><?php echo $userList[$i]['solved'];?></a> / <a href="#"><?php echo $userList[$i]['submit'];?></a> 66.66%</td>
								<td>Lv.6 1/6000</td>
							</tr>
						<?php } //User list end --------------------------------------- ?>
						</tbody>
					</table>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>