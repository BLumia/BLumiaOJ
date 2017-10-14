<!DOCTYPE html>
<html>
<head>
	<?php require_once('../include/admin_head.inc.php'); ?>
	<title><?php echo LA_CONT_LIST." - {$OJ_NAME}";?></title>
</head>	
<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1><?php echo LA_CONT_LIST;?> <small><?php echo LA_CONT_MAN;?></small></h1>
		</div>
		<p class="lead">
			<?php echo LA_CONTLIST_HEAD;?>
		</p>
		<nav style="text-align:center;">
			<ul class="pagination">
			<?php
			// Pagination
			for ($i=1;$i<=$pageCnt;$i++){
				if ($i==$curPage) echo "<li class='active'><a href='contest_list.php?page=".$i."'>".$i."</a></li>";
				else echo "<li><a href='contest_list.php?page=".$i."'>".$i."</a></li>";
			}
			?>
			</ul>
		</nav>
		<ul class="nav nav-pills nav-justified">
			<li><a href="./contest_add.php"><?php echo LA_CONT_ADD;?></a></li>
			<li><a href="./contest_manager.php"><?php echo LA_MORE_OPTIONS;?></a></li>
		</ul>
		<br/>
		<div>
			<table class="table table-striped" method="POST" action="./contest_edit.php">
				<thead>
					<tr> 
						<th>ID</th>
						<th><?php echo L_TITLE;?></th>
						<th><?php echo L_START_TIME;?></th>
						<th><?php echo L_END_TIME;?></th>
						<th><?php echo L_STATUS;?></th>
						<th><?php echo L_EDIT;?></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$PUBLIC_SPAN_DOM = "<span class='label label-info'>".L_Public."</span>";
				$PRIVATE_SPAN_DOM = "<span class='label label-primary'>".L_Private."</span>";
				$AVALIABLE_SPAN_DOM = "<span class='label label-success'>".L_AVALIABLE."</span>";
				$HIDDEN_SPAN_DOM = "<span class='label label-default'>".L_HIDDEN."</span>";
				
				foreach($contestList as $row) {
					
					$contest_defunct = $row['defunct'] == "N" ? 3 : 1;
					$text_defunct = $row['defunct'] == "N" ? $AVALIABLE_SPAN_DOM : $HIDDEN_SPAN_DOM;
					$url_defunct = "<a href='../api/contest_state.php?cid={$row['contest_id']}&do={$contest_defunct}'>{$text_defunct}</a>"; 
					
					$contest_private = $row['private'] == "0" ? 2 : 1;
					$text_private = $row['private'] == "0" ? $PUBLIC_SPAN_DOM : $PRIVATE_SPAN_DOM;
					$url_private = "<a href='../api/contest_state.php?cid={$row['contest_id']}&do={$contest_private}'>{$text_private}</a>"; 
					echo "<tr>";
					echo "<td>".$row['contest_id']."</td>";
					echo "<td>".$row['title']."</td>";
					echo "<td>".$row['start_time']."</td>";
					echo "<td>".$row['end_time']."</td>";
					echo "<td>{$url_defunct} {$url_private}</td>";
					echo "<td><a href='./contest_editor.php?cid={$row['contest_id']}'>".L_EDIT."</a></td>";
					echo "</tr>";
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>