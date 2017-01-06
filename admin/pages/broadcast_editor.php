<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Broadcast Management <small>Announcement Editor</small></h1>
		</div>
		<p class="lead">
			<?php echo $page_helper;?>
		</p>
		<form method="POST" class="form-horizontal">
			<label>Announcement Content:</label>
			<textarea class="summernote" placeholder="Enter Announcement Content" name="broadcast_content"><?php echo $OJ_ANNOUNCEMENT;?></textarea>
			<br/>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
<script>
$(document).ready(function() {
	$('.summernote').summernote({
		height: 120,  
		focus : true
	});
});
//var sHTML = $('#summernote').code();
</script>
</body>