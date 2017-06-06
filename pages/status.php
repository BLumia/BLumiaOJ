<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title><?php echo L_STATUS." - {$OJ_NAME}";?></title>
		<style>
tr > td.result {
  text-align: center;
}
		</style>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="btn-group" role="group" aria-label="...">
						<a type="button" class="btn btn-default" href="status.php?top=<?php echo $prevPageTop;?>">&lt; <?php echo L_PREV_PAGE;?></a>
						<a type="button" class="btn btn-default" href="status.php?top=<?php echo $nextPageTop;?>"><?php echo L_NEXT_PAGE;?> &gt;</a>
					</div>
				</div>
				<div class="col-md-9">
					<form method="get" class="form-inline text-right">
						<div class="form-group">
							<input name="pid" value="<?php echo $problem_id;?>" type="text" class="form-control" placeholder="<?php echo L_PROB_ID;?>">
							<input name="uid" value="<?php echo $user_id;?>" type="text" class="form-control" placeholder="<?php echo L_UID;?>">
							<select name="language" class="form-control">
								<option value="-1">==<?php echo L_LANG;?>==</option>
								<?php
								$lang=(~((int)$langmask))&((1<<($lang_count))-1);
								for($i=0;$i<$lang_count;$i++) {
									$selected_attr = ($language == $i) ? "selected" : "";
									if($lang&(1<<$i))
										echo "<option value='{$i}' {$selected_attr}>{$LANGUAGE_NAME[$i]}</option>";
								}
								?>
							</select>
							<select name="judgeresult" class="form-control">
								<option value="-1">==<?php echo L_RESULT;?>==</option>
								<?php 
								$i=0;
								foreach($JUDGE_RESULT as $row) {
									$selected_attr = ($result == $i) ? "selected" : "";
									echo "<option value='{$i}' {$selected_attr}>{$row}</option>";
									$i++;
								}
								?>
							</select>
						</div>
						<button type="submit" class="btn btn-default"><?php echo L_FIND;?></button>
					</form>
				</div><!-- /.col-md-9 -->
			</div><!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-hover" id="tableID">
						<thead>
							<tr>
								<th width="8%"><?php echo L_RUN_ID;?></th>
								<th width="14%"><?php echo L_UID;?></th>
								<th width="10%"><?php echo L_PROB_ID;?></th>
								<th width="18%" style="text-align: center;"><?php echo L_RESULT;?></th>
								<th width="8%"><?php echo L_MEMORY;?></th>
								<th width="8%"><?php echo L_TIME_COST;?></th>
								<th width="12%"><?php echo L_COMPILER;?></th>
								<th width="8%"><?php echo L_LENGHT;?></th>
								<th width="14%"><?php echo L_SUBMIT_TIME;?></th>
							</tr>
						</thead>
						<tbody id="oj-statue-list">
						<?php 
						foreach($statusResult as $row) { 
							$passRate = "";
							if (isset($row['pass_rate'])) {
								if($row['result']!=4 && $row['pass_rate']>0 && $row['pass_rate']<0.98) {
									$rate = 100 - $row['pass_rate'] * 100;
									$passRate = "<span class='label label-warning'>{$rate}%</span>";
								}	
							}
							$resUrl = "<span class='label label-{$JUDGE_ROW_CSS_CLASS[$row['result']]}'>{$JUDGE_RESULT[$row['result']]}</span>{$passRate}";
							if (havePrivilege("SOURCE_VIEWER") || (isset($_SESSION['user_id']) && $_SESSION['user_id']==$row['user_id']) ) {
								$codeUrl = "<a href='./source_view.php?id={$row['solution_id']}'>{$LANGUAGE_NAME[$row['language']]}</a> | <a href='./problemsubmit.php?sid={$row['solution_id']}&pid={$row['problem_id']}'>".L_EDIT."</a>"; 
								if($row['result'] == 6 && $SOLUTION_WA_INFO) {
									$resUrl = "<i class='fa fa-question-circle'></i><a href='./error_view.php?id={$row['solution_id']}&type=6'>{$resUrl}</a><i class='fa fa-question-circle'></i>";
								} 
								if($row['result'] == 11) {
									$resUrl = "<i class='fa fa-question-circle'></i><a href='./error_view.php?id={$row['solution_id']}&type=11'>{$resUrl}</a><i class='fa fa-question-circle'></i>";
								} 
							} else {
								$codeUrl = "{$LANGUAGE_NAME[$row['language']]}"; 
							}
						?>
							<tr <?php echo "class='{$JUDGE_ROW_CSS_CLASS[$row['result']]}' data-sid='{$row['solution_id']}'"; ?>>
								<td class="solution_id"><?php echo $row['solution_id']; ?></td>
								<td><?php echo "<a href='./userinfo.php?uid={$row['user_id']}'>{$row['user_id']}</a>";?></td>
								<td><?php echo "<a href='./problem.php?pid={$row['problem_id']}'>{$row['problem_id']}</a>";?></td>
								<td class="result"><?php echo $resUrl; ?></td>
								<td><?php echo $row['memory']; ?></td>
								<td><?php echo $row['time']; ?></td>
								<td><?php echo $codeUrl; ?></td>
								<td><?php echo $row['code_length']; ?></td>
								<td><?php echo $row['in_date']; ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div><!--main wrapper end-->
<?php if (havePrivilege("JUDGER")) { ?>
		<div class="modal fade" tabindex="-1" role="dialog" id="dialogModel">
		  <div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				  <h4 class="modal-title" id="dialogTitle">Admin Judge!</h4>
				</div>
				<form id="adminJudgeForm" class="form-group">
				<div class="modal-body" id="dialogText">
					<input type="hidden" name="manual" value="manual">
					<label for="sidInput"><?php echo L_RUN_ID; ?></label>
					<input type="text" class="form-control" id="sidInput" name="sid" value="Loading"><br/>
					<label for="resultInput"><?php echo L_RESULT; ?></label>
					<select id="resultInput" class="form-control" length="4" name="result">
						<option value="4"><?php echo L_JUDGE_AC; ?></option>
						<option value="6"><?php echo L_JUDGE_WA; ?></option>
					</select><br/>
					<label for="contentInput"><?php echo L_JUDGE_REASON; ?></label>
					<textarea class="form-control" id="contentInput" name="explain" rows="4"></textarea>
				</div>
				</form>
				<div class="modal-footer">
					<button class="btn btn-default" data-dismiss="modal"><?php echo L_CLOSE;?></button>
					<button class="btn btn-warning" id="formSubmitBtn"/><?php echo L_SUBMIT;?></button>
				</div>
				
			</div>
		  </div>
		</div>
<?php } ?>
		<?php require("./pages/components/footer.php");?>
	</body>
<?php if (havePrivilege("JUDGER")) { ?>
<script>
	$(".solution_id").click(function(){
		$("#sidInput").val($(this).parent().attr("data-sid"));
		$("#dialogModel").modal("show");
	});
	$("#formSubmitBtn").click(function(){
		console.log($('#adminJudgeForm').serialize());
		$.post('./admin/problem_judge.php', 
			$('#adminJudgeForm').serialize(),
			function(data, status) {
				//console.log(data);
				alert("Success, press F5 to refresh page.");
				$("#dialogModel").modal("hide");
			}
		).error(function(err) {
			alert(err.responseText);
			//console.log(err.responseText);
		});
	})
</script>
<?php } ?>
</html>