
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<?php require("./pages/components/contest_heading.php");?>
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="btn-group" role="group" aria-label="...">
						<button type="button" class="btn btn-default">1</button>
						<button type="button" class="btn btn-default">2</button>
						<button type="button" class="btn btn-default">3</button>
					</div>
				</div>
			</div><!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-hover" id="tableID">
						<thead>
							<tr>
								<th width="4%">Rank</th>
								<th width="7%">ID</th>
								<th width="10%">Nick</th>
								<th width="4%">Solved</th>
								<th width="10%">Penalty</th>
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
									echo "<a name=\"$cur_nick\" href='userinfo.php?user=$cur_nick'>$cur_name</a>";
									echo "</td><td>";
									echo "<a name=\"$cur_nick\" href='userinfo.php?user=$cur_nick'>$cur_nick</a>";
								?>
								</td>
								<td>
								<?php 
									//Solved
									echo "<a href='status.php?user_id=$cur_name&cid=$cid'>$cur_solved</a>";
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
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		
	</body>