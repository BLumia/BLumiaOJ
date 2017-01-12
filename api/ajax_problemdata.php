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
	
	function formatSizeUnits($bytes) {
		if ($bytes >= 1073741824) {
			$bytes = number_format($bytes / 1073741824, 2) . ' GiB';
		} elseif ($bytes >= 1048576) {
			$bytes = number_format($bytes / 1048576, 2) . ' MiB';
		} elseif ($bytes >= 1024) {
			$bytes = number_format($bytes / 1024, 2) . ' KiB';
		} elseif ($bytes >= 1) {
			$bytes = $bytes . ' B';
		} else {
			$bytes = '0 B';
		}
		return $bytes;
	}
	
	//Prepare
	$dataFolderPath = "../../BLumiaOJ-Misc/Archives/problems";//$OJ_PROBLEM_DATA;
	$problemID = intval($_POST['pid']);
	
	$actualDataFolder = $dataFolderPath."/".$problemID;
	$fileList = scandir($actualDataFolder);
	$resultList = array();
	
	foreach($fileList as $oneFileName) {
		$fileExt = getFileExtension($oneFileName);
		$fileSize =  formatSizeUnits(filesize($actualDataFolder."/".$oneFileName));
		if ($fileExt == 'in' || $fileExt == 'out') {
			$fileName = basename($oneFileName, ".{$fileExt}");
			array($fileExt=>true);
			if(!isset($resultList[$fileName])) $resultList[$fileName] = array($fileExt=>$fileSize);
			else $resultList[$fileName][$fileExt]=$fileSize;
		}
	}
	
	exit(json_encode($resultList));
?>