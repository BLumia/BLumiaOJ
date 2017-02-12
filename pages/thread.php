
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
				<h3 style="padding-left:15px;" id="threadTitle">Title title</h3><hr/>
				<div id="replyList" class="col-sm-9"></div>
				<div class="col-sm-3">
					<div class="well">
						<h3>Discuss</h3>
						<button class="btn btn-primary btn-block">Post reply</button>
					</div>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
	function fillThreadList(data) {
		
		$("#threadTitle").text(data.threadInfo.title);
		
		var $tableBody = $("#replyList").empty();
		$.each(data.replies, function (index, elem) {
			var $replyBlock = $("<div>").addClass("media");
			var $replyLeftBlock = $("<div>").addClass("media-left media-middle");
			var $userContainer = $("<a>").attr('href','#');
			var $userImg = $("<img>").attr("src","data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNWEzMTM2ZDBjNSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1YTMxMzZkMGM1Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxNCIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=");
			var $userName = $("<div>").addClass("text-center").text(elem.author_id);
			$replyLeftBlock.append($userContainer.append($userImg).append($userName));
			
			var $replyMainBlock = $("<div>").addClass("media-body").html(elem.content);
			var $replyInfoBlock = $("<div>").addClass("pull-right text-muted").text(elem.time);
			
			$replyBlock.append($replyLeftBlock).append($replyMainBlock).append($replyInfoBlock);
			$tableBody.append($replyBlock);
		});
	}
	
	$(document).ready(function () {
		$.ajax({
			url: "./api/ajax_discuss.php",
			method: "POST",
			data: {
				"do": "replylist",
				"tid": <?php echo $_GET["tid"];?>
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