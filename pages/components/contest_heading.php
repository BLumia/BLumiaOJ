<?php 
	// Time format
	$start_time = date("Y/m/d H:i:s",strtotime($contestItem['start_time']));
	$end_time = date("Y/m/d H:i:s",strtotime($contestItem['end_time']));

	// Check if user can taking part in this contest (private / password check)
	$contestAuthResult = false;
	$contestUsePassword = ($contestItem['password'] == '') ? false : true;
	
	// m{cid}: contest modifier, c{cid}: contest user.
	if (time()>strtotime($contestItem['end_time'])) $contestAuthResult = true;
	else {
		if (havePrivilege("CONTEST_EDITOR") || isset($_SESSION["m{$cid}"]) || isset($_SESSION["c{$cid}"])) $contestAuthResult = true;
	}
?>
<div id="contestHeading" class="text-center">
	<h2>
	<?php
		if (isset($pid) && $contestAuthResult) echo $ALPHABET_N_NUM[$pid]." : ".$problemItem['title'];
		else echo $contestItem['title'];
	?>
	</h2>
	<div class="btn-group" role="group" aria-label="...">
		<a type="button" href="contest.php?cid=<?php echo $cid;?>" class="btn btn-default"><?php echo L_OVERVIEW; ?></a>
		<a type="button" href="contest_problemset.php?cid=<?php echo $cid;?>" class="btn btn-default"><?php echo L_PROB_SET; ?></a>
		<a type="button" href="contest_status.php?cid=<?php echo $cid;?>" class="btn btn-default"><?php echo L_STATUS; ?></a>
		<a type="button" href="contest_ranklist.php?cid=<?php echo $cid;?>" class="btn btn-default"><?php echo L_RANKLIST; ?></a>
	</div>
	<div class="progress">
		<div id="bl-progress-bar" class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
			<span class="sr-only">Progress Bar</span>
		</div>
	</div>
	<?php if (isset($pid) && $contestAuthResult) { ?>
	<p class="text-center">
		<?php echo L_TIME_LIMIT;?>:<span class="label label-primary"><?php echo $problemItem['time_limit']." Sec";?></span>
		<?php echo L_MEM_LIMIT;?>:<span class="label label-primary"><?php echo $problemItem['memory_limit']." MiB";?></span><br/>
		<?php echo L_SUBMIT;?>:<span class="label label-info"><?php echo $problemItem['submit'];?></span>
		<?php echo L_JUDGE_AC;?>:<span class="label label-success"><?php echo $problemItem['accepted'];?></span>
	</p>
	<p class="text-center">
		<a id="oj-p-submit" class="btn btn-primary" href="./problemsubmit.php?pid=<?php echo $pid."&cid=".$cid;?>" role="button">Submit</a>
		<a class="btn btn-primary" href="#" role="button">Status</a>
		<?php if ($isProblemManager) { ?><a class="btn btn-primary" href="./admin/problem_editor.php?nid=<?php echo $problemItem['problem_id'];?>" role="button">Edit</a><?php } ?>
	</p>
	<?php } ?>
	<br/>
	<?php 
		if (!$contestAuthResult) require("./pages/components/contest_not_auth.php");
	?>
</div>
<script>
	function run() {	
		var offset = new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
		var start_time=new Date(new Date("<?php echo $start_time;?>").getTime()+offset).getTime();  //开始时间
		var end_time=new Date(new Date("<?php echo $end_time;?>").getTime()+offset).getTime();   //结束时间
		var cur_time=new Date(new Date().getTime()+offset);    //当前时间
		
		var delta_time= end_time - start_time;  //时间差的毫秒数
		var passed_time= cur_time - start_time;  //过去的时间的毫秒数
		var percentage = passed_time / delta_time * 100;
		
		$("div[id=bl-progress-bar]").css("width",percentage+"%");
		if (percentage<100) {
			var timer=setTimeout("run()",1000);
		} else {
			var progress_bar = document.getElementById('bl-progress-bar'); 
			progress_bar.className = 'progress-bar'; 
			$("div[id=bl-progress-bar]").css("width","100%");
			//alert("Contest Ended Nya ~");
		}
	}
	
	run();
</script>