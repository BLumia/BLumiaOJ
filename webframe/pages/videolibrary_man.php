
	<body>
		<?php require("./pages/components/navbar.php");?>
		
	<h1 class="container">视频讲解 <small>或许你需要一些帮助？</small></h1>
	<div class="bc-social">
		<div class="container">
	  
        <ul class="bc-social-buttons">
			<?php if ($VideoManager) { ?>
			<li>
				<a href="?"><i class="fa fa-cog"></i> 退出管理</a>
			</li>
			<?php } ?>
        </ul>
		</div>
    </div>
		
		
		<div class="container">
			<div class="row">
			
				<form method="POST" class="form-horizontal">
				</form>
		
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		
		
	</body>