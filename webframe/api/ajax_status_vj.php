<?php
	/*  ***UNFINISHED***  */

	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	
	//Prepare
	$p=isset($_GET['p']) ? $_GET['p'] : 0;
	if($p<0){$p=0;}
	$front=intval($p*$PAGE_ITEMS);
	
	$sql=$pdo->prepare("SELECT * FROM VJ_Solution order by runid desc limit $front,$PAGE_ITEMS");
	$sql->execute();
	$statusList=$sql->fetchAll();
	$statusCount=count($statusList);
	
	for($i=0;$i<$statusCount;$i++) { //
?>
	<tr>
	<?php 
		$lang =  "N/A";
		$label_css = "default";
		switch ($statusList[$i]['lang']) {
			case 1: $lang = "GCC"; break;
			default:$lang = "N/A";
		}
		switch ($statusList[$i]['status']) {
			case "Accepted": $label_css = "success"; break;
			default:$label_css = "default";
		}
	?>
		<td><?php echo $statusList[$i]['runid']; ?></td>
		<td><?php echo $statusList[$i]['user_id']; ?></td>
		<td><a href="#"><?php echo $statusList[$i]['pid']; ?></a></td>
		<td><span class="label label-<?php echo $label_css; ?>"><?php echo $statusList[$i]['status']; ?></span></td>
		<td>768</td>
		<td>0</td>
		<td><?php echo $lang; ?></td>
		<td>61</td>
		<td>2015/4/18 00:37:57</td>
	</tr>
<?php } ?>