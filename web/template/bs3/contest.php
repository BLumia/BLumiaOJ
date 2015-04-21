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
	<!-- Main component class="jumbotron"-->
	<div>
	<center>
		<div>
			<h3>Contest<?php echo $view_cid?> - <?php echo $view_title ?></h3>
			<p><?php echo $view_description?></p><br>
			Start Time: <font color=#993399><?php echo $view_start_time?></font>
			End Time: <font color=#993399><?php echo $view_end_time?></font><br>
			Current Time: <font color=#993399><span id=nowdate > <?php echo date("Y-m-d H:i:s")?></span></font>
			Status:
			<?php
				if ($now>$end_time)
				echo "<span class=red>Ended</span>";
				else if ($now<$start_time)
				echo "<span class=red>Not Started</span>";
				else
				echo "<span class=red>Running</span>";
			?>&nbsp;&nbsp;
			<?php
				if ($view_private=='0')
				echo "<span class=blue>Public</font>";
				else
				echo "&nbsp;&nbsp;<span class=red>Private</font>";
			?>
		</div>
		<div class="progress">
			<div id="bl-progress-bar" class="progress-bar progress-bar-striped active" role="progressbar" style="width: 0%;">
			</div>
		</div>
		<table id='problemset' class='table table-striped'  width='90%'>
			<thead>
			<tr align=center class='toprow'>
			<td width='5'>
			<td style="cursor:hand" onclick="sortTable('problemset', 1, 'int');" ><A><?php echo $MSG_PROBLEM_ID?></A>
			<td width='60%'><?php echo $MSG_TITLE?></td>
			<td width='10%'><?php echo $MSG_SOURCE?></td>
			<td style="cursor:hand" onclick="sortTable('problemset', 4, 'int');" width='5%'><A><?php echo $MSG_AC?></A></td>
			<td style="cursor:hand" onclick="sortTable('problemset', 5, 'int');" width='5%'><A><?php echo $MSG_SUBMIT?></A></td>
			</tr>
			</thead>
			<tbody>
			<?php
			$cnt=0;
			foreach($view_problemset as $row){
			if ($cnt)
			echo "<tr class='oddrow'>";
			else
			echo "<tr class='evenrow'>";
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
	</center>
	</div ><!-- /center -->

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php include("template/$OJ_TEMPLATE/js.php");?>	    
	<script src="include/sortTable.js"></script>
	<script>
	var diff=new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
	//alert(diff);
	function clock() {
		var x,h,m,s,n,xingqi,y,mon,d;
		var x = new Date(new Date().getTime()+diff);
		y = x.getYear()+1900;
		if (y>3000) y-=1900;
		mon = x.getMonth()+1;
		d = x.getDate();
		xingqi = x.getDay();
		h=x.getHours();
		m=x.getMinutes();
		s=x.getSeconds();
		n=y+"-"+mon+"-"+d+" "+(h>=10?h:"0"+h)+":"+(m>=10?m:"0"+m)+":"+(s>=10?s:"0"+s);
		//alert(n);
		document.getElementById('nowdate').innerHTML=n;
		setTimeout("clock()",1000);
	}
	
	function run() {
		
		var offset = new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
		var start_time=new Date(new Date("<?php echo $view_start_time?>").getTime()+offset).getTime();  //开始时间
		var end_time=new Date(new Date("<?php echo $view_end_time?>").getTime()+offset).getTime();   //结束时间
		var cur_time=new Date(new Date().getTime()+offset);    //当前时间
		
		//console.log(typeof end_time);
		//console.log(typeof start_time);
		
		var delta_time= end_time - start_time;  //时间差的毫秒数
		var passed_time= cur_time - start_time;  //过去的时间的毫秒数
		var percentage = passed_time / delta_time * 100;
		
		console.log(percentage);
		//alert(percentage);
		$("div[id=bl-progress-bar]").css("width",percentage+"%");
		if (percentage<100) {
			var timer=setTimeout("run()",1000);
		} else {
			var progress_bar = document.getElementById('bl-progress-bar'); 
			progress_bar.className = 'progress-bar'; 
			$("div[id=bl-progress-bar]").css("width","100%");
			//alert("Contest Ended Nya ~");
		}
	}
	
	clock();
	run();


	</script>
  </body>
</html>
