<?php
	define("OJ_INITED", "This const marks for we are included the setting_oj.inc.php file.");
	$OJ_PATH = dirname(dirname(__FILE__));
	
	$OJ_IS_SAMPLE_CFG = null;
	if (file_exists("{$OJ_PATH}/include/config.php")) {
		require_once("{$OJ_PATH}/include/config.php");
		$OJ_IS_SAMPLE_CFG = false;
	} else if (file_exists("{$OJ_PATH}/include/config.sample.php")) { 
		require_once("{$OJ_PATH}/include/config.sample.php");
		$OJ_IS_SAMPLE_CFG = true;
	} else {
		exit("Error: Missing Configure file. Check your <b>OJ_PATH/include/config.php</b>");
	}

	require("{$OJ_PATH}/include/setting_db.inc.php");
	
	if(file_exists("{$OJ_PATH}/language/{$OJ_LANGUAGE}.inc.php")) {
		require("{$OJ_PATH}/language/{$OJ_LANGUAGE}.inc.php");
	} else {
		require("{$OJ_PATH}/language/english.inc.php");
	}
	
	if (isset($ON_ADMIN_PAGE)) {
		if(file_exists("{$OJ_PATH}/language/{$OJ_LANGUAGE}.admin.inc.php")) {
			require("{$OJ_PATH}/language/{$OJ_LANGUAGE}.admin.inc.php");
		} else {
			require("{$OJ_PATH}/language/english.admin.inc.php");
		}
	}

	if ($DEV_DISPLAY_ERRORS)
		ini_set("display_errors","Off");
	date_default_timezone_set("PRC");
?>