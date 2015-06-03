
	<body>
		<?php require("./pages/components/navbar.php");?>
		<div class="container">
		<!--[if lt IE 8]>
		<div class="row">
			<div class="alert alert-warning">
				&nbsp;您的浏览器版本实在是太低了，是时候考虑<a href="http://browsehappy.com/">换一个</a>了。 
				<del>&times;</del>
			</div>	
		</div>		
		<![endif]-->
			<div class="row">
				<div class="col-md-9 col-sm-9">
					统计信息或巨幕
				</div>
				<div class="col-md-3 col-sm-3">
					<ul class="list-group">
						<li class="list-group-item"><a href="./discuss/discuss.php">讨论版</a></li>
						<li class="list-group-item"><a href="#">常见问答</a></li>
						<li class="list-group-item"><a href="#">代码便签盒</a></li>
						<li class="list-group-item"><a href="#">工具和向导</a></li>
						<li class="list-group-item"><a href="#">建议反馈箱</a></li>
						<li class="list-group-item"><a href="#">关于BLumiaOJ</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-9">
					<div id="news" class="doc">
						Loading News....
					</div>
				</div>
				<div class="col-md-3">
					<div class="well">
						<h3>Top 10 Problems</h3>
						
					</div>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
	function loadnews(num){
		NProgress.start();
		$.ajax({
			url:"./api/ajax_newslist.php?show="+num,
			async:false,
			contentType:"application/x-www-form-urlencoded; charset=utf-8",
			success:function(data/*返回的数据*/, textStatus, jqXHR){
				document.getElementById("news").innerHTML=data;
				$(".alter").fadeIn();
			},
			complete:function(jqXHR, textStatus){
				NProgress.done();
			}
		});
	}
	
	loadnews(1);
	</script>
		
	</body>