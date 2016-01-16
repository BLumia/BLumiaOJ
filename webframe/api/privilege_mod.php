<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
	
	//Admin Auth
	if (!(isset($_SESSION['administrator']))){
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
    
	$do			=intval($_GET['do']);
	$op_user_id	=$_GET['uid'];
	$privilege	=$_GET['privilege'];
	
	/*if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	if ($do = 1) { // Delete a privilege
		if ($_SESSION['SessionAuth']!=$_GET['getKey']) exit(403);
		$sql_str="DELETE FROM `privilege` WHERE user_id='$op_user_id' and rightstr='$privilege'";
		$affectedRowCnt = $pdo->exec($sql_str);
		if ($affectedRowCnt > 0) echo "Delete ".$affectedRowCnt." rows from Privilege database.<br/>";
	
	}
	
?>
