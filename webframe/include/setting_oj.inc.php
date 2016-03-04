<?php
// OJ Info (sample examples all without "[" and "]")
	$OJ_NAME = "BLumiaOJ"; //Name of this OJ, e.g. [BLumiaOJ] , [BLOJ]
	$OJ_HUSTOJ_COMPATIBLE = true; //If you haven't upgrade database to BLumiaOJ, set this to true.
	$OJ_PROBLEM_DATA = "../../Archives/problems"; //Path to problem data floder. e.g. [/home/judge/data], this path will NOT work IF you are running on SAE or OpenShift
	$OJ_LANGMASK = 4080; //1mC 2mCPP 4mPascal 8mJava 16mRuby 32mBash 4080 for security reason to mask all other language
	$OJ_LANGUAGE = "schinese";
	
// Submit Setting
	$OJ_SUBMIT_DELTATIME = 10; //allowed submit frequence. (seconds)
	
// Page Setting
	$PAGE_ITEMS = 25;// Show how many comments/posts in one pages?
	
// Contest Setting
	$OJ_LOCKRANK = false; // Default Lock Ranklist Mod
	$OJ_LOCKRANK_PERCENT = 0.2; // 0~1. eg. 0.2: a 5 hours contest will lock one hour.
	
	
// Virtual Judge Setting
	$VJ_ENABLED = true;

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
	
// Developer Setting
	$DEV_DISPLAY_ERRORS = false;//是否显示报错
	
	
// 普通用户无需在意本分割线下面的代码--------
	$OJ_PROBLEM_DATA = ($ENV_CASE == "OPEN_SHIFT") ? $_ENV['$OPENSHIFT_REPO_DIR'] : $OJ_PROBLEM_DATA;
	if (isset($ON_ADMIN_PAGE) && $ON_ADMIN_PAGE==="Yap") {
		require("../include/setting_db.inc.php");
		require("../language/{$OJ_LANGUAGE}.inc.php");
	} else {
		require("./include/setting_db.inc.php");
		require("./language/{$OJ_LANGUAGE}.inc.php");
	}
	if ($DEV_DISPLAY_ERRORS)
		ini_set("display_errors","Off");
	date_default_timezone_set("PRC");
?>