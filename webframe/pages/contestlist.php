
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-md-4 col-xs-4">
					<div class="btn-group" role="group" aria-label="...">
						<button type="button" class="btn btn-default">《</button>
						<button type="button" class="btn btn-default">1</button>
						<button type="button" class="btn btn-default">》</button>
					</div>
				</div>
				<div class="col-md-4 col-xs-4 text-right">
					<button type="button" class="btn btn-default">Create Contest</button>
				</div><!-- /.col-lg-3 -->
				<div class="col-md-4 col-xs-4 text-right">
					<div class="btn-group" role="group" aria-label="...">
					<button type="button" class="btn btn-default">All</button>
					<button type="button" class="btn btn-default">Public</button>
					<button type="button" class="btn btn-default">Private</button>
					</div>
				</div><!-- /.col-lg-3 -->
			</div><!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-hover" id="tableID">
						<thead>
							<tr>
								<th width="15%">Contest ID</th>
								<th width="45%">Title</th>
								<th width="15%">Status</th>
								<th width="10%">Privilege</th>
								<th width="15%">Creator</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($contestList as $row) { // list ------------ ?>
							<tr>
								<td><?php echo $row['contest_id'];?></td>
								<td><a href="contest.php?cid=<?php echo $row['contest_id'];?>"><?php echo $row['title'];?></a></td>
								<td><?php echo $row['content_status'];?></td>
								<td><?php echo $row['private'];?></td>
								<td><?php echo $row['user_id'];?></td>
							</tr>
						<?php } //User list end --------------------------------------- ?>
						</tbody>
					</table>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	</body>