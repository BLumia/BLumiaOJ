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
<h2>[judged]Checkout rejugde.</h2>
<form action='./admin/problem_judge.php' method="post">
	sid:<input type=text size=10 name="sid"><br/>
	result:<input type=text size=10 name="result" value=1><br/>
	
    <input type='hidden' name='checkout' value='do'>
	<input type="submit">
</form>
<hr/>
<h2>[judged]Get Pending.</h2>
<form action='./admin/problem_judge.php' method="post">
	max_running:<input type=text size=10 name="max_running" value=4><br/>
	oj_lang_set:<input type=text size=10 name="oj_lang_set" value="0,1,2,3,4,5,6,7,8,9"><br/>
	
    <input type='hidden' name='getpending' value='do'>
	<input type="submit">
</form>
