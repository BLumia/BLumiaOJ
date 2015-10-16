<?php
if (!isset($_SESSION['SessionAuth'])||!isset($_POST['pageauth'])||$_SESSION['SessionAuth']!=$_POST['pageauth'])
	exit(403);
?>
