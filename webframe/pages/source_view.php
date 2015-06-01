
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
				<h1>大字 <small>小字</small></h1>
			</div>
			<div class="row">
				<div class="col-md-9 col-sm-9">
					<pre class="prettyprint linenums"><?php echo $code_Src;?></pre>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="panel">
						User Name:<br/>
						Time:<br/>
						Language:<br/>
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