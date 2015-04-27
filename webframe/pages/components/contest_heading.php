<div id="contestHeading" class="text-center">
	<h2><?php echo $contestItem[0]['title'];?></h2>
	<div class="btn-group" role="group" aria-label="...">
		<a type="button" href="contest.php?cid=<?php echo $cid;?>" class="btn btn-default">Overview</a>
		<a type="button" href="contest_problemset.php?cid=<?php echo $cid;?>" class="btn btn-default">Problem List</a>
		<button type="button" class="btn btn-default">Status</button>
		<button type="button" class="btn btn-default">Ranklist</button>
	</div>
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
			<span class="sr-only">60% Complete</span>
		</div>
	</div>
	<br/>
</div>