<?php 
	session_start();
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/Parsedown.php');
	
	//Prepares
	$useThisFile = "FAQ.md";
	$atThisPath = "./pages/documents/";
	$processingFileName = "";
	$content = "Failed to load document or document not exist.";
	
	if(isset($_REQUEST['f']) && trim($_REQUEST['f'])!="") {
		$processingFileName = $_REQUEST['f'];
	} else {
		$processingFileName = "FAQ";
	}
	
	if(is_file("{$atThisPath}custom/{$processingFileName}.{$OJ_LANGUAGE}.md")) {
		$atThisPath = "{$atThisPath}custom/";
		$useThisFile = "{$processingFileName}.{$OJ_LANGUAGE}.md";
	} else if(is_file("{$atThisPath}custom/{$processingFileName}.md")) {
		$atThisPath = "{$atThisPath}custom/";
		$useThisFile = "{$processingFileName}.md";
	} else if(is_file("{$atThisPath}{$processingFileName}.{$OJ_LANGUAGE}.md")) {
		$useThisFile = "{$processingFileName}.{$OJ_LANGUAGE}.md";
	} else if (is_file("{$atThisPath}{$processingFileName}.md")) {
		$useThisFile = "{$processingFileName}.md";
	}
	
	if (is_file("{$atThisPath}{$useThisFile}")) {
		$content = file_get_contents("{$atThisPath}{$useThisFile}");
	}
	
	//Page Includes
	require("./pages/document.php");
?>
	
