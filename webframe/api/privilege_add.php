<?php
	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
	require_once("../include/user_check_functions.php");
	
	//Admin Auth
	if (!(isset($_SESSION['administrator']))){
		echo "<a href='../loginpage.php'>Please Login First!</a>";
		exit(1);
	}
    
	$op_user_id	=$_POST['user_id'];
	$privilege	=$_POST['opTag'];
	
	/*if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	// Delete a privilege
	if (!isUseridExist($op_user_id,$pdo)) {
		echo "User Not Exist!";
		exit(0);
	}
	if (!isOpTag($privilege)) {
		echo "OpTag Not Exist!";
		exit(0);
	}
	$sql=$pdo->prepare("insert into `privilege` values(?,?,'N')");
	$sql->execute(array($op_user_id,$privilege));
	echo "Privilege Added Successful";
	exit(0);
	
?>
