<?php
	/*  
		API for discuss forum.
		All request send via POST method:
		
		Post new thread(require user login):
			`do` = 'postthread' 
			`content` required, content of the new thread.
			`title` required, title of the new thread.
			`pid` optional. post thread to special problem.
			`cid` optional. idk wtf it is.
			
		Post reply(require user login):
			`do` = 'postthread' 
			`content` required, content of the reply.
			`tid` required. post reply to which thread.

	*/
	session_start();
	
	require_once("../include/setting_oj.inc.php");
	require_once("../include/common_functions.inc.php");
	require_once('../include/safe_func.inc.php');
	
	//Prepare
	$pid = (isset($_REQUEST['pid']) && $_REQUEST['pid']!='') ? intval($_REQUEST['pid']) : null;
	$cid = (isset($_REQUEST['cid']) && $_REQUEST['cid']!='') ? intval($_REQUEST['cid']) : null;
	$tid = (isset($_REQUEST['tid']) && $_REQUEST['tid']!='') ? intval($_REQUEST['tid']) : null;
	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
	$action = isset($_REQUEST['do']) ? $_REQUEST['do'] : "threadlist";
	// what? no pager?
	
	function isPostFreqTooHigh($user_id, $seconds, $pdo) {
		$ckeckTime=strftime("%Y-%m-%d %X",time()-$seconds);
		$sql=$pdo->prepare("SELECT `time` from `reply` where `author_id`=? and `time`>? limit 1");
		$sql->execute(array($user_id,$ckeckTime));
		$existChecker = $sql->fetchAll(PDO::FETCH_ASSOC);
		$existCounter = count($existChecker);
		return $existCounter == 1;
	}

	
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
			if ($tid == null) fire(400, "Missing Topic ID parameter.");
			$sql=$pdo->prepare("SELECT `title`, `cid`, `pid`, `status`, `top_level` FROM `topic` WHERE `tid` = ? AND `status` <= 1");
			$sql->execute(array($tid));
			$threadInfo=$sql->fetch(PDO::FETCH_ASSOC);
			$sql=$pdo->prepare("SELECT `rid`, `author_id`, `time`, `content`, `status` FROM `reply` WHERE `topic_id` = ? AND `status` <=1 ORDER BY `rid` LIMIT 30");
			$sql->execute(array($tid));
			$replies=$sql->fetchAll(PDO::FETCH_ASSOC);
			foreach($replies as &$row) {
				$row['content'] = nl2br($row['content']);
			}
			$result=compact("threadInfo", "replies");
			fire(200, "OK", $result);
			break;
			
		case 'postthread':
			if (is_null($user_id)) fire(403, "Please Login First.");
			if (!isset($_POST['content']) || !isset($_POST['title'])) fire(400, "Missing required parameters.");
			$title = htmlspecialchars($_POST['title']);
			$content = RemoveXSS(UBB2Html(htmlspecialchars($_POST['content'])));
			if (empty($title) || empty($content)) fire(400, "Title or content can't be empty.");
			if (isPostFreqTooHigh($user_id,$FORUM_SUBMIT_DELTATIME,$pdo)) fire(403, "You post too fast, take a rest and try again!");
			$pidStr = is_null($pid) ? 0 : intval($pid);
			$cidStr = is_null($cid) ? "NULL" : intval($cid);
			$sqlStr="INSERT INTO `topic` (`title`, `author_id`, `cid`, `pid`) SELECT ?, ?, {$cidStr}, '{$pidStr}'";
			if($pid != null && $pid != 0) {
				if($cid != null && $cid != 0) {
					$sqlStr.=" FROM `contest_problem` WHERE `contest_id` = {$cid} AND `problem_id` = '{$pid}'";
				} else {
					$sqlStr.=" FROM `problem` WHERE `problem_id` = '{$pid}'";
				}
			} else if($cid != null && $cid != 0) {
				$sqlStr.=" FROM `contest` WHERE `contest_id` = {$cid}";
			}
			$sqlStr.=" LIMIT 1";
			$sql=$pdo->prepare($sqlStr);
			$state = $sql->execute(array($title, $user_id));
			if (!$state) fire(500, "Unable to post new thread.");
			$tid = $pdo->lastinsertid();
			// Adding content block.
			$sql=$pdo->prepare("INSERT INTO `reply` (`author_id`, `time`, `content`, `topic_id`,`ip`) SELECT ?, NOW(), ?, ?, ? FROM `topic` WHERE `tid` = ? AND `status` = 0 ");
			$state = $sql->execute(array($user_id, $content, $tid, $_SERVER['REMOTE_ADDR'], $tid));
			fire(200, "OK", array("tid"=>$tid));
			break;
			
		case 'postreply':
			if (is_null($user_id)) fire(403, "Please Login First.");
			if (!isset($_POST['content'])) fire(400, "Missing `content` parameter.");
			if (empty($_POST['content'])) fire(400, "`content` can't be empty.");
			if (isPostFreqTooHigh($user_id,$FORUM_SUBMIT_DELTATIME,$pdo)) fire(403, "You post too fast, take a rest and try again!");
			$content = RemoveXSS(UBB2Html(htmlspecialchars($_POST['content'])));
			$sql=$pdo->prepare("INSERT INTO `reply` (`author_id`, `time`, `content`, `topic_id`,`ip`) SELECT ?, NOW(), ?, ?, ? FROM `topic` WHERE `tid` = ? AND `status` = 0 ");
			$state = $sql->execute(array($user_id, $content, $tid, $_SERVER['REMOTE_ADDR'], $tid));
			fire(200, "OK", array("tid"=>$tid));
			break;
		
		default:
			fire(400, "Wrong 'do' parameter.");
	}
	

?>