<?php
	/*  ***UNFINISHED***  */

	session_start();
	$ON_ADMIN_PAGE="Yap";
	require_once("../include/setting_oj.inc.php");
	require_once("../include/file_functions.php");
    
	$vj_problemid =$_POST['vj_pid'];
	$vj_language  =$_POST['vj_lang'];
	$vj_code      =$_POST['vj_code'];
	$vj_user_id   =$_POST['vj_user_id'];
	
	/*if (get_magic_quotes_gpc ()) {
		$user_id= stripslashes ( $user_id);
		$password= stripslashes ( $password);
	}*/
	
	$sql=$pdo->prepare("INSERT into `VJ_Solution`
						(`pid`,`lang`,`code`,`user_id`)
						VALUES(?,?,?,?)");
	$sql->execute(array($vj_problemid,$vj_language,$vj_code,$vj_user_id));
	$rid = $pdo->lastinsertid();
	
	echo "Submited run id: ".$rid;
	
?>
