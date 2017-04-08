<?php
// OJ Info (sample examples all without "[" and "]")
	$OJ_NAME = "BLumiaOJ"; // Name of this OJ, e.g. [BLumiaOJ] , [BLOJ]
	$OJ_HUSTOJ_COMPATIBLE = true; // If you haven't upgrade database to BLumiaOJ, set this to true.
	$OJ_LANGUAGE = "schinese"; // Check out language folder to know what to fill.
	
// Data Path Setting
	$OJ_PROBLEM_DATA = "/home/judge/data"; //Path to problem data floder. e.g. [/home/judge/data], this path will NOT work IF you are running on SAE or OpenShift
	$OJ_UPLOAD_DATA = "/var/www/html/OnlineJudge/uploads/"; // Any file or image will be upload here. e.g. [/var/www/html/BLumiaOJ/webframe/imguploads/]
	$OJ_WWW_UPLOAD_PATH = "uploads"; // Img can be visit at http://your.site/path/to/folder/ , u should fill [path/to/folder]
	
// Submit Setting
	$OJ_SUBMIT_DELTATIME = 10; // allowed submit frequence. (seconds)
	$OJ_LANGMASK = 4080; //1mC 2mCPP 4mPascal 8mJava 16mRuby 32mBash 4080 for security reason to mask all other language
	
// Page Setting
	$PAGE_ITEMS = 50;// Show how many comments/posts in one pages?
	
// Solution Setting
	$SOLUTION_WA_INFO = true; // Show WA result compare?
	$SOLUTION_SHARE = false; // Can people view the source if he/she Accepted that problem?
	
// Contest Setting
	$OJ_LOCKRANK = false; // Default Lock Ranklist Mod
	$OJ_LOCKRANK_PERCENT = 0.2; // 0~1. eg. 0.2: a 5 hours contest will lock one hour.
	
// Community forum (Discuss board) Setting
	$FORUM_ENABLED = false; // Currently not finished. Don't enable it unless you gonna hacking this part.
	$FORUM_SUBMIT_DELTATIME = 180; // allowed submit frequence. (seconds)
	
// Virtual Judge Setting
	$VJ_ENABLED = false; // Currently not finished. Don't enable it unless you gonna hacking this part.

// Problem Tag System Setting
	$PROBLEM_TAG_ENABLED = false;

// Custom Information Display
	$FOOTER_POWERED_BY = "Powered by <a class='bl-footer-link' href='https://github.com/BLumia/BLumiaOJ/'>BLumiaOJ</a>";
	$FOOTER_COPYRIGHT = "Copyright © <a class='bl-footer-link' href='./about.php'>{$OJ_NAME}</a> Maintenance Team";

// Search Engine Optimization
	$OJ_ENABLE_SEO = true;
	$SEO_KEYWORD = "OJ,Online Judge,{$OJ_NAME},ACM,ICPC";
	$SEO_DESC = "{$OJ_NAME} is an online judge system for ACM/ICPC";

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
	$SQL_DB_PASS = "root";//Your DB Management Password
	
// Developer Setting
	$DEV_DISPLAY_ERRORS = false; // Display Error Messages of PHP display_errors

?>