<body>
	<?php require('./pages/components/offcanvas.php');?>
	<div class="container" id="mainContent">
		<div class="page-header">
			<h1>Welcome <small>Manager</small></h1>
		</div>
		<p class="lead">
			To start management, please <b>click a link in the side-menu</b> on the left side of this page.
		</p>
		<p>If you are using mobile device (Pad, Smart Phone, etc.) or small screen device, you should click the button on the left-top side of the page. <br/>
		Click <a href="#">here</a> if you need a tortual.<br/>
		Following is a table about OJ properties, if you want update some of them, edit <code>setting_oj.inc.php</code> in this OJ's <code>include</code> folder.
		</p>
		<table class="table">
			<tr><th>属性名称</th><th>状态</th></tr>
			<tr><td>是否显示答案错误对比</td><td><?php echo $SOLUTION_WA_INFO ? "Yes" : "No";?></td></tr>
			<tr><td>默认可提交的编程语言</td><td>
				<?php
					for($i=0;$i<$lang_count;$i++){
						if($lang&(1<<$i))
						echo "<span class='label label-default'>{$LANGUAGE_NAME[$i]}</span> ";
					}
				?>
			</td></tr>
			<tr><td>重复提交最小间隔时间</td><td><?php echo $OJ_SUBMIT_DELTATIME." sec";?></td></tr>
			<tr><td>竞赛后期是否锁定排名</td><td><?php echo $OJ_LOCKRANK ? "Yes" : "No";?></td></tr>
			<tr><td>竞赛锁定排名时间比例</td><td><?php echo $OJ_LOCKRANK ? $OJ_LOCKRANK_PERCENT : "No";?></td></tr>
		</table>
	</div>
</body>