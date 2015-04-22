<?php
// DB Connection
	if ($ON_SAE) {
		$pdo = new PDO('mysql:host='.SAE_MYSQL_HOST_M.';port='.SAE_MYSQL_PORT.';dbname='.SAE_MYSQL_DB, SAE_MYSQL_USER, SAE_MYSQL_PASS);
		$pdo->query("set names utf8;");
	} else {
		$pdo = new PDO("mysql:host=localhost:3307;dbname=judge","root","usbw");
		$pdo->query("set names utf8;");
	}
?>