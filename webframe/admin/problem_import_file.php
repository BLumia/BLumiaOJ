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
	
	//functions
	function getAttribute($Node, $TagName,$attribute) {
		return $Node->children()->$TagName->attributes()-> $attribute;
	}
	
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
				
				echo $problem->title,"\n";
				
				$problem_title = $problem->title;
				$time_limit = $problem->time_limit;
				$unit = getAttribute($problem,'time_limit','unit');
				if($unit=='ms') $time_limit/=1000;
				$memory_limit = $problem->memory_limit;
				$unit=getAttribute($problem,'memory_limit','unit');
				if($unit=='kb') $memory_limit/=1024;
				$problem_desc = $problem->description;
				$problem_input = $problem->input;
				$problem_output = $problem->output;
				$samp_in_data = $problem->sample_input;
				$samp_out_data = $problem->sample_output;
				$problem_hint = $problem->hint;
				$problem_spj = trim($problem->spj)?1:0;
				$problem_source = $problem->source;
				
				$sql=$pdo->prepare("INSERT into `problem`
						(`title`,`time_limit`,`memory_limit`,`description`,`input`,`output`,`sample_input`,`sample_output`,`hint`,`source`,`spj`,`in_date`,`defunct`)
						VALUES(?,?,?,?,?,?,?,?,?,?,?,NOW(),'Y')");
				$sql->execute(array($problem_title,$time_limit,$memory_limit,$problem_desc,$problem_input,$problem_output,$samp_in_data,$samp_out_data,$problem_hint,$problem_source,$problem_spj));
				$pid = $pdo->lastinsertid();
				echo "Now Added Problem {$problem_title} , Problem ID:{$pid}<br/>";
			}
		}
	}
	
	//Page Includes
	require("./pages/problem_import.php");
?>
	
</html>