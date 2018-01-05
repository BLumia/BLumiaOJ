<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<link rel="stylesheet" href="./sitefiles/codemirror/codemirror.css">
		<script src="./sitefiles/codemirror/codemirror.js"></script>
		<script src="./sitefiles/codemirror/mode/javascript/javascript.js"></script>
		<title><?php echo L_CODE_SUBMIT." - {$OJ_NAME}";?></title>
		<style>
.CodeMirror {
	border-style: solid;
	border-width: 2px;
	border-color: rgba(76, 5, 247, 0.3);
}
		</style>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<h1 class="text-center">
			<?php 
				if ($contest_id) echo "Contest {$contest_id} : Problem {$ALPHABET_N_NUM[$problem_id]}";
				else echo "Problem : {$problem_id}";
			?>
			</h1><br/>
			<div class="row">
				<form action="./api/problem_submit.php" method="post">
					<input type="hidden" value="<?php echo $problem_id;?>" name="pid" class="form-control" readonly />
					<?php 
					if ($contest_id) echo "<input type='hidden' value='{$contest_id}' name='cid' class='form-control' readonly />";
					?>
					<div class="col-md-12 col-sm-12">
						<div class="row">
							<div class="col-md-4 col-sm-12">
								<div class="input-group">
									<div class="input-group-addon"><?php echo L_LANG;?></div>
									<select class="form-control" id="language" name="language">
									<?php
										for($i=0;$i<$lang_count;$i++){
											if($lang&(1<<$i))
											echo "<option value=$i ".($lastlang==$i?"selected":"").">".$LANGUAGE_NAME[$i]."</option>";
										}
									?>
									</select>
								</div>
							</div>
							<div class="col-md-4 hidden-sm text-center">

							</div>
							<div class="col-md-4 text-right">
								<button type="submit" class="btn btn-primary btn-block"><?php echo L_SUBMIT;?></button>
							</div>
						</div>
					</div>
					
					<div class="col-md-12 col-sm-12">
						<br/>
						<textarea style="display: none;" id="source" name="source"><?php if($can_edit) echo $code_src;?></textarea>
					</div>
				</form>
			</div>
			<!--
			<br/>
			<div class="row">
				<div class="col-md-6">
					Test In:
					<textarea class="form-control" rows="5">
					</textarea>
				</div>
				<div class="col-md-6">
					Test Out:
					<textarea class="form-control" rows="5">
					</textarea>
				</div>
			</div>
			-->
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
	var editor = CodeMirror.fromTextArea(document.getElementById("source"), {
		lineNumbers: true,
        matchBrackets: true,
        mode: "text/x-csrc"
	});
	</script>
	</body>
</html>