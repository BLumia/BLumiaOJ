<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title><?php echo L_RANKLIST." - {$OJ_NAME}";?></title>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<?php require("./pages/components/contest_heading.php");?>
			<div class="row">
				<div class="col-md-12">
					<?php if(time()<$end_time && time()>$lock_time) { ?>
						<br/><div class="alert alert-info" role="alert"><i class="fa fa-lock" aria-hidden="true"></i> <?php echo L_RANKLIST_LOCKED;?></div>
					<?php } ?>
					<?php if ($start_time<=time()) { ?>
					<table class="table table-striped table-hover" id="tableID">
						<thead>
							<tr>
								<th width="4%"><?php echo L_RANK;?></th>
								<th width="7%"><?php echo L_UID;?></th>
								<th width="10%"><?php echo L_NICK;?></th>
								<th width="6%"><?php echo L_SOLVED;?></th>
								<th width="10%"><?php echo L_PASSRATE;?></th>
								<?php
								for ($i=0;$i<$problemCount;$i++) {
									echo "<th style='text-align: center;'><a href='#'>$ALPHABET_N_NUM[$i]</a></th>";
								}
								?>
							</tr>
						</thead>
						<tbody>
						<?php 
							$rank=1; 
							for($i=0;$i<$user_cnt;$i++) { //player/team list 
								$cur_nick=$playerArr[$i]->nick;
								$cur_name=$playerArr[$i]->user_id;
								$cur_solved=$playerArr[$i]->solved;
						?>
							<tr <?php if($cur_name==$highlightID) echo "class='info'";?>>
								<td>
								<?php
									//Rank
									if($cur_nick[0]!="*") echo $rank++;
									else echo "*";
								?>
								<td>
								<?php
									//Nick & Name
									echo "<a name=\"$cur_nick\" href='userinfo.php?uid={$cur_name}'>{$cur_name}</a>";
									echo "</td><td>";
									echo "<a name=\"$cur_nick\" href='userinfo.php?uid={$cur_name}'>{$cur_nick}</a>";
								?>
								</td>
								<td>
								<?php 
									//Solved
									echo "<a href='status.php?uid={$cur_name}&cid={$cid}'>{$cur_solved}</a>";
								?>
								</td>
								<td>
									<?php echo formatTimeLength($playerArr[$i]->time);?>
								</td>
								<?php
								for ($j=0;$j<$problemCount;$j++) {
									$cell_class="";//表格单格样式
									if (isset($playerArr[$i]->p_ac_sec[$j])&&$playerArr[$i]->p_ac_sec[$j]>0){
										$cell_class="ac";
										if($cur_name==$first_blood[$j]){
											$cell_class="firstac";
										}
									} else {
										if(isset($playerArr[$i]->p_wa_num[$j])&&$playerArr[$i]->p_wa_num[$j]>0) {
											$cell_class="fail";
										}
									}
									echo "<td class='$cell_class' align='center'>";
									if(isset($playerArr[$i])){
										if (isset($playerArr[$i]->p_ac_sec[$j])&&$playerArr[$i]->p_ac_sec[$j]>0) echo formatTimeLength($playerArr[$i]->p_ac_sec[$j]);
										if (isset($playerArr[$i]->p_wa_num[$j])&&$playerArr[$i]->p_wa_num[$j]>0) echo "(-".$playerArr[$i]->p_wa_num[$j].")";
									}
									echo "</td>";
								}
								?>
							</tr>
						<?php } //topic list end --------------------------------------- ?>
						</tbody>
					</table>
					<?php } ?>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		
	</body>
</html>