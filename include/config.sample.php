<?php
// OJ Info (sample examples all without "[" and "]")
	$OJ_NAME = "BLumiaOJ"; // Name of this OJ, e.g. [BLumiaOJ] , [BLOJ]
	$OJ_HUSTOJ_COMPATIBLE = true; // If you haven't upgrade database to BLumiaOJ, set this to [true].
	$OJ_LANGUAGE = "schinese"; // Check out language folder to know what to fill. if you wanna contribute, see https://github.com/ValveSoftware/source-sdk-2013/blob/master/sp/src/common/language.cpp for the country code string.
	
// Data Path Setting
	$OJ_PROBLEM_DATA = "/home/judge/data"; //Path to problem data floder. e.g. [/home/judge/data], this path will NOT work IF you are running on SAE or OpenShift
	$OJ_UPLOAD_DATA = "/var/www/html/OnlineJudge/uploads/"; // Any file or image will be upload here. e.g. [/var/www/html/BLumiaOJ/imguploads/]
	$OJ_WWW_UPLOAD_PATH = "uploads"; // Img can be visit at http://your.site/path/to/folder/ , u should fill [path/to/folder]
	
// Submit Setting
	$OJ_SUBMIT_DELTATIME = 10; // allowed submit frequence. (seconds)
	$OJ_LANGMASK = 65520; //1mC 2mCPP 4mPascal 8mJava 16mRuby 32mBash 65520 for security reason to mask all other language, see `common_const.inc.php` for more details.
	
// Page Setting
	$PAGE_ITEMS = 50;// Show how many comments/posts in one pages?
	
// Solution Setting
	$SOLUTION_WA_INFO = true; // Show WA result compare?
	$SOLUTION_SHARE = false; // Can people view the source if he/she Accepted that problem?
	
// Contest Setting
	$OJ_LOCKRANK = false; // Default Lock Ranklist Mod
	$OJ_LOCKRANK_PERCENT = 0.2; // 0~1. eg. 0.2: a 5 hours contest will lock one hour.
	$OJ_LARGE_CONTEST_MODE = false; // Enable it will disable discuss forum, private mailbox and enable login filter(see next variable).
	$OJ_LOGIN_FILTER = "BK_"; // Login filter will only allow administrator, and users who is not administrator but his/her user_id match the given prefix to login. set it to false (boolean, not string) if you wish disable login filter so that anyone registed can login, login filter is only enable if $OJ_LARGE_CONTEST_MODE is true and $OJ_LOGIN_FILTER is not set to false.
	
// Community forum (Discuss board) Setting
	$FORUM_ENABLED = false; // Experimental feature, if you need a forum, change it to [true].
	$FORUM_SUBMIT_DELTATIME = 180; // allowed submit frequence. (seconds)
	$FORUM_ENHAUNCEMENT = false; // Need import extra sql struct into your database.
	
// Virtual Judge Setting
	$VJ_ENABLED = false; // Currently not finished. Don't enable it unless you gonna hacking this part.

// Problem Tag System Setting
	$PROBLEM_TAG_ENABLED = false; // Need import extra sql struct into your database.

// Custom Information Display
	$FOOTER_POWERED_BY = "Powered by <a class='bl-footer-link' href='https://github.com/BLumia/BLumiaOJ/'>BLumiaOJ</a>";
	$FOOTER_COPYRIGHT = "Copyright © <a class='bl-footer-link' href='document.php?f=about'>{$OJ_NAME} Maintenance Team</a>";

// Search Engine Optimization
	$OJ_ENABLE_SEO = true;
	$SEO_KEYWORD = "OJ,Online Judge,{$OJ_NAME},ACM,ICPC";
	$SEO_DESC = "{$OJ_NAME} is an online judge system for ACM/ICPC";

// Run Enviroment and DB setting
/* ********************
All Supported Enviroments($ENV_CASE, aka. Data Source): 
	"STD_MYSQL"  	You should setting the following stuff to connect to sql
	"SAE"			Supposed by Sina App Engine (Untested)
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