<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Problem Management <small>Problem List</small></h1>
		</div>
		<p class="lead">
			您可以从这里对问题进行编辑和管理。
		</p>
		<nav style="text-align:center;">
			<ul class="pagination">
			<?php
				for($i=1;$i<=$pageCnt;$i++) {
					if ($i==$curPageNum) $pageNavBtnClass = "class='active'";
					else $pageNavBtnClass = "";
					echo "<li {$pageNavBtnClass}><a href='?p={$i}'>{$i}</a></li>";
				}
				
			?>
			</ul>
		</nav>
		<ul class="nav nav-pills nav-justified">
			<li><a href="./problem_add.php">Add Problem</a></li>
			<li><a href="./problem_manager.php">More Options</a></li>
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
				foreach($probList as $row) {
					
					$prob_defunct = $row['defunct'] == "N" ? 3 : 1;
					$text_defunct = $row['defunct'] == "N" ? "<span class='label label-success'>Avalible</span>" : "<span class='label label-default'>Hidden</span>";
					$url_defunct = "<a href='../api/prob_state.php?pid={$row['problem_id']}&do={$prob_defunct}'>{$text_defunct}</a>"; 
					
					echo "<tr>";
					echo "<td>".$row['problem_id']."</td>";
					echo "<td><a href='../problem.php?pid={$row['problem_id']}'>".$row['title']."</a></td>";
					echo "<td>".$row['in_date']."</td>";
					echo "<td>{$url_defunct}</td>";
					echo "<td><a href='./problem_editor.php?nid=".$row['problem_id']."'>Edit</a></td>";
					echo "</tr>";
					//var_dump($row);
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</body>