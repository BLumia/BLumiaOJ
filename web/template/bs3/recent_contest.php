<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title><?php echo $OJ_NAME?></title>  
    <?php 
		include("template/$OJ_TEMPLATE/css.php");
		header("Access-Control-Allow-Origin：http://contests.acmicpc.info");
	?>	    

</head>

<body>
	<div class="container">
	<?php include("template/$OJ_TEMPLATE/nav.php");?>	    
	<!-- Main component class="jumbotron"-->
	<div>
	<center>
		<table width=100% align=center>
			<thead class=toprow>
				<tr>
					<th class="column-1">OJ</th>
					<th class="column-2">Name</th>
					<th class="column-3">Start Time</th>
					<th class="column-4">Week</th>
					<th class="column-5">Access</th>
				</tr>
			</thead>
			<tbody id="insert">
			</tbody>
		<table>
	</center>
	</div ><!-- /center -->

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
	<script>
function insert(){ 
	
	$.ajax({
		type: 'POST',
		//url: 'upload/contests.json',
		url: 'http://contests.acmicpc.info/contests.json',
		//data: {'p':0,'tid':1},
		dataType:'json',
		beforeSend:function(){
			NProgress.start();
		},
		success:function(json){
			var insertText = "";
			$.each(json, function(index, content) { 
				insertText = insertText + "<tr><td>" + content.oj + "</td>";
				insertText = insertText + "<td><a href=\"" + content.link +"\" target=\"_blank\">" + content.name +"</a></td>";
				insertText = insertText + "<td>" + content.start_time + "</td>";
				insertText = insertText + "<td>" + content.week + "</td>";
				insertText = insertText + "<td>" + content.access + "</td></tr>";
			});
			document.getElementById("insert").innerHTML = insertText; 
		},
		complete:function(){ 
			NProgress.done();
		},
		error:function(jqXHR, textStatus, errorThrown){
			console.log("error: " + errorThrown);
		}
	});
} 
	insert();
	</script>
  </body>
</html>
