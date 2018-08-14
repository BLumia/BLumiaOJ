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
				&nbsp;您的浏览器版本实在是太低了，是时候考虑<a href="https://browsehappy.com/">换一个</a>了。 
				<del>&times;</del>
			</div>	
		</div>
		<![endif]-->
		<?php if ($OJ_LARGE_CONTEST_MODE == true) { ?>
			<div class="row">
				<div class="alert alert-warning">
					&nbsp;Large contest mode enabled, discuss forum is unavaliabled for that. 
				</div>	
			</div>
		<?php } else { ?>
			<div class="row">
				<ol class="breadcrumb">
					<li><a href="discuss.php"><i class="icon-dashboard"></i> <?php echo L_FORUM;?></a></li>
					<?php if(isset($_GET["pid"]) && $_GET["pid"]!=0) { ?>
						<li class="active"><a href="<?php echo "discuss.php?pid={$_GET["pid"]}";?>"><i class="icon-file-alt"></i> <?php echo L_PROBLEM_DISCUSS;?></a></li>
					<?php } ?>
					<li class="active"><i class="icon-file-alt"></i> <?php echo L_THREADLIST;?></li>
				</ol>
				<div class="col-sm-9">
					<table id="threadList" class="table table-hover">
					<thead><tr><th><?php echo L_REPLY;?></th><th width="40%"><?php echo L_TITLE;?></th><th><?php echo L_PROBLEM;?></th><th><?php echo L_DATE;?></th><th><?php echo L_LASTREPLY;?></th></tr></thead>
					<tbody></tbody>
					</table>
					<?php if (isset($_SESSION["user_id"])) { ?>
					<form id="postThreadForm" class="form-group">
						<?php if(isset($_GET["pid"]) && $_GET["pid"]!=0) { ?>
						<input type="hidden" class="form-control" name="pid" value="<?php echo intval($_GET["pid"]);?>">
						<?php } ?>
						<input type="hidden" class="form-control" name="do" value="postthread">
						<label for="titleInput"><?php echo L_TITLE;?>:</label>
						<input type="text" class="form-control" id="titleInput" name="title" placeholder="Title">
						<label for="contentInput"><?php echo L_CONTENT;?>:</label>
						<textarea class="form-control" id="contentInput" name="content" rows="4"></textarea>
					</form>
					<button class="btn btn-primary" id="doPostBtn" style="margin: .4em 0;"><?php echo L_POST;?></button>
					<?php } else { ?>
					<div class="alert alert-info">
						<strong> <?php echo L_INFOLABEL;?> </strong><?php echo L_MUST_LOGIN_TO_POST;?>
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-3">
					<?php if(isset($_GET["pid"]) && $_GET["pid"]!=0) { ?>
					<div class="bs-callout bs-callout-info">
					  <h4><?php echo L_PROBLEM;?></h4>
					  <a href="problem.php?pid=<?php echo intval($_GET["pid"]);?>" class="btn btn-primary btn-block"><?php echo L_GOTO_PROBLEM;?></a>
					</div>
					<?php } ?>
					<?php if (isset($_SESSION["user_id"])) { ?>
					<div class="bs-callout bs-callout-info" id="problemSidebar" style="text-align:center;">
					  <img src="<?php echo L_GRAVATAR_GEN_URL.md5($user_email);?>?d=identicon&s=64" class="avatar" data-toggle="tooltip" data-placement="top" title="<?php echo L_CHANGE_AVATAR_HINT; ?>" onerror="this.src='./api/gen_identicon.php?size=64&hash=<?php echo md5($user_email);?>'">
					  <h4><?php echo $_SESSION['user_id'];?></h4>
					  <p><?php echo L_NICK.": {$_SESSION['user_name']}";?></p>
					<?php if ($FORUM_ENHAUNCEMENT) { ?>
					  <hr/>
					  <div class="dropdown">
					  <a id="aNotify" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span id="notifyLinkText">Loading...</span> <span id="notifyCnt" class="badge">0</span>
					  </a>
					  <ul id="notifylist" class="dropdown-menu" aria-labelledby="aNotify">
						<li>You dont have any unread threads.</li>
					  </ul>
					  </div>
					<?php } ?>
					</div>
					<?php } ?>
					<div class="bs-callout bs-callout-info" id="problemSidebar">
					  <h4><?php echo L_HELP;?></h4>
					  <p><?php echo L_THREAD_HELP;?></p>
					</div>
				</div>
			</div>
		<?php } ?>
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
				  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo L_CLOSE;?></button>
				  <a type="button" class="btn btn-primary" id="btnPostSuccess"><?php echo L_GO;?></a>
				</div>
			</div>
		  </div>
		</div>
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
	function doNotification(data) {
<?php if ($FORUM_ENHAUNCEMENT) { ?>
		var $notifylist = $("#notifylist").empty();
		if (typeof data === "undefined") {
			$("#notifyLinkText").text("<?php echo L_NO_UNREAD_HINT; ?>");
			$("#notifyCnt").hide();
			$notifylist.append("<li><?php echo L_NO_UNREAD_HINT; ?></li>");
			return;
		}
		$("#notifyLinkText").text("<?php echo L_UNREAD_REPLIES;?>:");
		$("#notifyCnt").text(data.length);
		$.each(data, function (index, elem) {
			var $row = $("<li>");
			var $link = $("<a>").attr("href", "thread.php?tid="+elem.tid).text(elem.title);
			$row.append($link);
			$notifylist.append($row);
		});
<?php } ?>
	}
	
	function fillThreadList(data) {
		var $tableBody = $("#threadList > tbody").empty();
		if (typeof data === "undefined") {
			$tableBody.append("<tr><td/><td><?php echo L_THREADLIST_EMPTY;?></td></tr>");
			return;
		}
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
				if (data.status === 200) fillThreadList(data.result);
			},
			error: function (e) {
				var ret = $.parseJSON(e.responseText);
				var $tableBody = $("#threadList > tbody").empty();
				$tableBody.append("<tr><td/><td>" + ret.message + "</td></tr>");
				return;
			}
		});
		$('[data-toggle="tooltip"]').tooltip();
<?php if ($FORUM_ENHAUNCEMENT && isset($_SESSION['user_id'])) { ?>
		$.ajax({
			url: "./api/ajax_discuss.php",
			method: "POST",
			data: {
				"do": "notifylist"
			},
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				if (data.status === 200) doNotification(data.result);
			}
		});
<?php } ?>
	});
	</script>
	</body>
</html>
