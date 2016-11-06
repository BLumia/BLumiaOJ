<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Contest Management <small>Edit Contest</small></h1>
		</div>
		<p class="lead">
			<?php echo $page_helper;?>
		</p>
		<form method="POST" class="form-horizontal" action="../api/contest_mod.php">
		    <label>Contest Title:</label>
			<input type="text" class="form-control" name="contest_title" placeholder="Enter Contest Title" value="<?php echo $CONT_TITLE;?>"><br/>
			<label>Start Time:</label>
			<div class="row">
				<div class="col-sm-2">
					<label>Year:</label>
					<input type="text" class="form-control" name="start_year" placeholder="Year" value="<?php echo $CONT_S_TIME_Y;?>">
				</div>
				<div class="col-sm-2">
					<label>Month:</label>
					<input type="text" class="form-control" name="start_month" placeholder="Month" value="<?php echo $CONT_S_TIME_MO;?>">
				</div>
				<div class="col-sm-3">
					<label>Day:</label>
					<input type="text" class="form-control" name="start_day" placeholder="Day" value="<?php echo $CONT_S_TIME_D;?>">
				</div>
				<div class="col-sm-3">
					<label>Hour:</label>
					<input type="text" class="form-control" name="start_hour" placeholder="Hour" value="<?php echo $CONT_S_TIME_H;?>">
				</div>
				<div class="col-sm-2">
					<label>Minute:</label>
					<input type="text" class="form-control" name="start_minute" placeholder="Minute" value="<?php echo $CONT_S_TIME_MI;?>">
				</div>
			</div>
			<br/>
			<label>End Time:</label>
			<div class="row">
				<div class="col-sm-2">
					<label>Year:</label>
					<input type="text" class="form-control" name="end_year" placeholder="Year" value="<?php echo $CONT_E_TIME_Y;?>">
				</div>
				<div class="col-sm-2">
					<label>Month:</label>
					<input type="text" class="form-control" name="end_month" placeholder="Month" value="<?php echo $CONT_E_TIME_MO;?>">
				</div>
				<div class="col-sm-3">
					<label>Day:</label>
					<input type="text" class="form-control" name="end_day" placeholder="Day" value="<?php echo $CONT_E_TIME_D;?>">
				</div>
				<div class="col-sm-3">
					<label>Hour:</label>
					<input type="text" class="form-control" name="end_hour" placeholder="Hour" value="<?php echo $CONT_E_TIME_H;?>">
				</div>
				<div class="col-sm-2">
					<label>Minute:</label>
					<input type="text" class="form-control" name="end_minute" placeholder="Minute" value="<?php echo $CONT_E_TIME_MI;?>">
				</div>
			</div>
			<br/>
			<label>权限和语言:</label>
			<div class="row">
				<div class="col-sm-8">
				<label>Languages:</label>
				<select name="language[]" id="id_select" class="selectpicker" multiple data-width="100%">
					<?php
					$lang=(~((int)$langmask))&((1<<($lang_count))-1);
					for($i=0;$i<$lang_count;$i++){
						if($lang&(1<<$i))
							echo "<option value=$i selected>".$LANGUAGE_NAME[$i]."</option>";
						else
							echo "<option value=$i >".$LANGUAGE_NAME[$i]."</option>";
					}
					?>
				</select>
				</div>
				<div class="col-sm-4">
				<label>Permission:</label>
				<select name="permission" class="selectpicker" data-width="100%">
					<option value=1 <?php if ($CONT_PERMISSION==1) echo "selected='selected'";?>>Private / Password</option>
					<option value=0 <?php if ($CONT_PERMISSION==0) echo "selected='selected'";?>>Public</option>
				</select>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-sm-8">
					<label>Description:</label>
					<textarea class="summernote" name="contest_desc"><?php echo $CONT_DESC;?></textarea>
				</div>
				<div class="col-sm-4">
					<label>User List (if Private):</label>
					<textarea class="form-control" rows="6" name="userlist" placeholder="Paste the User List here if contest type is Private"><?php echo $CONT_USERLIST;?></textarea>
					<br/>
					<label>Password (if Password needed):</label>
					<input type="text" class="form-control" name="cont_password" placeholder="if Passowrd needed" value="<?php echo $CONT_PASSWORD;?>">
				</div>
			</div>
			<br/>
			<label>Problem List:</label>
			<input type="text" class="form-control" name="problem_list" placeholder="Enter Problem ID Here, seperate with a comma punctuation. e.g. 1000,1001" value="<?php echo $CONT_PROBLEMS;?>"><br/>
			<?php require("../include/pageauth_post.php"); ?>
			<input type="hidden" name="contest_id" value="<?php echo $cid;?>" readonly>
			<br/>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
		<p class="lead">
			TODO: We NEED a tag system here.
		</p>
	</div>
<script>
//select data-live-search="true" to enable live search.

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