<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/highcharts.js"></script>
		<title><?php echo L_FORUM." - {$OJ_NAME}";?></title>
	</head>	
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
				<ol class="breadcrumb">
					<li><a href="discuss.php"><i class="icon-dashboard"></i> <?php echo L_FORUM;?></a></li>
					<?php if(isset($_GET["pid"]) && $_GET["pid"]!=0) { ?>
						<li class="active"><a href="<?php echo "discuss.php?pid={$_GET["pid"]}";?>"><i class="icon-file-alt"></i> Problem Discuss</a></li>
					<?php } ?>
					<li class="active"><i class="icon-file-alt"></i> Thread List</li>
				</ol>
				<div class="col-sm-9">
					<table id="threadList" class="table table-hover">
					<thead><tr><th>Reply</th><th width="40%">Title</th><th>Problem</th><th>Date</th><th>Last</th></tr></thead>
					<tbody></tbody>
					</table>
					<?php if (isset($_SESSION["user_id"])) { ?>
					<form id="postThreadForm" class="form-group">
						<input type="hidden" class="form-control" name="do" value="postthread">
						<label for="titleInput">Title:</label>
						<input type="text" class="form-control" id="titleInput" name="title" placeholder="Title">
						<label for="contentInput">Content:</label>
						<textarea class="form-control" id="contentInput" name="content" rows="4"></textarea>
					</form>
					<button class="btn btn-primary" id="doPostBtn" style="margin: .4em 0;">Submit</button>
					<?php } else { ?>
					<div class="alert alert-info">
						<strong> 【提示信息】 </strong>您必须登陆以发表主题。
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-3">
					<?php if(isset($_GET["pid"]) && $_GET["pid"]!=0) { ?>
					<button class="btn btn-primary btn-block">GO TO PROBLEM</button>
					<?php } ?>
					<div class="well">
						<h3>Discuss</h3>
						<button class="btn btn-primary btn-block">Post new thread</button>
					</div>
				</div>
			</div>
		</div><!--main wrapper end-->
		<div class="modal fade" tabindex="-1" role="dialog" id="dialogModel">
		  <div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				  <h4 class="modal-title" id="dialogTitle">Hey!</h4>
				</div>
				<div class="modal-body" id="dialogText"></div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				  <a type="button" class="btn btn-primary" id="btnPostSuccess">Go</a>
				</div>
			</div>
		  </div>
		</div>
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
	function fillThreadList(data) {
		var $tableBody = $("#threadList > tbody").empty();
		$.each(data, function (index, elem) {
			var $topLabel = null;
			var $lockLabel = null;
			if(elem.top_level != 0) {
				var labelText = "";
				switch (elem.top_level) {
					case "1": labelText = "<?php echo L_TOP_1;?>"; break;
					case "2": labelText = "<?php echo L_TOP_2;?>"; break;
					case "3": labelText = "<?php echo L_TOP_3;?>"; break;
				}
				$topLabel = $("<span>").addClass("text-warning").text("["+labelText+"]");
			}
			if(elem.status == 1) {
				$lockLabel = $("<span>").addClass("text-muted").text("[<?php echo L_LOCKED;?>]");
			}
			var $row = $("<tr>");
			var $replyCount = $("<td>").text(elem.count);
			var $titleLink = $("<a>").attr("href","thread.php?tid="+elem.tid).text(elem.title);
			var $title = $("<td>").append($topLabel).append($lockLabel).append($titleLink);
			var $problemLink = $("<a>").attr("href","discuss.php?pid="+elem.pid).text(elem.pid);
			if (elem.pid == 0) {
				var $problemID = $("<td>");
			} else {
				var $problemID = $("<td>").append($problemLink);
			}
			var $postData = $("<td>").text(elem.posttime);
			var $lastData = $("<td>").text(elem.lastupdate);
			$row.append($replyCount).append($title).append($problemID).append($postData).append($lastData);
			$tableBody.append($row);
		});
	}
	
	function button_doPostBtn_onClick() {
<?php if (isset($_SESSION["user_id"])) { ?>
		var $divModal = $("#dialogModel");
		
		$.post('./api/ajax_discuss.php', 
			$('#postThreadForm').serialize(),
			function(data, status) {
				$("#dialogTitle").text("Post success!");
				$("#dialogText").text("Would you like view the thread you post just now?");
				$("#btnPostSuccess").attr("href","thread.php?tid="+data.result.tid).show();
				$divModal.modal("show");
			}
		).error(function(data, status) {
			var ret = $.parseJSON(data.responseText);
			$("#dialogTitle").text("Post failed!");
			$("#dialogText").text(ret.message);
			$("#btnPostSuccess").hide();
			$divModal.modal("show");
		});
<?php } ?>
	}
	
	$(document).ready(function () {
		$('#doPostBtn').click(button_doPostBtn_onClick);
		$.ajax({
			url: "./api/ajax_discuss.php",
			method: "POST",
			data: {
				"do": "threadlist"
				<?php if ($pid != null) echo ",\"pid\": {$pid}" ?>
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
</html>
