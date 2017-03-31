<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title><?php echo L_PROB_SET." - {$OJ_NAME}";?></title>
	</head>	
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="btn-group" role="group" id="oj-ps-pager">
						Loading...
					</div>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
					<form method="get" action="./problem.php">
					<div class="input-group">
						<input type="text" class="form-control" name="pid" placeholder="输入题目编号">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><?php echo L_GO;?></button>
						</span>
					</div>
					</form>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-6">
				<form method="get">
					<div class="input-group">
						<input type="text" name="wd" id="keyword" class="form-control" placeholder="输入标题关键字">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit"><?php echo L_SEARCH;?></button>
						</span>
					</div>
				</form>
				</div>
			</div><!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-hover" id="tableID">
						<thead>
							<tr>
								<th width="5%">AC</th>
								<th width="5%">ID</th>
								<th width="40%"><?php echo L_TITLE;?></th>
								<th width="20%"><?php echo L_DIFFICUTY;?></th>
								<th width="16%"><?php echo L_SOURCE;?></th>
								<th width="14%"><?php echo "AC / ".L_SUBMIT;?></th>
							</tr>
						</thead>
						<tbody id="oj-ps-problemlist">
							<tr><td>Loading...</td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
	<script>
	function fillPager(curPage, totalPages) {
		var $pagerContainer = $("#oj-ps-pager").empty();
		
		var i = 1;
		for(;i<=totalPages;i++) {
			$aPageBtn = $("<a>").attr('type', 'button').attr('data-page', i).addClass("btn").text(i).click(pageBtn_onclick);
			if (i == curPage) $aPageBtn.addClass("btn-primary");
			else $aPageBtn.addClass("btn-default");
			$pagerContainer.append($aPageBtn);
		}
	}
	
	function pageBtn_onclick() {
		var $caller = $(this);
		var pageNumber = Number($caller.attr('data-page'));
		fetchProblemList(pageNumber);
	}
	
	function fillProblemList(data) {
		var $tagSubContainer = $("#oj-ps-problemlist").empty();
		$.each(data, function (index, elem) {
			var isAcRateNaN = (elem.accepted == 0);
			var passRate = isAcRateNaN ? "0%" : Math.round(100 * elem.accepted / elem.submit) + "%"
			
			var $tableRow = $("<tr>");
			var $solvedStateCol = $("<td>");
			if (elem.defunct) $solvedStateCol.append("<i class='fa fa-lock'></i>");
			if (elem.undercontest) $solvedStateCol.append("<i class='fa fa-clock-o'></i>");
			if (elem.usersolved) $solvedStateCol.append("<i style='color: green;' class='fa fa-check'></i>");
			else if (elem.userchallenged) $solvedStateCol.append("<i style='color: orange;' class='fa fa-dot-circle-o'></i>");
			var $pidCol = $("<td>").text(elem.pid);
			var $titleCol = $("<td>").append(
				$("<a>").attr("href","problem.php?pid="+elem.pid).text(elem.title)
			);
			var $difficutyCol = $("<td>").append(
				$("<div>").addClass("progress maxwidth150px").append(
					$("<div>").addClass("progress-bar").css('width', passRate)
				)
			);
			var $sourceCol = $("<td>").text(elem.source ? elem.source : "");
			var $acceptRateCol = $("<td>").text('(' + elem.accepted + ' / ' + elem.submit + ') ' + passRate);
			
			$tableRow.append($solvedStateCol).append($pidCol).append($titleCol).append($difficutyCol).append($sourceCol).append($acceptRateCol);
			$tagSubContainer.append($tableRow);
		});
	}
	
	function fetchProblemList(page, keyword) {
		var theData = {
			p: page
		}
		if (keyword && keyword != "") {
			theData.wd = keyword;
			$("#keyword").val(keyword);
		}
		$.ajax({
			url: "./api/ajax_problemset.php",
			method: "POST",
			data: theData,
			dataType: "json",
			success: function (data, textStatus, jqXHR) {
				if (data.status === 200) {
					fillPager(data.result.currentpage, data.result.totalpages);
					fillProblemList(data.result.data);
					window.history.replaceState("","Problem Set","?p="+data.result.currentpage);
				}
			}
		});
	}

	$(document).ready(function () {
		fetchProblemList(<?php echo $p;
			if(isset($_GET['wd']) && trim($_GET['wd'])!="") {
				echo ',"'.pdo_real_escape_string(urldecode($_GET['wd']), $pdo).'"';
			}
		?>);
	});
	</script>
	</body>
</html>