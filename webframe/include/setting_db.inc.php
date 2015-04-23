<?php
// DB Connection
	switch ($ENV_CASE) {
	case "SAE":
		define('DB_HOST',getenv('SAE_MYSQL_HOST_M'));
		define('DB_PORT',getenv('SAE_MYSQL_PORT')); 
		define('DB_USER',getenv('SAE_MYSQL_USER'));
		define('DB_PASS',getenv('SAE_MYSQL_PASS'));
		define('DB_NAME',getenv('SAE_MYSQL_DB'));
		break;
	case "OPEN_SHIFT":
		define('DB_HOST',getenv('OPENSHIFT_MYSQL_DB_HOST'));
		define('DB_PORT',getenv('OPENSHIFT_MYSQL_DB_PORT')); 
		define('DB_USER',getenv('OPENSHIFT_MYSQL_DB_USERNAME'));
		define('DB_PASS',getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));
		define('DB_NAME',getenv('OPENSHIFT_GEAR_NAME'));
		break;
	case "STD_MYSQL":
		define('DB_HOST',$SQL_DB_HOST);
		define('DB_PORT',$SQL_DB_PORT); 
		define('DB_USER',$SQL_DB_USER);
		define('DB_PASS',$SQL_DB_PASS);
		define('DB_NAME',$SQL_DB_NAME);
		break;
	}

	$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';port='.DB_PORT;
	$pdo = new PDO($dsn, DB_USER, DB_PASS);
	$pdo->query("set names utf8;");
?>