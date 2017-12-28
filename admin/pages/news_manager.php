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
			<h1><?php echo LA_NEWS_MAN; ?> <small>Control Panel</small></h1>
		</div>
		<p class="lead">
			<?php echo LA_NEWS_HEAD;?>
		</p>
		<ul class="nav nav-pills nav-justified">
			<li><a href="./news_editor.php"><?php echo LA_ADD_NEWS;?></a></li>
			<li><a href="./broadcast_editor.php"><?php echo LA_EDIT_BROADCAST;?></a></li>
		</ul>
		<br/>
		<div>
			<table class="table table-striped">
				<thead>
					<tr>
						<th>ID</th>
						<th><?php echo L_TITLE;?></th>
						<th><?php echo L_DATE;?></th>
						<th><?php echo L_STATUS;?></th>
						<th><?php echo L_EDIT;?></th>
					</tr>
				</thead>
				<tbody>
				<?php
				$AVALIABLE_SPAN_DOM = "<span class='label label-success'>".L_AVALIABLE."</span>";
				$HIDDEN_SPAN_DOM = "<span class='label label-default'>".L_HIDDEN."</span>";
				$NORMAL_SPAN_DOM = "<span class='label label-info'>".L_NORMAL."</span>";
				$IMPORTANT_SPAN_DOM = "<span class='label label-primary'>".L_IMPORTANT."</span>";
				
				foreach($newsList as $row) {
					
					$news_defunct = $row['defunct'] == "N" ? 3 : 1;
					$text_defunct = $row['defunct'] == "N" ? $AVALIABLE_SPAN_DOM : $HIDDEN_SPAN_DOM;
					$url_defunct = "<a role='button' onclick='updateNewsState({$row['news_id']}, {$news_defunct})'>{$text_defunct}</a>"; 
					
					$news_importance = $row['importance'] == "0" ? 2 : 1;
					$text_importance = $row['importance'] == "0" ? $NORMAL_SPAN_DOM : $IMPORTANT_SPAN_DOM;
					$url_importance = "<a role='button' onclick='updateNewsState({$row['news_id']}, {$news_importance})'>{$text_importance}</a>"; 
					
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
	<div id="modal" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php echo L_SUCCESS;?></h4>
		  </div>
		  <div class="modal-body">
			<p><?php echo L_ASK_FOR_RELOAD_PAGE;?></p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Later</button>
			<button type="button" class="btn btn-primary" onclick="window.location.reload()">Reload Page</button>
		  </div>
		</div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<script>
	function updateNewsState(newsid, newstype) {
		$.ajax({
			url: "../api/news_state.php",
			method: "GET",
			data: {
				"nid": newsid,
				"do": newstype
			},
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				$("#modal").modal("show");
			},
			error: function(){
				alert('Failed.');
			}
		});
	}
	</script>
</body>
</html>