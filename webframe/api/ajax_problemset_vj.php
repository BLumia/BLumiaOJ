<?php
	/*  ***UNFINISHED***  */

	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	
	
	$onOJ=isset($_GET['oj']) ? $_GET['oj'] : "HDU";
	
	$p=isset($_GET['p']) ? $_GET['p'] : 0;
	if($p<0){$p=0;}
	$front=intval($p*$PAGE_ITEMS);
	
	$url="http://www.bnuoj.com/v3/ajax/problem_data.php?iDisplayStart=";
	$url=$url.$front."&iDisplayLength=25&sSearch_10=";
	$url=$url.$onOJ."&bRegex_10=false&bSearchable_10=true&bSortable_10=false";
	
	$json = @file_get_contents($url);
	
/*
http://www.bnuoj.com/v3/ajax/problem_data.php?iDisplayStart=0&iDisplayLength=25&sSearch_10=HDU&bRegex_10=false&bSearchable_10=true&bSortable_10=false
*/
	
	$result = json_decode($json, true);
	$rows = $result['aaData'];
	
	if ($rows==NULL) {
		echo "Virtual Judge系统暂时出现问题，请稍后再来吧~";
		exit(0);
	}
	
	foreach($rows as $row) { 
?>
	<tr>
		<?php 
			if ($row[5] == 0) {
				$pctText = "N/A";
				$procBarNum = 0;
				$pctNum = 0;
			} else {
				$pctNum = ($row[4]/$row[5])*100;
				$procBarNum = (1-($row[4]/$row[5]))*100;
				$pctText = sprintf("%.2f%%",$pctNum);
			}
		?>
		<td></td>
		<td><?php echo $row[1]; ?></td>
		<td>
			<a href="problem_vj.php?pid=<?php echo $row[1]; ?>"><?php echo $row[2]; ?></a>
			<div class="tr-tag">
				<span>搜索</span>
			</div>
		</td>
		<td><div class="progress width150px"><div class="progress-bar" style="width:<?php echo $procBarNum;?>%;"></div></div></td>
		<td><?php echo $row[10]."-".$row[11]; ?></td>
		<td>(<?php echo $row[4]." / ".$row[5];?>) <?php echo $pctText;?></td>
	</tr>
<?php } ?>