<footer class="footer">
	<div class="container">
		<p style="float: left;" align="left">
			<span id="clock"><?php echo L_SRV_TIME;?>: Loading...</span><br/>
			<a class="bl-footer-link" href="document.php">FAQ</a> | <a class="bl-footer-link" href="#">Rule</a> 
		</p>
		<p style="float: right; margin-right: 15px;" class="hidden-xs" align="right">
			<?php echo $FOOTER_POWERED_BY;?><br/>
			<?php echo $FOOTER_COPYRIGHT;?></a>
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
		finalText="<?php echo L_SRV_TIME;?>: "+year+"/"+mon+"/"+day+" "+(h>=10?h:"0"+h)+":"+(m>=10?m:"0"+m)+":"+(s>=10?s:"0"+s);
		document.getElementById('clock').innerHTML=finalText;
		setTimeout("clock()", 1000);
	}
	clock();
</script>