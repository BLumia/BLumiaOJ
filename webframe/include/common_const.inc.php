<?php 
	/* 
		import LANGUAGE file first then use this file 
		we will import LANGUAGE file when setting_oj.inc.php is imported.
	*/
	$LANGUAGE_NAME = Array("C","C++","Pascal","Java","Ruby","Bash","Python","PHP","Perl","C#","Obj-C","FreeBasic","Schema","Clang","Clang++","Lua","Other Language");
	$LANGUAGE_EXT = Array( "c", "cc", "pas", "java", "rb", "sh", "py", "php","pl", "cs","m","bas","scm","c","cc","lua" );
	$ALPHABET_N_NUM = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$JUDGE_RESULT=Array("MSG_PD","MSG_PR","MSG_CI","MSG_RJ","MSG_AC","MSG_PE","MSG_WA","MSG_TLE","MSG_MLE","MSG_OLE","MSG_RE","MSG_CE","MSG_CO","MSG_TR");
	$JUDGE_ROW_CSS_CLASS=Array("active","info","warning","warning","success","danger","danger","warning","warning","warning","warning","warning","warning","info"); // match to $JUDGE_RESULT
	
	//echo "common const file used<br/>";
?>
