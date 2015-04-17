<footer class="footer">
	<div class="container">
		<p style="float: left;" align="left">
			<span id="clock">Server Time: Loading...</span><br/>
			FAQ | 
		</p>
		<p style="float: right; margin-right: 15px;" align="right">
			WTF<br/>
			Copyright 2015 © <a href="./about.php">BLumiaOJ Develop Team</a>
		</p>
	</div> 
</footer>
	<script>
		function getTime() {
			with (new Date) {
				document.getElementById("clock").innerText = "Server Time: "+(getYear()+1900)+"/"+(getMonth()+1)+"/"+getDate()+" "+getHours()+":"+getMinutes()+":"+getSeconds();
				//time.innerText = 
			}
		}
		setInterval(getTime,1000);
	</script>