<?php
	/*  
		API for test case file management.
		Require 'PROBLEM_EDITOR' privilege.
		
		POST:
			'pid' (required)
			'action' (if not posting, default variable will be 'ls')
			'filename' (optional, only some action need this variable)
			'file' (optional, only when action is uploading data)
		RETURN:
			case 'action' = 'ls'
				Return array of test case files, json encoded. grouped by test case name, contains a file size.
			case 'action' = 'rm' [required 'filename']
				Remove the data file by the given filename. return status of operation.
			case 'action' = 'cat' [required 'filename']
				Get the full text content of given filename and return it. if file not exist, return a json contains a 'status=false'.
			case 'action' = 'wget' [required 'filename']
				Download the data file of given filename. if file not exist, return a json contains a 'status=false'.
			case 'action' = 'upload' [required 'file']
		
	*/
	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!havePrivilege("PROBLEM_EDITOR")) {
		exit(json_encode(array("status"=>false)));
	}
	
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
	$dataFolderPath = $OJ_PROBLEM_DATA;
	$problemID = intval($_POST['pid']);
	$action = isset($_POST['action']) ? $_POST['action'] : 'ls';
	$actualDataFolder = $dataFolderPath."/".$problemID;
	
	switch($action) {
		case 'ls':
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
			
		case 'rm':
			$oneFileName = isset($_POST['filename']) ? $_POST['filename'] : null;
			if ($oneFileName == null) exit(json_encode(array("status"=>false)));
			
			exit(json_encode(array("status"=>unlink($actualDataFolder."/".$oneFileName))));
			
		case 'cat':
			$oneFileName = isset($_POST['filename']) ? $_POST['filename'] : null;
			if ($oneFileName == null) exit(json_encode(array("status"=>false)));
			
			exit(readfile($actualDataFolder."/".$oneFileName));
			
		case 'wget':
			$oneFileName = isset($_POST['filename']) ? $_POST['filename'] : null;
			if ($oneFileName == null) exit(json_encode(array("status"=>false)));
			header("Content-type: text/plain");
			header("Content-Disposition: attachment; filename=\"{$_POST['filename']}\"");
			header('Content-Length: ' . filesize($actualDataFolder."/".$oneFileName));
			@readfile($actualDataFolder."/".$oneFileName);
			
			exit();
			
		case 'upload':
			$allowedExts = array("in", "out");
			
			if(is_uploaded_file($_FILES['file']['tmp_name'])) {
				if (!in_array(getFileExtension($_FILES["file"]["name"]), $allowedExts)) exit(json_encode(array("status"=>false)));
				if (file_exists($actualDataFolder."/".$_FILES["file"]["name"])) unlink($actualDataFolder."/".$_FILES["file"]["name"]);
				$status = move_uploaded_file($_FILES['file']['tmp_name'], $actualDataFolder."/".$_FILES["file"]["name"]);
				
				exit(json_encode(array("status"=>$status, "type"=>$_FILES["file"]["type"])));
			} else {
				exit(json_encode(array("status"=>false)));
			}
		
		default:
			exit(json_encode(array("status"=>false)));
	}
	
	

?>