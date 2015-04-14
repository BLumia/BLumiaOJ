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

	<script>
ieGo();
function ieGo(){ 
		var ie = !-[1,];  
		if(ie == true) {
			var ua = navigator.userAgent.toLowerCase();
			var version = parseInt(ua.match(/msie ([\d.]+)/)[1]);
			if(version <= 7) {
				location.href='./old/'; 
			}
		}
}
	</script>
  </head>

  <body>

    <div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>	    
      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <p><!--
<center>
<div id=submission style="width:600px;height:300px" ></div>
</center>-->
        </p>
	
<div class="row">
	<div class="col-xs-12 col-md-9">
		<center>
			<div id="submission" style="width:600px;height:300px" ></div>
		</center>
	</div>
	<div class="col-xs-12 col-md-3">
		<ul class="list-group">
			<a href="./old/faqs.cn.php"><li class="list-group-item"><?php echo $MSG_FAQ; ?></li></a>
			<a href="./discuss/discuss.php"><li class="list-group-item"><?php echo $MSG_BBS; ?></li></a>
			<a href="./gettools.php"><li class="list-group-item"><?php echo $MSG_GET_TOOLS;?></li></a>
			<a href="./feedback.html"><li class="list-group-item primary">欢迎吐槽</li></a>
			<li class="list-group-item"><?php echo $MSG_ABOUT;?></li>
		</ul>
	</div>
</div>
<?php echo $view_news?>
<div class="row">
  <div class="col-xs-6 col-md-3">
    <a href="http://uva.onlinejudge.org/" class="thumbnail" target="_blank">
      <img src="./homepage/uvalogo.png" alt="UVa Online Judge">
    </a>
  </div>
  <div class="col-xs-6 col-md-3">
    <a href="http://poj.org/" class="thumbnail" target="_blank">
      <img src="./homepage/pojlogo.png" alt="POJ Online Judge">
    </a>
  </div>
  <div class="col-xs-6 col-md-3">
    <a href="http://acm.hdu.edu.cn/" class="thumbnail" target="_blank">
      <img src="./homepage/hdulogo.png" alt="HDU Online Judge">
    </a>
  </div>
  <div class="col-xs-6 col-md-3">
    <a href="http://acm.zznu.edu.cn/" class="thumbnail" target="_blank">
      <img src="./homepage/zznulogo.png" alt="ZZNU Online Judge">
    </a>
  </div>

</div>
	<ul class="nav nav-pills navbar-inverse">
	<?php if(file_exists("setlang.php")){?>
		<li class="disabled"><a href="#"><?php echo $MSG_LANG ?></a></li>
		<li><a href="setlang.php?lang=en">English</a></li>
		<li><a href="setlang.php?lang=cn">简体中文</a></li>
	<?php }?>	
		<li class="disabled"><a href="#">Global Contest:</a></li>
		<li><a href="#">View</a></li>
	</ul>
	<ul class="nav nav-pills navbar-inverse">
		<?php echo '<font color="white">&nbsp;&nbsp;&nbsp;&nbsp;'.$MSG_BLOG.'&nbsp;&nbsp;</font>'; ?>
		<a href="http://www.cnblogs.com/chenchengxun" target="_blank"><button class="btn btn-primary" type="button">陈成勋</button></a>
		<a href="http://www.cnblogs.com/liuxin13" target="_blank"><button class="btn btn-warning" type="button">刘鑫</button></a>
		<a href="http://www.cnblogs.com/alihenaixiao" target="_blank"><button class="btn btn-danger" type="button">王寒</button></a>
	</ul>
      </div>
<?php require_once("oj-footer.php");?>
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
 <script language="javascript" type="text/javascript" src="include/jquery.flot.js"></script>
<script type="text/javascript">
$(function () {
	var d1 = [];
	var d2 = [];
	<?php foreach($chart_data_all as $k=>$d){ ?>
	d1.push([<?php echo $k?>, <?php echo $d?>]);
	<?php }?>
	<?php foreach($chart_data_ac as $k=>$d){ ?>
	d2.push([<?php echo $k?>, <?php echo $d?>]);
	<?php }?>
	//var d2 = [[0, 3], [4, 8], [8, 5], [9, 13]];
	// a null signifies separate line segments
	var d3 = [[0, 12], [7, 12], null, [7, 2.5], [12, 2.5]];
	$.plot($("#submission"), [
		{label:"<?php echo $MSG_SUBMIT?>",data:d1,lines: { show: true }},
		{label:"<?php echo $MSG_AC?>",data:d2,lines:{show:true}} 
	],{
		grid: {
			backgroundColor: { colors: ["#fff", "#eee"] }
		},
		xaxis: {
			mode: "time",
			max:(new Date()).getTime(),
			min:(new Date()).getTime()-50*24*3600*1000//100 to 50
		},
		yaxis: {
			max:4500,
			min:0//100 to 50
		}
	});
});
//alert((new Date()).getTime());
</script>
  </body>
</html>
