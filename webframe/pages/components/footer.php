<footer class="footer">
	<div class="container">
		<p style="float: left;" align="left">
			<span id="clock">Server Time: Loading...</span><br/>
			FAQ | <a class="bl-footer-link" href="#">Rule</a> 
		</p>
		<p style="float: right; margin-right: 15px;" align="right">
			Powered by <a class="bl-footer-link" href="https://github.com/BLumia/BLumiaOJ/">BLumiaOJ</a><br/>
			Copyright 2015~2016 © <a href="./about.php"><?php echo $OJ_NAME; ?> Develop Team</a>
		</p>
	</div> 
</footer>
<script>
	var delta=new Date("<?php echo date("Y/m/d H:i:s")?>").getTime()-new Date().getTime();
	function clock() {
		var h,m,s,finalText,week,year,mon,day;
		var realTime = new Date(new Date().getTime() + delta);
		year = realTime.getYear() + 1900;
		if (year > 3000) year-=1900;
		mon = realTime.getMonth()+1;
		day = realTime.getDate();
		week = realTime.getDay();
		h=realTime.getHours();
		m=realTime.getMinutes();
		s=realTime.getSeconds();
		finalText="Server Time: "+year+"/"+mon+"/"+day+" "+(h>=10?h:"0"+h)+":"+(m>=10?m:"0"+m)+":"+(s>=10?s:"0"+s);
		document.getElementById('clock').innerHTML=finalText;
		setTimeout("clock()", 1000);
	}
	clock();
</script>