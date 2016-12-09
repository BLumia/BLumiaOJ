<?php 
	session_start();
	$_SESSION['http_judge'] = true;
?>
<h2>Manual rejugde.</h2>
<form action='./admin/problem_judge.php' method="post">
	sid:<input type=text size=10 name="sid"><br/>
	result:<input type=text size=10 name="result" value=4><br/>
  	explain:<input type=text size=10 name="filename" value="1000/test.in"><br/>
	
    <input type='hidden' name='manual' value='do'>
	<input type="submit">
</form>
<hr/>
<h2>Checkout rejugde.</h2>
<form action='./admin/problem_judge.php' method="post">
	sid:<input type=text size=10 name="sid"><br />
	result:<input type=text size=10 name="result" value=1><br/>
	
    <input type='hidden' name='checkout' value='do'>
	<input type="submit">
</form>
