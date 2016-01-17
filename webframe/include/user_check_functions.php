<?php

	function isOperator() {
		if (isset($_SESSION['administrator']) || isset($_SESSION['op_ProblemEditor']) || isset($_SESSION['op_ContestEditor']) || isset($_SESSION['op_PageModifier']) || isset($_SESSION['op_UserManager'])) {
			return true;
		} else {
			if (isset($_SESSION['http_judge'])) return true;//暂留
			return false;
		}
	}
	
	function isOpTag($str) {
		if ($str=='administrator' || $str=='op_ProblemEditor' || $str=='op_ContestEditor' || $str=='op_PageModifier' || $str=='op_UserManager') {
			return true;
		} else {
			return false;
		}
	}
	
	function isUseridExist($userid,$pdo) {
		$sql=$pdo->prepare("SELECT `user_id` FROM `users` WHERE `users`.`user_id` =?");
		$sql->execute(array($userid));
		$result=$sql->fetchAll();
		$user_cnt = count($result); 
		if ($user_cnt >= 1){
			return true;
		}
		return false;
	}

?>
