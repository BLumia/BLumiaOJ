<!DOCTYPE html>
<html>
<head>
	<?php require_once('../include/admin_head.inc.php'); ?>
	<title><?php echo LA_CAST_MAN." - {$OJ_NAME}";?></title>
</head>	
<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1><?php echo LA_CAST_MAN;?> <small>Announcement Editor</small></h1>
		</div>
		<p class="lead">
			<?php echo $page_helper;?>
		</p>
		<form method="POST" class="form-horizontal">
			<label>Announcement Content:</label>
			<textarea class="summernote" placeholder="Enter Announcement Content" name="broadcast_content"><?php echo $OJ_ANNOUNCEMENT;?></textarea>
			<br/>
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