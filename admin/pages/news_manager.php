<!DOCTYPE html>
<html>
<head>
	<?php require_once('../include/admin_head.inc.php'); ?>
	<title><?php echo LA_NEWS_MAN." - {$OJ_NAME}";?></title>
</head>	
<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>News Management <small>Control Panel</small></h1>
		</div>
		<p class="lead">
			您可以从这里开始进行新闻的管理。
		</p>
		<ul class="nav nav-pills nav-justified">
			<li><a href="./news_editor.php">Add News</a></li>
			<li><a href="./broadcast_editor.php">Edit Broadcast</a></li>
		</ul>
		<br/>
		<div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
						<th>Date</th>
						<th>Status</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($newsList as $row) {
					
					$news_defunct = $row['defunct'] == "N" ? 3 : 1;
					$text_defunct = $row['defunct'] == "N" ? "<span class='label label-success'>Avalible</span>" : "<span class='label label-default'>Hidden</span>";
					$url_defunct = "<a href='../api/news_state.php?nid={$row['news_id']}&do={$news_defunct}'>{$text_defunct}</a>"; 
					
					$news_importance = $row['importance'] == "0" ? 2 : 1;
					$text_importance = $row['importance'] == "0" ? "<span class='label label-info'>Normal</span>" : "<span class='label label-primary'>Important</span>";
					$url_importance = "<a href='../api/news_state.php?nid={$row['news_id']}&do={$news_importance}'>{$text_importance}</a>"; 
					
					echo "<tr>";
					echo "<td>".$row['news_id']."</td>";
					echo "<td>".$row['title']."</td>";
					echo "<td>".$row['time']."</td>";
					echo "<td>{$url_defunct} {$url_importance}</td>";
					echo "<td><a href='./news_editor.php?nid={$row['news_id']}'>".L_EDIT."</a></td>";
					echo "</tr>";
					//var_dump($row);
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>