<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<script src="./sitefiles/js/md5.min.js"></script>
		<title><?php echo L_THREAD." - {$OJ_NAME}";?></title>
		<style>
span.label {
	margin-left: .3em;
}
blockquote {
	font-size: 1em;
	margin-bottom: 6px;
}
		</style>
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
					<li id="problemBreadcrumb" class="hidden"><i class="icon-file-alt"></i> <a id="probDiscussLink"><?php echo L_PROBLEM_DISCUSS;?></a></li>
					<li class="active"><i class="icon-file-alt"></i> <?php echo L_THREAD;?></li>
				</ol>
				<h3 id="threadTitle">Loading...</h3>
				<hr/>
				<div class="col-sm-9">
					<div id="replyList"></div>
					<?php if (isset($_SESSION["user_id"])) { ?>
					<form id="postReplyForm" class="form-group">
						<input type="hidden" class="form-control" name="do" value="postreply">
						<input type="hidden" class="form-control" id="tidInput" name="tid" value="<?php echo intval($_GET["tid"]);?>">
						<label for="contentInput">Reply:</label>
						<textarea class="form-control" id="contentInput" name="content" rows="4"></textarea>
					</form>
					<button class="btn btn-primary" id="doReplyBtn" style="margin: .4em 0;"><?php echo L_REPLY;?></button>
					<?php } else { ?>
					<div class="alert alert-info">
						<strong> <?php echo L_INFOLABEL;?> </strong><?php echo L_MUST_LOGIN_TO_REPLY;?>
					</div>
					<?php } ?>
				</div>
				<div class="col-sm-3">
					<?php if (havePrivilege("PAGE_EDITOR")) { ?>
					<div class="bs-callout bs-callout-info">
						<h4><?php echo L_MANAGEMENT;?></h4>
						<p><?php echo L_STICKY;?>:</p>
						<div class="btn-group" role="group">
						  <button type="button" id="btnTop0" class="btn btn-primary"><?php echo L_TOP_0;?></button>
						  <button type="button" id="btnTop1" class="btn btn-primary"><?php echo L_TOP_1;?></button>
						  <button type="button" id="btnTop2" class="btn btn-primary"><?php echo L_TOP_2;?></button>
						  <button type="button" id="btnTop3" class="btn btn-primary"><?php echo L_TOP_3;?></button>
						</div>
						<p><?php echo L_LOCK;?>:</p>
						<div class="btn-group" role="group">
						  <button type="button" id="btnLock" class="btn btn-info"><?php echo L_LOCK;?></button>
						  <button type="button" id="btnUnlock" class="btn btn-info"><?php echo L_UNLOCK;?></button>
						</div>
						<p><?php echo L_DELETE_THREAD;?>:</p>
						<button id="btnDelete" class="btn btn-warning btn-block"><?php echo L_DELETE;?></button>
					</div>
					<?php } ?>

					<div class="bs-callout bs-callout-info" id="problemSidebar">
					  <h4><?php echo L_PROBLEM;?></h4>
					  <a id="gotoProblemBtn" class="btn btn-primary btn-block"><?php echo L_GOTO_PROBLEM;?></a>
					</div>

					<div class="bs-callout bs-callout-info" id="problemSidebar">
					  <h4><?php echo L_HELP;?></h4>
					  <p><?php echo L_THREAD_HELP;?></p>
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
				  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo L_CLOSE;?></button>
				  <a type="button" class="btn btn-primary" id="btnPostSuccess"><?php echo L_OK;?></a>
				</div>
			</div>
		  </div>
		</div>
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
	function fillThreadList(data) {
		if (data.threadInfo == false) {
			$("#threadTitle").text("Thread not exist!");
		} else {
			var labelText = "";
			switch (data.threadInfo.top_level) {
				case "1": labelText = "<?php echo L_TOP_1;?>"; break;
				case "2": labelText = "<?php echo L_TOP_2;?>"; break;
				case "3": labelText = "<?php echo L_TOP_3;?>"; break;
			}
			$("#btnTop"+data.threadInfo.top_level).hide();
			var $label = $("<span>").addClass("label label-primary").text(labelText);
			$("#threadTitle").text(data.threadInfo.title).append($label);
			if (data.threadInfo.status == "1") {
				$("#threadTitle").append($("<span>").addClass("label label-info").text("<?php echo L_LOCKED;?>"));
				$("#postReplyForm").hide();
				$("#doReplyBtn").hide();
			} else {
				$("#postReplyForm").show();
				$("#doReplyBtn").show();
			}
			
			if(data.threadInfo.pid != "0") {
				$("#problemSidebar").show();
				$("#gotoProblemBtn").attr("href","problem.php?pid="+data.threadInfo.pid);
			} else {
				$("#problemSidebar").hide();
			}
		}
		
		if (data.threadInfo.pid != undefined && data.threadInfo.pid != 0) {
			$("#problemBreadcrumb").attr("class","active");
			$("#probDiscussLink").attr("href","discuss.php?pid="+data.threadInfo.pid);
		}
		
		var $tableBody = $("#replyList").empty();
		$.each(data.replies, function (index, elem) {
			var $replyBlock = $("<div>").addClass("media");
			var $replyLeftBlock = $("<div>").addClass("media-left");
			var $userContainer = $("<a>").attr('href','userinfo.php?uid='+elem.author_id);
			var $userImg = $("<img>").attr("src","https://www.gravatar.com/avatar/"+md5(elem.email)+"?d=identicon&s=64").addClass("avatar").error(function() {
				$(this).attr('src',"./api/gen_identicon.php?size=64&hash="+md5(elem.email));
				$(this).unbind('error');
			});
			var $userName = $("<div>").addClass("text-center").text(elem.author_id);
			$replyLeftBlock.append($userContainer.append($userImg).append($userName));
			
			var postContent = elem.status == 0 ? elem.content : "<div class='alert alert-info'><strong> <?php echo L_INFOLABEL;?> </strong><?php echo L_LOCKED_FOR_EDIT;?></div>";
			var $replyMainBlock = $("<div>").addClass("media-body").html(postContent);
			var $replyInfoBlock = $("<div>").addClass("pull-right text-muted").text(elem.time);
			
			$replyBlock.append($replyLeftBlock).append($replyMainBlock).append($replyInfoBlock);
			$tableBody.append($replyBlock);
		});
		
		prettyPrint();
	}
	
	function button_doReplyBtn_onClick() {
<?php if (isset($_SESSION["user_id"])) { ?>
		var $divModal = $("#dialogModel");
		$.post('./api/ajax_discuss.php', 
			$('#postReplyForm').serialize(),
			function(data, status) {
				$("#dialogTitle").text("Post success!");
				$("#dialogText").text("Would you like reload this page now?");
				$("#btnPostSuccess").unbind("click");
				$("#btnPostSuccess").show();
				$("#btnPostSuccess").click(function () {
					refreshThreadData($("#tidInput").val());
					$("#dialogModel").modal("hide");
				});
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
	
	function refreshThreadData(tid) {
		$.ajax({
			url: "./api/ajax_discuss.php",
			method: "POST",
			data: {
				"do": "replylist",
				"tid": tid
			},
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				if (data.status === 200) fillThreadList(data.result);
				else $("#threadTitle").text(data.message);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				var ret = $.parseJSON(XMLHttpRequest.responseText);
				$("#threadTitle").text(ret.message);
			}
		});
	}
	
<?php if (havePrivilege("PAGE_EDITOR")) { ?>
	function threadManagement(tid, action, level) {
		var $divModal = $("#dialogModel");
		var datas = {
			"do": "managethread",
			"tid": tid,
			"action": action
		};
		if (typeof(level) != "undefined") datas["level"] = level;
		$.ajax({
			url: "./api/ajax_discuss.php",
			method: "POST",
			data: datas,
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				$("#dialogTitle").text("Process result");
				if (data.status === 200) $("#dialogText").text("Process success!");
				else $("#dialogText").text(data.message);
				$("#btnPostSuccess").unbind("click");
				$("#btnPostSuccess").show();
				$("#btnPostSuccess").click(function () {
					refreshThreadData($("#tidInput").val());
					$("#dialogModel").modal("hide");
				});
				$divModal.modal("show");
			}
		});
	}
<?php } ?>
	
	$(document).ready(function () {
		$('#doReplyBtn').click(button_doReplyBtn_onClick);
		refreshThreadData(<?php echo intval($_GET["tid"]);?>);
		
		<?php if (havePrivilege("PAGE_EDITOR")) { ?>
		$('#btnTop0').click(function() {
			for(var i=0;i<=3;i++) $("#btnTop"+i).show();
			threadManagement($("#tidInput").val(), "sticky", 0);
		});
		$('#btnTop1').click(function() {
			for(var i=0;i<=3;i++) $("#btnTop"+i).show();
			threadManagement($("#tidInput").val(), "sticky", 1);
		});
		$('#btnTop2').click(function() {
			for(var i=0;i<=3;i++) $("#btnTop"+i).show();
			threadManagement($("#tidInput").val(), "sticky", 2);
		});
		$('#btnTop3').click(function() {
			for(var i=0;i<=3;i++) $("#btnTop"+i).show();
			threadManagement($("#tidInput").val(), "sticky", 3);
		});
		$('#btnUnlock').click(function() {
			threadManagement($("#tidInput").val(), "unlock");
		});
		$('#btnLock').click(function() {
			threadManagement($("#tidInput").val(), "lock");
		});
		$('#btnDelete').click(function() {
			$("#dialogTitle").text("Warning!");
			$("#dialogText").text("Do you REALLY want to delete this thread?");
			$("#btnPostSuccess").unbind("click");
			$("#btnPostSuccess").click(function () {
				$("#dialogModel").modal("hide");
				threadManagement($("#tidInput").val(), "delete");
			}).show();
			$("#dialogModel").modal("show");
		});
		<?php } ?>
	});
	</script>
	</body>
</html>