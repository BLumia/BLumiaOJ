<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>Status</title>
		<style>
tr > td.result {
  transition: background-color 0.5s;
  text-align: center;
}
tr > td.result:hover {
  background-color: rgba(255,255,255,0.25)!important;
  transition: background-color 0s ease 0.4s;
}
		</style>
	</head>	
	
<?php
	//Vars
	require_once("./include/setting_oj.inc.php");
	require_once('./include/common_const.inc.php');
	require_once('./include/user_check_functions.php');
	
	//Prepares
	$lang_count=count($LANGUAGE_EXT);
	$langmask=$OJ_LANGMASK;
	
	//Page
	$p=isset($_GET['p']) ? $_GET['p'] : 1;
	if($p<=1){$p=1;}
	$front=intval($p*$PAGE_ITEMS);
	
	//SQL Basic
	if(isset($_SESSION['administrator'])||isset($_SESSION['source_browser'])||(isset($_SESSION['user_id'])&&$_GET['user_id']==$_SESSION['user_id'])){
		if ($_SESSION['user_id']!="guest") $sql_str="SELECT * FROM `solution` WHERE contest_id is null ";
	} else {
		$sql_str="SELECT * FROM `solution` WHERE problem_id>0 and contest_id is null ";
	}
	$order_str=" ORDER BY `solution_id` DESC ";
	
	//Check "top" arg
	if (isset($_GET['top'])&&$_GET['top']!="") {
		$top=intval($_GET['top']);
		if ($top!=-1) $sql_str=$sql_str."AND `solution_id`<='{$top}' ";
	}
	
	//Check problem("pid") arg
	$problem_id="";
	if (isset($_GET['pid'])&&$_GET['pid']!="") {
		$problem_id=intval($_GET['pid']);
        if ($problem_id!=0) {
			$sql_str=$sql_str."AND `problem_id`='".$problem_id."' ";
		} else {
			$problem_id="";
		}
	}
	
	//Check UserID("uid") arg
	$user_id="";
	if (isset($_GET['uid'])&&$_GET['uid']!=""){
		$user_id=trim($_GET['uid']);
		if (isUseridExist($user_id,$pdo) && $user_id!=""){
			$sql_str=$sql_str."AND `user_id`='".$user_id."' ";
        } else {
			$user_id="";
		}
	}
	
	//Check "language" arg
	if (isset($_GET['language'])) $language=intval($_GET['language']);
	else $language=-1;
	if ($language>count($LANGUAGE_EXT) || $language<0) $language=-1;
	if ($language!=-1) {
        $sql_str=$sql_str."AND `language`='{$language}' ";
	}
	
	//Check "judgeresult" arg
	if (isset($_GET['judgeresult'])) $result=intval($_GET['judgeresult']);
	else $result=-1;
	if ($result>count($JUDGE_RESULT) || $result<0) $result=-1;
	if ($result!=-1) {
        $sql_str=$sql_str."AND `result`='{$result}' ";
	}
	
	//Ignore SIM stuff
	
	//SQL Complete
	$sql_str=$sql_str.$order_str." LIMIT {$PAGE_ITEMS}";
	//var_dump($sql_str);
	
	$sql=$pdo->prepare($sql_str);
	$sql->execute();
	$statusResult=$sql->fetchAll(PDO::FETCH_ASSOC);
	$totalCount=count($statusResult);
	//print_r($statusResult);
	
	//Prev and Next PAGE
	$prevPageTop = $totalCount == 0 ? '' : intval($statusResult[0]['solution_id']) + $PAGE_ITEMS;
	$nextPageTop = $totalCount == 0 ? '' : intval($statusResult[0]['solution_id']) - $PAGE_ITEMS;

	//Page Includes
	require("./pages/status.php");
?>
	
</html>