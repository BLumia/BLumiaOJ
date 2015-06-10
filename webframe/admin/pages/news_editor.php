<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>News Management <small>News Editor</small></h1>
		</div>
		<p class="lead">
			<?php echo $page_helper;?>
		</p>
		<form method="POST" class="form-horizontal" action="../api/news_editor.php">
		    <label>News Title:</label>
			<input type="text" class="form-control" name="news_title" placeholder="Enter News Title" value="<?php echo $NEWS_TITLE;?>">
			<label>Content:</label>
			<textarea class="summernote" placeholder="Enter News Content" name="news_content"><?php echo $NEWS_CONTENT;?></textarea>
			<br/>
			<input type="hidden" name="nid" value="<?php echo $NEWS_NID;?>" readonly>
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