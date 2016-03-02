<?php session_start(); $ON_ADMIN_PAGE="Yap"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('../include/admin_head.inc.php'); ?>
		<title>Import Problem</title>
	</head>	
	
<?php
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once('../include/file_functions.php');
	
	//Prepares
	$maxFileSize=min(ini_get("upload_max_filesize"),ini_get("post_max_size"));
	
	if(isset($_POST["pageauth"])) { // uploading file.
		//check auth
		if ($_SESSION['SessionAuth']!=$_POST['pageauth']) {
			echo "Forbidden";
			exit(403);
		}
		//parse xml
		if ($_FILES["xmlFile"]["error"] > 0) {
			echo "Error: ".$_FILES["xmlFile"]["error"]."File size is too big, change in PHP.ini<br/>";
		} else {
			$xmlFile=simplexml_load_file($_FILES["xmlFile"]["tmp_name"]);
			$problemNodes = $xmlFile->xpath ("/fps/item");
			
			foreach($problemNodes as $problem) {
				//echo $problem->title,"\n";
			}
		}
	}
	
	//Page Includes
	require("./pages/problem_import.php");
?>
	
</html>