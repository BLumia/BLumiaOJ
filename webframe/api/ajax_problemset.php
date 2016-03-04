<?php
	/*  
	TODO: Return Type: json/xhtml
	*/

	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_functions.inc.php");
	
	//Prepare
	$p=isset($_GET['p']) ? $_GET['p'] : 0;
	if($p<0){$p=0;}
	$front=intval($p*$PAGE_ITEMS) + 1000;
	$tail =$front + $PAGE_ITEMS;
	$curTime=strftime("%Y-%m-%d %H:%M",time());
	$isProblemManager = isset($_SESSION['administrator']);
	
	//Challenged Problems
	if(isset($_SESSION['user_id'])) {
		$sql=$pdo->prepare("SELECT `problem_id` FROM `solution` WHERE `user_id`='{$_SESSION['user_id']}' group by `problem_id`"); //All
		$sql->execute();
		$challengedList=$sql->fetchAll(PDO::FETCH_ASSOC);
		$sql=$pdo->prepare("SELECT `problem_id` FROM `solution` WHERE `user_id`='{$_SESSION['user_id']}' AND `result`=4 group by `problem_id`"); //Accepted
		$sql->execute();
		$acceptedList=$sql->fetchAll(PDO::FETCH_ASSOC);
		//var_dump($acceptedList);
		
		foreach($challengedList as $row) {
			$probStatusList[$row['problem_id']] = "challenged";
		}
		foreach($acceptedList as $row) {
			$probStatusList[$row['problem_id']] = "accepted";
		}
	}
	
	//Problem list(an problem manager can see all the problems)
	$any_running_contest = "
		SELECT `problem_id` FROM `contest_problem` WHERE `contest_id` IN (
			SELECT `contest_id` FROM `contest` WHERE 
			(`end_time`>'{$curTime}' OR private=1) AND `defunct`='N'
		)";
	$common_filter = "`problem_id`>='{$front}' AND `problem_id`<'{$tail}'";
	if (!$isProblemManager) {
		$sql=$pdo->prepare("SELECT * FROM problem WHERE `defunct`='N' AND {$common_filter} AND `problem_id` NOT IN({$any_running_contest})");
	} else {
		$sql=$pdo->prepare("select * from problem WHERE {$common_filter}");// limit $front,$PAGE_ITEMS
	}
	$sql->execute();
	$problemList=$sql->fetchAll(PDO::FETCH_ASSOC);
	//$problemCount=count($problemList);
	
	//Which problem is under a running contest
	if ($isProblemManager) {
		$sql=$pdo->prepare($any_running_contest);
		$sql->execute();
		$problemUnderContestList=$sql->fetchAll(PDO::FETCH_ASSOC);
		foreach ($problemUnderContestList as $item) {
			$probIDUCList[$item['problem_id']] = "contest";
		}
	}
	
	//Finally the output
	foreach ($problemList as $row) { //problem list ------------ 
?>
	<tr>
		<?php 
			if ($row['submit'] == 0) {
				$pctText = "N/A";
				$procBarNum = 0;
				$pctNum = 0;
			} else {
				$pctNum = ($row['accepted']/$row['submit'])*100;
				$procBarNum = (1-($row['accepted']/$row['submit']))*100;
				$pctText = sprintf("%.2f%%",$pctNum);
			}
		?>
		<td>
		<?php 
			if ($row['defunct'] == 'Y') echo "<i class='fa fa-lock'></i>";
			if (isset($probIDUCList[$row['problem_id']])) echo "<i class='fa fa-clock-o'></i>";
			if (isset($probStatusList[$row['problem_id']])) {
				$thisProbState = $probStatusList[$row['problem_id']];
				switch($thisProbState) {
				case "accepted":
					echo "<i style='color: green;' class='fa fa-check'></i>";
					break;
				default:
					echo "<i style='color: yellow;' class='fa fa-dot-circle-o'></i>";
					break;
				}
			}
		?>
		</td>
		<td><?php echo $row['problem_id'];?></td>
		<td>
			<a href="problem.php?pid=<?php echo $row['problem_id'];?>"><?php echo $row['title'];?></a>
			<div class="tr-tag">
				<span>搜索</span>
			</div>
		</td>
		<td><div class="progress maxwidth150px"><div class="progress-bar" style="width:<?php echo $procBarNum;?>%;"></div></div></td>
		<td><?php echo utf8_substr($row['source'],0,14);?></td>
		<td>(<?php echo $row['accepted']." / ".$row['submit'];?>) <?php echo $pctText;?></td>
	</tr>
<?php } ?>

