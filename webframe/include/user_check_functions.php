<?php

/*
	HustOJ:"administrator","problem_editor",  "source_browser","contest_creator", "http_judge","password_setter"
	BLOJ:  "administrator","op_ProblemEditor","op_SourceViewer","op_ContestEditor","http_judge","op_UserManager"
	New:   "op_PageModifier"
*/

	function havePrivilege($opTypeStr) {
		
		switch($opTypeStr) {
			case "SUPERUSER": // main administrator
				return isset($_SESSION['administrator']); break;
			case "PROBLEM_EDITOR":
				return (isset($_SESSION['administrator'])||isset($_SESSION['op_ProblemEditor'])); break;
			case "CONTEST_EDITOR":
				return (isset($_SESSION['administrator'])||isset($_SESSION['op_ContestEditor'])); break;
			case "USER_MANAGER":
				return (isset($_SESSION['administrator'])||isset($_SESSION['op_UserManager'])); break;
			case "PAGE_EDITOR":
				return (isset($_SESSION['administrator'])||isset($_SESSION['op_PageModifier'])); break;
			case "SOURCE_VIEWER":
				return (isset($_SESSION['administrator'])||isset($_SESSION['op_SourceViewer'])); break;
			case "JUDGER":
			case "ANUBIS":
				return (isset($_SESSION['administrator'])||isset($_SESSION['op_Judger'])||isset($_SESSION['http_judge'])); break;
		}
		
		return false;

	}

	function isOperator() {
		if (isset($_SESSION['administrator']) || isset($_SESSION['op_ProblemEditor']) || isset($_SESSION['op_ContestEditor']) || isset($_SESSION['op_PageModifier']) || isset($_SESSION['op_UserManager']) || isset($_SESSION['op_Judger'])) {
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
			if ($str=="http_judge") return true;//暂留
			return false;
		}
	}
	
	function opTagConverter($hustojTag) {
		switch($hustojTag) {
			case "administrator":
				return "administrator"; break;// i know this break is not neccessary = =
			case "problem_editor":
				return "op_ProblemEditor"; break;
			case "contest_creator":
				return "op_ContestEditor"; break;
			case "password_setter":
				return "op_UserManager"; break;
			case "source_browser":
				return "op_SourceViewer"; break;
			default:
				return $hustojTag;
		}
	}
	
	function isUseridExist($userid,$pdo) {
		$sql=$pdo->prepare("SELECT `user_id` FROM `users` WHERE `users`.`user_id` =?");
		$sql->execute(array($userid));
		$result=$sql->fetchAll(PDO::FETCH_ASSOC);
		$user_cnt = count($result); 
		if ($user_cnt >= 1){
			return true;
		}
		return false;
	}

?>
