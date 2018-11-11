<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1><?php echo LA_CONT_EDITOR;?> <small><?php echo LA_CONT_MAN;?></small></h1>
		</div>
		<p class="lead">
			<?php echo $page_helper;?>
		</p>
		<form method="POST" class="form-horizontal" action="../api/contest_mod.php">
		    <label><?php echo L_TITLE;?>:</label>
			<input type="text" class="form-control" name="contest_title" placeholder="Enter Contest Title" value="<?php echo $CONT_TITLE;?>"><br/>
			<label><?php echo L_START_TIME;?>:</label>
			<div class="row">
				<div class="col-sm-2">
					<label><?php echo L_YEAR;?>:</label>
					<input type="text" class="form-control" name="start_year" placeholder="Year" value="<?php echo $CONT_S_TIME_Y;?>">
				</div>
				<div class="col-sm-2">
					<label><?php echo L_MONTH;?>:</label>
					<input type="text" class="form-control" name="start_month" placeholder="Month" value="<?php echo $CONT_S_TIME_MO;?>">
				</div>
				<div class="col-sm-3">
					<label><?php echo L_DAY;?>:</label>
					<input type="text" class="form-control" name="start_day" placeholder="Day" value="<?php echo $CONT_S_TIME_D;?>">
				</div>
				<div class="col-sm-3">
					<label><?php echo L_HOUR;?>:</label>
					<input type="text" class="form-control" name="start_hour" placeholder="Hour" value="<?php echo $CONT_S_TIME_H;?>">
				</div>
				<div class="col-sm-2">
					<label><?php echo L_MINUTE;?>:</label>
					<input type="text" class="form-control" name="start_minute" placeholder="Minute" value="<?php echo $CONT_S_TIME_MI;?>">
				</div>
			</div>
			<br/>
			<label><?php echo L_END_TIME;?>:</label>
			<div class="row">
				<div class="col-sm-2">
					<label><?php echo L_YEAR;?>:</label>
					<input type="text" class="form-control" name="end_year" placeholder="Year" value="<?php echo $CONT_E_TIME_Y;?>">
				</div>
				<div class="col-sm-2">
					<label><?php echo L_MONTH;?>:</label>
					<input type="text" class="form-control" name="end_month" placeholder="Month" value="<?php echo $CONT_E_TIME_MO;?>">
				</div>
				<div class="col-sm-3">
					<label><?php echo L_DAY;?>:</label>
					<input type="text" class="form-control" name="end_day" placeholder="Day" value="<?php echo $CONT_E_TIME_D;?>">
				</div>
				<div class="col-sm-3">
					<label><?php echo L_HOUR;?>:</label>
					<input type="text" class="form-control" name="end_hour" placeholder="Hour" value="<?php echo $CONT_E_TIME_H;?>">
				</div>
				<div class="col-sm-2">
					<label><?php echo L_MINUTE;?>:</label>
					<input type="text" class="form-control" name="end_minute" placeholder="Minute" value="<?php echo $CONT_E_TIME_MI;?>">
				</div>
			</div>
			<br/>
			<label><?php echo LA_PERMISSION_N_LANG;?>:</label>
			<div class="row">
				<div class="col-sm-8">
				<label><?php echo L_LANG;?>:</label>
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
					<option value=1 <?php if ($CONT_PERMISSION==1) echo "selected='selected'";?>><?php echo L_Private." / ".L_PSW;?></option>
					<option value=0 <?php if ($CONT_PERMISSION==0) echo "selected='selected'";?>><?php echo L_Public;?></option>
				</select>
				</div>
			</div>
			<br/>
			<div class="row">
				<div class="col-sm-8">
					<label><?php echo L_CONTEST_DESC;?>:</label>
					<textarea class="summernote" name="contest_desc" placeholder="Description of this content goes here. Place a zipped problemset archive download link with password is also a good idea."><?php echo $CONT_DESC;?></textarea>
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
			<label><?php echo LA_PROB_LIST;?>:</label>
			<input type="text" class="form-control" name="problem_list" placeholder="<?php echo LA_PROBLIST_HELP;?>" value="<?php echo $CONT_PROBLEMS;?>"><br/>
			<?php require("../include/pageauth_post.php"); ?>
			<input type="hidden" name="contest_id" value="<?php echo $cid;?>" readonly>
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
	$('.selectpicker').selectpicker();
});
</script>
</body>