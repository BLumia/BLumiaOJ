<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Problem Management <small>Add Problem</small></h1>
		</div>
		<p class="lead">
			Maybe you need some help?
		</p>
		<form method="POST" class="form-horizontal">
		    <label>Problem Title:</label>
			<input type="text" class="form-control" id="problem_title" placeholder="Enter Problem Title">
			<div class="row">
				<div class="col-sm-6">
					<label>Time Limit:</label>
					<input type="text" class="form-control" id="time_limit" placeholder="Time Limit (s)">
				</div>
				<div class="col-sm-6">
					<label>Memory Limit:</label>
					<input type="text" class="form-control" id="memory_limit" placeholder="Memory Limit (MB)">
				</div>
			</div>
			<label>Description:</label>
			<div class="summernote">Problem Description Placed at here, we recommended that please do <b>not</b> use PRE label since it was did by OJ's problem display system.</div>
			<label>Input:</label>
			<div class="summernote">Input Description Placed at here, we recommended that please do <b>not</b> use PRE label since it was did by OJ's problem display system.</div>
			<label>Output:</label>
			<div class="summernote">Output Description Placed at here, we recommended that please do <b>not</b> use PRE label since it was did by OJ's problem display system.</div>
			<div class="row">
				<div class="col-sm-6">
					<label>Sample Input:</label>
					<textarea class="form-control" rows="5" placeholder="Input Data Here"></textarea>
				</div>
				<div class="col-sm-6">
					<label>Sample Output:</label>
					<textarea class="form-control" rows="5" placeholder="Output Data Here"></textarea>
				</div>
			</div>
			<p>The Sample Input / Output will display in a problem description, <em>but Test Input / Output will not.</em></p>
			<div class="row">
				<div class="col-sm-6">
					<label>Test Input:</label>
					<textarea class="form-control" rows="5" placeholder="Test Input Data Here"></textarea>
				</div>
				<div class="col-sm-6">
					<label>Test Output:</label>
					<textarea class="form-control" rows="5" placeholder="Test Output Data Here"></textarea>
				</div>
			</div>
			<label>Hint:</label>
			<textarea class="form-control" rows="3" placeholder="Leave blank if don't need. You can use html labels in a hint"></textarea>
			<label>Special Judge:</label>
			<label class="radio-inline">
				<input type="radio" name="problem_spj" id="inlineRadio1" value="0" checked> No
			</label>
			<label class="radio-inline">
				<input type="radio" name="problem_spj" id="inlineRadio2" value="1"> Yes
			</label><br/>
			<label>Source:</label>
			<textarea class="form-control" rows="1" placeholder="Source"></textarea><br/>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<p class="lead">
			TODO: We NEED a tag system here.
		</p>
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