<?php
	/*  
		API for test case file management.
		Require operater (any kinds of) privilege.
		
		POST:
			'file' (required)
		RETURN:
			path of uploaded file.
	*/
	session_start();
	
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/user_check_functions.php");
	
	//Privilege Check
	if (!isOperator()) {
		exit(json_encode(array("status"=>false, "reason"=>"Missing privilege.")));
	}
	
	//Functions
	function getFileExtension($fileName) {
		$explodeArr = explode('.',$fileName);
		$explodeArr = array_reverse($explodeArr);  
		return strtolower($explodeArr[0]);
	}
	
	//Prepare
	$dataFolderPath = $OJ_UPLOAD_DATA;
	$actualDataFolder = $dataFolderPath.date('Y-m-d');
	$outPath = "/{$OJ_WWW_UPLOAD_PATH}/".date('Y-m-d')."/";
	
	//Do Work
	$allowedExts = array("gif", "jpeg", "jpg", "png", "bmp");
	
	if(!empty($_FILES['file']['tmp_name'])) {
	
		if(is_uploaded_file($_FILES['file']['tmp_name'])) {
			$urlencodedFileName = rawurlencode($_FILES["file"]["name"]);
			if (!file_exists($actualDataFolder)) mkdir($actualDataFolder);
			if (!in_array(getFileExtension($_FILES["file"]["name"]), $allowedExts)) exit(json_encode(array("status"=>false)));
			if (file_exists($actualDataFolder."/".$urlencodedFileName)) unlink($actualDataFolder."/".$urlencodedFileName);
			$status = move_uploaded_file($_FILES['file']['tmp_name'], $actualDataFolder."/".$urlencodedFileName);
			$outPath.=$urlencodedFileName;
			
			exit($outPath);
		}
	}
	
	exit(json_encode(array("status"=>false)));

?>