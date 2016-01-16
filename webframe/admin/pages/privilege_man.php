<body>
	<?php 
	require('./pages/components/offcanvas.php');
	require('../include/pageauth_get.php');
	?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Privilege Management <small>Control Panel</small></h1>
		</div>
		<p class="lead">
			您可以从这里开始进行权限的管理。
		</p>
		<nav style="text-align:center;">
			<ul class="pagination">
			<?php
			// Pagination
			/*
			for ($i=1;$i<=$pageCnt;$i++){
				if ($i==$curPage) echo "<li class='active'><a href='privilege_list.php?page=".$i."'>".$i."</a></li>";
				else echo "<li><a href='privilege_list.php?page=".$i."'>".$i."</a></li>";
			}*/
			?>
			</ul>
		</nav>
		<ul class="nav nav-pills nav-justified">
			<li><a href="./privilege_add.php">Add a Operator</a></li>
			<?php 
			$moreUrl = isset($_GET['more'])?"./privilege_manager.php":"./privilege_manager.php?more=1";
			$moreText= isset($_GET['more'])?"Dump Full List":"Show Original List";
			echo "<li><a href='{$moreUrl}'>{$moreText}</a></li>";
			?>
		</ul>
		<br/>
		<div>
			<table class="table table-striped" method="POST" action="./contest_edit.php">
				<thead>
					<tr> 
						<th>User ID</th>
						<th>Privilege</th>
						<th>Status</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($opList as $row) {
					
					$op_defunct = $row['defunct'] == "N" ? 3 : 1;
					$text_defunct = $row['defunct'] == "N" ? "<span class='label label-success'>Avalible</span>" : "<span class='label label-default'>Hidden</span>";
					/*
					$url_defunct = "<a href='../api/contest_state.php?cid={$row['contest_id']}&do={$contest_defunct}'>{$text_defunct}</a>"; 
					
					$contest_private = $row['private'] == "0" ? 2 : 1;
					$text_private = $row['private'] == "0" ? "<span class='label label-info'>Public</span>" : "<span class='label label-primary'>Private</span>";
					$url_private = "<a href='../api/contest_state.php?cid={$row['contest_id']}&do={$contest_private}'>{$text_private}</a>"; 
					*/
					echo "<tr>";
					echo "<td>".$row['user_id']."</td>";
					echo "<td>".$row['rightstr']."</td>";
					echo "<td>{$text_defunct}</td>";
					echo "<td><a href='../api/privilege_mod.php?uid={$row['user_id']}&privilege={$row['rightstr']}&getKey={$_SESSION['SessionAuth']}'>Delete</a></td>";
					echo "</tr>";
					//var_dump($row);
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</body>