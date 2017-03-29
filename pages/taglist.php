<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title><?php echo L_TAGLIST." - {$OJ_NAME}";?></title>
		<style>
.taglist {
	padding: .1em 1em;
}
.taglist * {
	font-size: medium;
}
.taglist span {
	margin-right: .4em;
}
.taglist a {
	margin-left: .4em;
}
#tag-0-sublist {
	padding: .1em 0em;
}
		</style>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="taglist" id="tag-0-sublist">Loading...</div>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	<script type="text/javascript">
	function fillTagSubList(tagid, data) {
		var $tagSubContainer = $("#tag-"+tagid+"-sublist").empty();
		$.each(data, function (index, elem) {
			var $tagContent = $("<div>").addClass("taglist").attr('id','tag-'+elem.tag_id+'-content');
			var $tagSubListContainer = $("<div>").addClass("taglist").attr('id','tag-'+elem.tag_id+'-sublist');
			
			var $tagNameSpan = $("<span>").addClass("label label-primary").text(elem.tag_name);
			var $tagProblemListA = $("<a>").attr('href', '#').attr('data-tagid', elem.tag_id).text("[See Problems]");
			var $tagFetchSubListA = $("<a>").attr('href', '#').attr('data-tagid', elem.tag_id).text("[Fetch SubTags]");
			$tagContent.append($tagNameSpan).append(elem.tag_desc).append($tagProblemListA).append($tagFetchSubListA);
			
			$tagFetchSubListA.click(tag_fetchSub_onClick);
			
			
			$tagSubContainer.append($tagContent).append($tagSubListContainer);
		});
	}
	
	function tag_fetchSub_onClick() {
		var $caller = $(this);
		var tagID = Number($caller.attr('data-tagid'));
		fetchSubList(tagID);
	}
	
	function fetchSubList(tagid) {
		// check if this dom node is exist or not
		$.ajax({
			url: "./api/ajax_taglist.php",
			method: "POST",
			data: {
				"do": "sublist",
				"parent": tagid
			},
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				if (data.status === 200) fillTagSubList(tagid, data.result);
			}
		});
	}
	
	$(document).ready(function () {
		$.ajax({
			url: "./api/ajax_taglist.php",
			method: "POST",
			data: {
				"do": "list"
			},
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				if (data.status === 200) fillTagSubList(0, data.result);
			}
		});
	});
	</script>
	</body>
</html>