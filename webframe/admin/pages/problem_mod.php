<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Problem Management <small>Edit Problem</small></h1>
		</div>
		<p class="lead">
			<?php echo $page_helper;?>
		</p>
		<form method="POST" class="form-horizontal" action="../api/problem_add.php">
		    <label>Problem Title:</label>
			<input type="text" class="form-control" name="problem_title" placeholder="Enter Problem Title" value="<?php echo $PROB_TITLE;?>">
			<div class="row">
				<div class="col-sm-6">
					<label>Time Limit:</label>
					<input type="text" class="form-control" name="time_limit" placeholder="Time Limit (s)" value="<?php echo $PROB_TIME;?>">
				</div>
				<div class="col-sm-6">
					<label>Memory Limit:</label>
					<input type="text" class="form-control" name="memory_limit" placeholder="Memory Limit (MB)" value="<?php echo $PROB_MEMORY;?>">
				</div>
			</div>
			<label>Description:</label>
			<textarea class="summernote" name="problem_desc"><?php echo $PROB_DESC;?></textarea>
			<label>Input:</label>
			<textarea class="summernote" name="problem_input"><?php echo $PROB_INPUT;?></textarea>
			<label>Output:</label>
			<textarea class="summernote" name="problem_output"><?php echo $PROB_OUTPUT;?></textarea>
			<div class="row">
				<div class="col-sm-6">
					<label>Sample Input:</label>
					<textarea class="form-control" rows="5" name="samp_in_data" placeholder="Input Data Here"><?php echo $PROB_SAMP_IN;?></textarea>
				</div>
				<div class="col-sm-6">
					<label>Sample Output:</label>
					<textarea class="form-control" rows="5" name="samp_out_data" placeholder="Output Data Here"><?php echo $PROB_SAMP_OUT;?></textarea>
				</div>
			</div>
			<p>The Sample Input / Output will display in a problem description, <em>but Test Input / Output will not.</em></p>
			<div class="row">
				<div class="col-sm-6">
					<label>Test Input:</label>
					<textarea class="form-control" rows="5" name="test_in_data" placeholder="Test Input Data Here"><?php echo $PROB_TEST_IN;?></textarea>
				</div>
				<div class="col-sm-6">
					<label>Test Output:</label>
					<textarea class="form-control" rows="5" name="test_out_data" placeholder="Test Output Data Here"><?php echo $PROB_TEST_OUT;?></textarea>
				</div>
			</div>
			<label>Hint:</label>
			<textarea class="form-control" rows="3" name="problem_hint" placeholder="Leave blank if don't need. You can use html labels in a hint"></textarea>
			<label>Special Judge:</label>
			<label class="radio-inline">
				<input type="radio" name="problem_spj" id="inlineRadio1" value="0" checked> No
			</label>
			<label class="radio-inline">
				<input type="radio" name="problem_spj" id="inlineRadio2" value="1"> Yes
			</label><br/>
			<label>Source:</label>
			<textarea class="form-control" rows="1" name="problem_source" placeholder="Source"></textarea><br/>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<p class="lead">
			TODO: Modify a problem. Now we can only add problem.
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