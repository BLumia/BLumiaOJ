<div id="contestHeading" class="text-center">
	<h1><?php echo $contestItem[0]['title'];?></h1>
	<div class="btn-group" role="group" aria-label="...">
		<button type="button" class="btn btn-default">Overview</button>
		<a type="button" href="contest_problemset.php?cid=1000" class="btn btn-default">Problem List</a>
		<button type="button" class="btn btn-default">Status</button>
		<button type="button" class="btn btn-default">Ranklist</button>
	</div>
	<?php /*比赛的开始时间结束时间性质什么的拿到overview吧，下面的分割hr改成比赛进度条*/?>
	<p class="text-center">
		开始时间:<span class="label label-primary"><?php echo $contestItem[0]['start_time'];?></span>
		截止时间:<span class="label label-primary"><?php echo $contestItem[0]['end_time'];?></span><br/>
		比赛性质:<span class="label label-info"><?php echo $contestItem[0]['private']?"Private":"Public";?></span>
		比赛状态:<span class="label label-success">Ended</span>
	</p>
	<hr/>
</div>