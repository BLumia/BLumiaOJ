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
    <?php include("template/$OJ_TEMPLATE/css.php");?>	    


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action  class="jumbotron"-->
      <div>
	  <br/>
<div>
<table align=center width=100%>
<tr><td align=left>
<form action=userinfo.php>
<?php echo $MSG_USER?><input name=user>
<input type=submit value=Go>
</form></td><td colspan=2>
<form action=ranklist.php>
<?php echo $MSG_KWDL?><input name=kwdl>
<input type=submit value=Go>
</form>
</td><td align=right>
<a href=ranklist.php?scope=d>Day</a>
<a href=ranklist.php?scope=w>Week</a>
<a href=ranklist.php?scope=m>Month</a>
<a href=ranklist.php?scope=y>Year</a>
</td></tr>
</table>
</div>
	<table align=center class="table" width=90%>
<thead>
<tr class='toprow'>
<th width=5% align=left><b><?php echo $MSG_Number?></b></th>
<th width=15% align=left><b><?php echo $MSG_USER?></b></th>
<th width=50% align=left><b><?php echo $MSG_NICK?></b></th>
<th width=10% align=left><b><?php echo $MSG_AC?></b></th>
<th width=10% align=left><b><?php echo $MSG_SUBMIT?></b></th>
<th width=10% align=right><b><?php echo $MSG_RATIO?></b></th>
</tr>
</thead>
<tbody>
<?php
$cnt=0;
foreach($view_rank as $row){
	//if ($cnt) echo "<tr class='oddrow'>";
	//else echo "<tr class='evenrow'>";
	echo "<tr>";
	foreach($row as $table_cell){
		echo "<td>";
		echo "\t".$table_cell;
		echo "</td>";
	}
	echo "</tr>";
	$cnt=1-$cnt;
}
?>
</tbody>
</table>
<nav>
	<ul class="pagination">
<?php
for($i = 0,$j = 1; $i <$view_total ; $i += $page_size,$j++) {
	echo "<li>";
	echo "<a href='./ranklist.php?start=" . strval ( $i ).($scope?"&scope=$scope":"") . "'>";
	echo strval ($j);
	echo "</a>";
	echo "</li>";
	if ($j >= 15) {
		break;
	}
}
?>
</ul>
</nav>
<?php
if ($j>=15) { 
	$view_total2 = $view_total-1;
?>
	<form action=ranklist.php>
	Rank Starter(0~<?php echo $view_total2;?>):
	<input name=start>
	<input type=submit value=Go>
	</form>
<?php } ?>

<div>皮肤：<span id="linkskin1"><strong>普通</strong></span> <span id="linkskin2"><a onclick="changecss('skin2')" href="javascript:void(0);">夜晚</a></span></div>
<script language="javascript" type="text/javascript">
  	
function changecss(str) {
	var csshref=$("#skin").attr("href");
	csshref=csshref.replace(/skin[0-9]/g,str);
	csshref=$("#skin").attr("href",csshref);
	$.cookie("css_skin",str);
	if(str=='skin1'){
		$("#linkskin1").html('<strong>普通</strong>');
		$("#linkskin2").html('<a onclick="changecss(\'skin2\')" href="javascript:void(0);">夜晚</a>');
	}else{
		$("#linkskin1").html('<a onclick="changecss(\'skin1\')" href="javascript:void(0);">普通</a>');
		$("#linkskin2").html('<strong>夜晚</strong>');
	}
	if ($.browser.msie&&($.browser.version == "6.0")){
		window.location.reload();
	}
}

$(function() {
	if ($.browser.msie&&($.browser.version == "6.0")){
		if($.cookie("ie6") != 'ie6'){
			alert('您使用的是IE6浏览器，部分功能不能正常使用。\n建议升级浏览器版本或更换Firefox、Chrome等其它浏览器。\n期待一切顺利！');
			$.cookie("ie6",'ie6');
		}
	}
	
});
</script>

      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
  </body>
</html>
