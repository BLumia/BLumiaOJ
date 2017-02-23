<?php 
	session_start(); $ON_ADMIN_PAGE="Yap";
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once('../include/common_functions.inc.php');
	require_once('../include/common_const.inc.php');
	//Prepares
	
	// OJ Default Lang
	$lang_count=count($LANGUAGE_EXT);
	$lang=(~((int)$OJ_LANGMASK))&((1<<($lang_count))-1);
	
	//Page Includes
	require("./pages/index.php");
?>
