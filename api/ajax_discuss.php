<?php
	/*  
		API for discuss forum.
		Require '' privilege.
		

	*/
	session_start();
	
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_functions.inc.php");
	
	//Prepare
	$pid = (isset($_REQUEST['pid']) && $_REQUEST['pid']!='') ? intval($_REQUEST['pid']) : null;
	$cid = (isset($_REQUEST['cid']) && $_REQUEST['cid']!='') ? intval($_REQUEST['cid']) : null;
	$tid = (isset($_REQUEST['tid']) && $_REQUEST['tid']!='') ? intval($_REQUEST['tid']) : null;
	$action = isset($_REQUEST['do']) ? $_REQUEST['do'] : "threadlist";
	// what? no pager?

	
	switch($action) {
		case 'threadlist':
			$cidCondition = $cid ? "AND (`cid` = '{$cid}' OR `top_level` = 3)" : "AND ISNULL(`cid`)";
			$pidCondition = $pid ? "AND (`pid` = '{$pid}' OR `top_level` >= 2)" : "";
			$lvCondition  = $pid ? "" : "- ( `top_level` = 1 AND `pid` != 0 )";
			// About page level:
			// 1:题目置顶, 2:分区置顶, 3:总置顶
			// 分区???????????????
			$sqlStmt = "SELECT `tid`, `title`, `top_level`, `topic`.`status`, `cid`, `pid`, CONVERT(MIN(`reply`.`time`),DATE) `posttime`, MAX(`reply`.`time`) `lastupdate`, `topic`.`author_id`, COUNT(`rid`) `count` 
				FROM `topic`, `reply` 
				WHERE `topic`.`status`!=2 AND `reply`.`status`!=2 AND `tid` = `topic_id` {$cidCondition} {$pidCondition}
				GROUP BY `topic_id` ORDER BY `top_level` {$lvCondition} DESC, MAX(`reply`.`time`) DESC LIMIT 30";
		
			$sql=$pdo->prepare($sqlStmt);
			$sql->execute();
			$result=$sql->fetchAll(PDO::FETCH_ASSOC);
			fire(200, "OK", $result);
			break;

		case 'replylist':
			$sql=$pdo->prepare("SELECT `title`, `cid`, `pid`, `status`, `top_level` FROM `topic` WHERE `tid` = ? AND `status` <= 1");
			$sql->execute(array($tid));
			$threadInfo=$sql->fetch(PDO::FETCH_ASSOC);
			$sql=$pdo->prepare("SELECT `rid`, `author_id`, `time`, `content`, `status` FROM `reply` WHERE `topic_id` = ? AND `status` <=1 ORDER BY `rid` LIMIT 30");
			$sql->execute(array($tid));
			$replies=$sql->fetchAll(PDO::FETCH_ASSOC);
			$result=compact("threadInfo", "replies");
			fire(200, "OK", $result);
			
		default:
			fire(400, "Wrong 'do' parameter.");
	}
	

?>