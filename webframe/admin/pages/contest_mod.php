<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Contest Management <small>Edit Contest</small></h1>
		</div>
		<p class="lead">
			<?php echo $page_helper;?>
		</p>
		<form method="POST" class="form-horizontal" action="../api/contest_add.php">
		    <label>Contest Title:</label>
			<input type="text" class="form-control" name="problem_title" placeholder="Enter Problem Title" value="<?php echo $CONT_TITLE;?>"><br/>
			<label>Start Time:</label>
			<div class="row">
				<div class="col-sm-2">
					<label>Year:</label>
					<input type="text" class="form-control" name="time_limit" placeholder="Time Limit (s)" value="<?php echo "$PROB_TIME";?>">
				</div>
				<div class="col-sm-2">
					<label>Month:</label>
					<input type="text" class="form-control" name="memory_limit" placeholder="Memory Limit (MB)" value="<?php echo "$PROB_MEMORY";?>">
				</div>
				<div class="col-sm-3">
					<label>Day:</label>
					<input type="text" class="form-control" name="memory_limit" placeholder="Memory Limit (MB)" value="<?php echo "$PROB_MEMORY";?>">
				</div>
				<div class="col-sm-3">
					<label>Hour:</label>
					<input type="text" class="form-control" name="memory_limit" placeholder="Memory Limit (MB)" value="<?php echo "$PROB_MEMORY";?>">
				</div>
				<div class="col-sm-2">
					<label>Minute:</label>
					<input type="text" class="form-control" name="memory_limit" placeholder="Memory Limit (MB)" value="<?php echo "$PROB_MEMORY";?>">
				</div>
			</div>
			<br/>
			<label>End Time:</label>
			<div class="row">
				<div class="col-sm-2">
					<label>Year:</label>
					<input type="text" class="form-control" name="time_limit" placeholder="Time Limit (s)" value="<?php echo "$PROB_TIME";?>">
				</div>
				<div class="col-sm-2">
					<label>Month:</label>
					<input type="text" class="form-control" name="memory_limit" placeholder="Memory Limit (MB)" value="<?php echo "$PROB_MEMORY";?>">
				</div>
				<div class="col-sm-3">
					<label>Day:</label>
					<input type="text" class="form-control" name="memory_limit" placeholder="Memory Limit (MB)" value="<?php echo "$PROB_MEMORY";?>">
				</div>
				<div class="col-sm-3">
					<label>Hour:</label>
					<input type="text" class="form-control" name="memory_limit" placeholder="Memory Limit (MB)" value="<?php echo "$PROB_MEMORY";?>">
				</div>
				<div class="col-sm-2">
					<label>Minute:</label>
					<input type="text" class="form-control" name="memory_limit" placeholder="Memory Limit (MB)" value="<?php echo "$PROB_MEMORY";?>">
				</div>
			</div>
			<br/>
			<label>权限和语言:</label>
			<div class="row">
				<div class="col-sm-8">
				<label>Languages:</label>
				<select id="id_select" class="selectpicker" multiple data-live-search="true" data-width="100%">
					<option>cow</option>
					<option>cat</option>
					<option class="get-class" disabled>ox</option>
					<optgroup label="test" data-subtext="another test" data-icon="icon-ok">
						<option>ASD</option>
						<option selected>Bla</option>
						<option>Ble</option>
					</optgroup>
				</select>
				</div>
				<div class="col-sm-4">
				<label>Quanxian:</label>
				<select class="selectpicker" data-width="100%">
					<option>Private</option>
					<option>Public</option>
					<option>Password</option>
				</select>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-sm-8">
					<label>Description:</label>
					<textarea class="summernote" name="problem_desc"><?php echo "$PROB_DESC";?></textarea>
				</div>
				<div class="col-sm-4">
					<label>User List (if Private):</label>
					<textarea class="form-control" rows="6" name="samp_in_data" placeholder="Input Data Here"><?php echo $PROB_SAMP_IN;?></textarea>
					<br/>
					<label>Password (if Password needed):</label>
					<input type="text" class="form-control" name="time_limit" placeholder="Time Limit (s)" value="<?php echo "$PROB_TIME";?>">
				</div>
			</div>
			<br/>
			<label>Problem List:</label>
			<input type="text" class="form-control" name="problem_title" placeholder="Enter Problem ID Here, seperate with a comma punctuation. e.g. 1000,1001" value="<?php echo $CONT_PROBLEMS;?>"><br/>
			<br/>
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
	$('.selectpicker').selectpicker();
});

//var sHTML = $('#summernote').code();
</script>
</body>