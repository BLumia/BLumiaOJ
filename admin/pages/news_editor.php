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
			<h1><?php echo LA_NEWS_MAN;?> <small>News Editor</small></h1>
		</div>
		<p class="lead">
			<?php echo $page_helper;?>
		</p>
		<form method="POST" class="form-horizontal" action="../api/news_editor.php">
		    <label><?php echo L_TITLE;?>:</label>
			<input type="text" class="form-control" name="news_title" placeholder="Enter News Title" value="<?php echo $NEWS_TITLE;?>">
			<label><?php echo L_CONTENT;?>:</label>
			<textarea class="summernote" placeholder="Enter News Content" name="news_content"><?php echo $NEWS_CONTENT;?></textarea>
			<br/>
			<input type="hidden" name="nid" value="<?php echo $NEWS_NID;?>" readonly>
			<button type="submit" class="btn btn-primary"><?php echo L_SUBMIT;?></button>
		</form>
	</div>
<script>
$(document).ready(function() {
	$('.summernote').summernote({
		height: 120,
		onImageUpload: function(files) {
			var $curSummernote = $(this);
			var formData = new FormData();
			formData.append('file',files[0]);
			$.ajax({
				url : '../api/pic_upload.php',
				type : 'POST',
				data : formData,
				processData : false,
				contentType : false,
				success : function(data) {
					$curSummernote.summernote('insertImage',data,'img');
				}
			});
		}
	});
});
</script>
</body>
</html>