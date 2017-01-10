<?php
	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	
	//Functions
	function getFileExtension($fileName) {
		$explodeArr = explode('.',$fileName);
		$explodeArr = array_reverse($explodeArr);  
		return strtolower($explodeArr[0]);
	}
	
	//Prepare
	$dataFolderPath = "../../BLumiaOJ-Misc/Archives/problems";//$OJ_PROBLEM_DATA;
	$problemID = intval($_POST['pid']);
	
	$actualDataFolder = $dataFolderPath."/".$problemID;
	$fileList = scandir($actualDataFolder);
	$resultList = array();
	
	foreach($fileList as $oneFileName) {
		$fileExt = getFileExtension($oneFileName);
		if ($fileExt == 'in' || $fileExt == 'out') {
			$fileName = basename($oneFileName, ".{$fileExt}");
			if(!isset($resultList[$fileName])) $resultList[$fileName] = array();
			array_push($resultList[$fileName], $fileExt);
		}
	}
	
	exit(json_encode($resultList));
?>