	<div class="footer">
		<span id="clock">Server Time: Loading...</span><br/>
		All Right Reseived © 2015 <br/>
		<a href="./about.php">BLumiaOJ Team</a>
	</div>
	<script>
		function getTime() {
			with (new Date) {
				document.getElementById("clock").innerText = "Server Time: "+(getYear()+1900)+"/"+(getMonth()+1)+"/"+getDate()+" "+getHours()+":"+getMinutes()+":"+getSeconds();
				//time.innerText = 
			}
		}
		setInterval(getTime,1000);
	</script>