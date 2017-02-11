
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
		<!--[if lt IE 8]>
		<div class="row">
			<div class="alert alert-warning">
				&nbsp;您的浏览器版本实在是太低了，是时候考虑<a href="http://browsehappy.com/">换一个</a>了。 
				<del>&times;</del>
			</div>	
		</div>		
		<![endif]-->
			<div class="row">
				<div class="col-md-9">
					<table id="threadList" class="table table-hover">
					<thead><tr><th>Reply</th><th width="40%">Title</th><th>Problem</th><th>Date</th><th>Last</th></tr></thead>
					<tbody></tbody>
					</table>
				</div>
				<div class="col-md-3">
					<div class="well">
						<h3>Discuss</h3>
						<button class="btn btn-primary btn-block">Post new thread</button>
					</div>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
	function fillThreadList(data) {
		var $tableBody = $("#threadList > tbody").empty();
		$.each(data, function (index, elem) {
			var $row = $("<tr>");
			var $replyCount = $("<td>").text(elem.count);
			var $title = $("<td>").text(elem.title);
			var $problemID = $("<td>").text(elem.pid == 0 ? "" : elem.pid);
			var $postData = $("<td>").text(elem.posttime);
			var $lastData = $("<td>").text(elem.lastupdate);
			$row.append($replyCount).append($title).append($problemID).append($postData).append($lastData);
			$tableBody.append($row);
		});
	}
	
	$(document).ready(function () {
		$.ajax({
			url: "./api/ajax_discuss.php",
			method: "POST",
			data: {
				"do": "threadlist"
			},
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				if (data.status === 200)
				fillThreadList(data.result);
			}
		});
		
		
	});
	</script>
		
	</body>