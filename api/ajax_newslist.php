<?php
	/*  Using this kind of ajax is ugly, we should migrate it to `ajax_newsinfo.php` later  */

	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	
	//Prepare
	$show=isset($_GET['show']) ? intval($_GET['show']) : 1;
	if($show<1){$show=1;}
	
	$sql=$pdo->prepare("SELECT * FROM `news` WHERE `defunct`!='Y'");
	$sql->execute();
	$totalCount=count($sql->fetchAll(PDO::FETCH_ASSOC));
	
	$sql=$pdo->prepare("SELECT * FROM `news` WHERE `defunct`!='Y' 
						ORDER BY `importance` DESC,`time` DESC LIMIT $show");
	$sql->execute();
	$newsList=$sql->fetchAll(PDO::FETCH_ASSOC);
	$newsCount=count($newsList);
	if ($newsCount==0) {
		//var_dump($newsList);
		echo "<div class='alert alert-info'>No News</div>";//no news msg
		exit(0);
	}
	
	for($i=0;$i<$newsCount;$i++) { 
		if ($i==0) $newsClass = "alert alert-success";
		else $newsClass = "alert alert-info";
		
		if ($newsList[$i]['importance'] != 0) {
			$titleSBlock = "<h4><b>";
			$titleEBlock = " <span class='label label-primary'>".L_IMPORTANT."</span></b></h4><hr/> ";
		} else {
			$titleSBlock = "<h4>";
			$titleEBlock = "</h4><hr/> ";
		}
	?>
	<div class="<?php echo $newsClass;?>">
		<?php
			echo $titleSBlock.$newsList[$i]['title'].$titleEBlock;
			echo $newsList[$i]['content']."<br/><br/>";
			echo $newsList[$i]['time']." - ".$newsList[$i]['user_id'];
		?>
	</div>
<?php } 
	if ($totalCount > $newsCount) { 
?>
	<br/>
		<a class="btn btn-default" id="morebtn" onclick="loadnews(<?php echo $totalCount;?>)">Load More News</a>
	<br/>
<?php } ?>