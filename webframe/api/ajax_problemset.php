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
	$front=intval($p*$PAGE_ITEMS);
	
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
	
	
	$sql=$pdo->prepare("select * from problem limit $front,$PAGE_ITEMS");
	$sql->execute();
	$problemList=$sql->fetchAll(PDO::FETCH_ASSOC);
	$problemCount=count($problemList);
	
	for($i=0;$i<$problemCount;$i++) { //problem list ------------ 
?>
	<tr>
		<?php 
			if ($problemList[$i]['submit'] == 0) {
				$pctText = "N/A";
				$procBarNum = 0;
				$pctNum = 0;
			} else {
				$pctNum = ($problemList[$i]['accepted']/$problemList[$i]['submit'])*100;
				$procBarNum = (1-($problemList[$i]['accepted']/$problemList[$i]['submit']))*100;
				$pctText = sprintf("%.2f%%",$pctNum);
			}
		?>
		<td>
		<?php 
			if (isset($probStatusList[$problemList[$i]['problem_id']])) {
				$thisProbState = $probStatusList[$problemList[$i]['problem_id']];
				if ($thisProbState="accepted") {
					echo "<i style='color: green;' class='fa fa-check'></i>";
				} else {
					echo "<i style='color: yellow;' class='fa fa-dot-circle-o'></i>";
				}
			}
		?>
		</td>
		<td><?php echo $problemList[$i]['problem_id'];?></td>
		<td>
			<a href="problem.php?pid=<?php echo $problemList[$i]['problem_id'];?>"><?php echo $problemList[$i]['title'];?></a>
			<div class="tr-tag">
				<span>搜索</span>
			</div>
		</td>
		<td><div class="progress width150px"><div class="progress-bar" style="width:<?php echo $procBarNum;?>%;"></div></div></td>
		<td><?php echo utf8_substr($problemList[$i]['source'],0,14);?></td>
		<td>(<?php echo $problemList[$i]['accepted']." / ".$problemList[$i]['submit'];?>) <?php echo $pctText;?></td>
	</tr>
<?php } ?>

