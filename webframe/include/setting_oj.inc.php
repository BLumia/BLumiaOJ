<?php
// OJ Info
	$OJ_NAME = "BLumiaOJ"; //Name of this OJ, e.g. BLumiaOJ , BLOJ
	
// Page Setting
	$PAGE_ITEMS = 10;// Show how many comments/posts in one pages?

// Run Enviroment and DB setting
/* ********************
All Supported Enviroments($ENV_CASE, aka. Data Source): 
	"STD_MYSQL"  	You should setting the following stuff to connect to sql
	"OPEN_SHIFT" 	Supposed by Red Hat
	"SAE"			Supposed by Sina App Engine
You should modify the PDO statement in setting_db.inc.php if you are not using mysql.
******************** */
	$ENV_CASE = "STD_MYSQL";//Environment flag, Normally should be "STD_MYSQL"
	// If you are using STD_MYSQL, fill the following informations
	$SQL_DB_NAME = "judge";	//Your DB Name
	$SQL_DB_HOST = "localhost";//Your DB Host
	$SQL_DB_PORT = "3307";//Your DB Host
	$SQL_DB_USER = "root";//Your DB Login Username
	$SQL_DB_PASS = "usbw";//Your DB Management Password
	
	
// 普通用户无需在意本分割线下面的代码
	if (isset($ON_ADMIN_PAGE) && $ON_ADMIN_PAGE==="Yap") {
		require("../include/setting_db.inc.php");
	} else {
		require("./include/setting_db.inc.php");
	}
?>