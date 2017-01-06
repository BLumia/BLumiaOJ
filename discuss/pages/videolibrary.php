
	<body>
		
	<h1 class="container">视频讲解 <small>或许你需要一些帮助？</small></h1>
	<div class="bc-social">
		<div class="container">
	  
        <ul class="bc-social-buttons">
			<li class="social-qq">
				<i class="fa fa-qq"></i> 郑州师院15级C语言交流群：<span id="qqgroup">463927243</span>
			</li>
			<li class="social-forum">
				<a class="" href="/discuss/discuss.php" target="_blank"><i class="fa fa-comments"></i> ZZNUOJ讨论版</a>
			</li>
			<?php if ($VideoManager) { ?>
			<li>
				<a href="?man=1"><i class="fa fa-cog"></i> 管理视频</a>
			</li>
			<?php } ?>
        </ul>
		</div>
    </div>
		
		
		<div class="container">
			<div class="row">
			
		<?php foreach($totalVideos as $row) { ?>
        <div class="gird four">
          <div style="height: 250px;" class="alert">
            <div class="pre">
              <h3>
                <a href="<?php echo $row['url'];?>" target="_blank"><?php echo $row['title'];?></a><br><small><?php echo "Problem #{$row['pid']} by @{$row['author_id']}";?></small>
              </h3>
              <p>
              <?php echo $row['videodesc'];?>
              </p>
            </div>
          </div>
        </div>
		<?php } ?>
		
			</div>
		</div><!--main wrapper end-->
		<?php require("discuss-footer.php");?>
		
		
	</body>