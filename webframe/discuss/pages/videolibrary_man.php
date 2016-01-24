
	<body>
		
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
				<div class="eight">
				<form method="POST" class="form-horizontal">		  
					<label for="videoName">视频名称</label>
					<input type="text" class="form-control" id="videoName" name="videoName" placeholder="Video Name" />
					<label for="probID">问题编号</label>
					<input type="text" class="form-control" id="probID" name="probID" placeholder="Problem ID" />
					<label for="videoURL">视频链接</label>
					<input type="text" class="form-control" id="videoURL" name="videoURL" placeholder="Video URL" />
					<label for="videoAuthor">视频作者</label>
					<input type="text" class="form-control" id="videoAuthor" name="videoAuthor" placeholder="Author" value="<?php echo htmlspecialchars($_SESSION['user_id']);?>" />
					<label for="videoDesc">视频描述</label>
					<textarea id="videoDesc" name="videoDesc" class="form-control" rows="3" placeholder="Video Description"></textarea>

<?php $_SESSION['SessionAuth'] = strtoupper(substr(MD5(rand(0,9999999)),0,10)); ?>
<input type="hidden" name="pageauth" value="<?php echo ($_SESSION["SessionAuth"]);?>" readonly>

					<br/>

					<button type="submit" class="btn btn-primary">Submit</button>
				</form>
				<br/>
			</div>
		</div><!--main wrapper end-->
		<?php require("discuss-footer.php");?>
		
		
	</body>