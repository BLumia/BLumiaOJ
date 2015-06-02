
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
			<div class="page-header">
				<h1><?php echo $code_title;?> <small><?php echo "Code by: ".$code_author;?></small></h1>
			</div>
			<div class="row">
				<div class="col-md-9 col-sm-9">
					<pre class="prettyprint linenums"><?php echo $code_src;?></pre>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="panel">
						<p class="text-info"><b>User Name: </b><code><?php echo $code_author;?></code></p>
						<p class="text-info"><b>Time: </b><code><?php echo $code_date;?></code></p> 
						<p class="text-info"><b>Language: </b><code>Pascal</code></p>
						
						<p class="text-info"><b>Judge Result: </b><code><?php echo $code_result;?></code></p>
						<p class="text-info"><b>Time Cost: </b><code><?php echo $code_time." MS";?></code></p> 
						<p class="text-info"><b>Memory Cost: </b><code><?php echo $code_memory." KB";?></code></p>
					</div>
				</div>
			</div>
		</div><!--main wrapper end-->
		<?php require("./pages/components/footer.php");?>
		
	<script type="text/javascript">
$(window).load(function(){
    //$("pre").addClass("prettyprint");
    prettyPrint();
})
	</script>
		
	</body>