<div id="contestHeading" class="text-center">
	<h2><?php echo $ALPHABET_N_NUM[$pid]." : ".$problemItem['title'];?></h2>
	<div class="btn-group" role="group" aria-label="...">
		<a type="button" href="contest.php?cid=<?php echo $cid;?>" class="btn btn-default">Overview</a>
		<a type="button" href="contest_problemset.php?cid=<?php echo $cid;?>" class="btn btn-default">Problem List</a>
		<button type="button" class="btn btn-default">Status</button>
		<a type="button" href="contest_ranklist.php?cid=<?php echo $cid;?>" class="btn btn-default">Ranklist</a>
	</div>
	<div class="progress">
		<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
			<span class="sr-only">60% Complete</span>
		</div>
	</div>
	<p class="text-center">
		时间限制:<span class="label label-primary"><?php echo $problemItem['time_limit']." Sec";?></span>
		内存限制:<span class="label label-primary"><?php echo $problemItem['memory_limit']." MiB";?></span><br/>
		提交:<span class="label label-info"><?php echo $problemItem['submit'];?></span>
		正确:<span class="label label-success"><?php echo $problemItem['accepted'];?></span>
	</p>
	<p class="text-center">
		<a id="oj-p-submit" class="btn btn-primary" href="./problemsubmit.php?pid=<?php echo $problemItem['problem_id'];?>" role="button">Submit</a>
		<a class="btn btn-primary" href="#" role="button">Status</a>
		<a class="btn btn-primary" href="#" role="button">Edit</a>
	</p>
</div>