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
							<input name="pid" value="<?php echo $problem_id;?>" type="text" class="form-control" placeholder="题目编号">
							<input name="uid" value="<?php echo $user_id;?>" type="text" class="form-control" placeholder="用户名">
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
						<button type="submit" class="btn btn-default">找</button>
					</form>
				</div><!-- /.col-md-6 -->
			</div><!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-hover" id="tableID">
						<thead>
							<tr>
								<th width="8%">Run ID</th>
								<th width="14%">User ID</th>
								<th width="10%">Problem ID</th>
								<th width="18%" style="text-align: center;">Result</th>
								<th width="8%">Memory</th>
								<th width="8%">Time</th>
								<th width="12%">Compiler</th>
								<th width="8%">Length</th>
								<th width="14%">Submit Time</th>
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
							<tr class="<?php echo $JUDGE_ROW_CSS_CLASS[$row['result']]; ?>">
								<td><?php echo $row['solution_id']; ?></td>
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
		<?php require("./pages/components/footer.php");?>
	</body>
</html>