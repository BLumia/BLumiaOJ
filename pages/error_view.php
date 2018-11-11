<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title><?php echo L_ERR_VIEW." - {$OJ_NAME}";?></title>
	</head>	
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
				<h1><?php echo "Code #".$code_id;?> <small><?php echo "Code by: ".$code_author;?></small></h1>
			</div>
			<div class="row">
				<div class="col-md-9 col-sm-9">
					<pre class="prettyprint"><?php echo $code_error;?></pre>
				</div>
				<div class="col-md-3 col-sm-3">
					<div class="panel">
						<p class="text-info"><b><?php echo L_UID;?>: </b><code><?php echo $code_author;?></code></p>
						<p class="text-info"><b><?php echo L_SUBMIT_TIME;?>: </b><code><?php echo $code_date;?></code></p> 
						<p class="text-info"><b><?php echo L_COMPILER;?>: </b><code><?php echo $LANGUAGE_NAME[$code_lang];?></code></p>
						
						<p class="text-info"><b><?php echo L_RESULT;?>: </b><code><?php echo $code_result;?></code></p>
						<p class="text-info"><b><?php echo L_TIME_COST;?>: </b><code><?php echo $code_time." MS";?></code></p> 
						<p class="text-info"><b><?php echo L_MEMORY;?>: </b><code><?php echo $code_memory." KB";?></code></p>
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
</html>