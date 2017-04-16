<?php 
	/* 
		import LANGUAGE file first then use this file 
		we will import LANGUAGE file when setting_oj.inc.php is imported.
	*/
	$LANGUAGE_NAME = Array("C","C++","Pascal","Java","Ruby","Bash","Python","PHP","Perl","C#","Obj-C","FreeBasic","Schema","Clang","Clang++","Lua","Other Language");
	$LANGUAGE_EXT = Array( "c", "cc", "pas", "java", "rb", "sh", "py", "php","pl", "cs","m","bas","scm","c","cc","lua" );
	$ALPHABET_N_NUM = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$JUDGE_RESULT=Array(L_JUDGE_PD,L_JUDGE_PR,L_JUDGE_CI,L_JUDGE_RG,L_JUDGE_AC,L_JUDGE_PE,L_JUDGE_WA,L_JUDGE_TLE,L_JUDGE_MLE,L_JUDGE_OLE,L_JUDGE_RE,L_JUDGE_CE,L_JUDGE_CO,L_JUDGE_TR);
	$JUDGE_ROW_CSS_CLASS=Array("default","info","warning","warning","success","danger","danger","warning","warning","warning","warning","warning","warning","info"); // match to $JUDGE_RESULT
	
	//echo "common const file used<br/>";
?>
