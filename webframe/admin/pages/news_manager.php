<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>News Management <small>Control Panel</small></h1>
		</div>
		<p class="lead">
			您可以从这里开始进行新闻的和管理。
		</p>
		<ul class="nav nav-pills nav-justified">
			<li><a href="./news_editor.php">Add News</a></li>
			<li><a href="#">Edit Broadcast</a></li>
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
					echo "<tr>";
					echo "<td>".$row['news_id']."</td>";
					echo "<td>".$row['title']."</td>";
					echo "<td>".$row['time']."</td>";
					echo "<td>".$row['defunct'].$row['importance']."</td>";
					echo "<td><a href='./news_editor.php?nid=".$row['news_id']."'>Edit</a></td>";
					echo "</tr>";
					//var_dump($row);
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</body>