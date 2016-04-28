<?php session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<?php require_once('./include/common_head.inc.php'); ?>
		<title>私信 - BLumiaOJ</title>
	</head>	
	
<?php
	//Vars
	require_once('./include/setting_oj.inc.php');
	require_once('./include/safe_func.inc.php');
	
	//Prepares
	if (isset($_SESSION['user_id'])) {
		//User Logged in and wanna see him/herself's info.
		$user_id = $_SESSION['user_id'];
		
		$sql=$pdo->prepare("SELECT * FROM users WHERE user_id=?");
		$sql->execute(array($user_id));
		$res=$sql->fetch();
		//var_dump($res);
		$sql->closeCursor();
		
		$user_name = $res['nick'];
		$user_ac = $res['solved'];
		$user_submit = $res['submit'];
		$user_school = $res['school'];
		$user_email = $res['email'];
		
	} else {
		//TODO： 访问指定用户的用户页面，$_GET['user'];传入user_id
		exit(0);
	}
	
	$view_title="私信";
	$to_user="";
	$title="";
	if (isset($_GET['to_user'])){
		$to_user=htmlspecialchars($_GET['to_user']);
	}
	if (isset($_GET['title'])){
		$title=htmlspecialchars($_GET['title']);
	}
	
	if (!isset($_SESSION['user_id'])){
		echo "<a href=loginpage.php>要发送私信需要先登录</a>";
		exit(0);
	}
	
	//view mail
	$view_content=false;
	if (isset($_GET['vid'])){
		$vid=intval($_GET['vid']);
		$sql=$pdo->prepare("SELECT * FROM `mail` WHERE `mail_id`=".$vid." and to_user='".$_SESSION['user_id']."'");
		$sql->execute();
		$result=$sql->fetchAll();//$result[0]['content']
		$to_user=$result[0]['from_user'];
		$view_title=$result[0]['title'];
		$view_content=$result[0]['content'];
		$view_date=$result[0]['in_date'];
	
		$sql=$pdo->prepare("UPDATE `mail` SET new_mail=0 WHERE `mail_id`=".$vid);
		$sql->execute();
	}
	//send mail page
	//send mail
	if(isset($_POST['to_user'])){
		$to_user = $_POST ['to_user'];
		$title = $_POST ['title'];
		$content = $_POST ['content'];
		$from_user=$_SESSION['user_id'];
		if (get_magic_quotes_gpc ()) {
			$to_user = stripslashes ( $to_user);
			$title = stripslashes ( $title);
			$content = stripslashes ( $content );
		}
		$title = RemoveXSS($title);
		$to_user=$pdo->quote($to_user);
		$title=$pdo->quote($title);
		$content=RemoveXSS($content);
		$from_user=$pdo->quote($from_user);
		$content=$pdo->quote($content);
		
		$sql=$pdo->prepare("SELECT 1 FROM users WHERE user_id=".$to_user);
		$sql->execute();
		$res=$sql->fetchAll();//$res[0]['content']
		if (count($res)==0) {
			$view_title= "状态提示 :";
			$view_content="用户不存在!";
			$view_date="wwwwwww";
		} else {
			$sql=$pdo->prepare("INSERT INTO mail(to_user,from_user,title,content,in_date)
								VALUES($to_user,$from_user,$title,$content,now())");
			
			if(!$sql->execute()){
				$view_title=  "状态提示 :";
				$view_content="发送失败!";
				$view_date="这个问题需要反馈给管理员啦~";
			}else{
				$view_title=  "状态提示 :";
				$view_content="发送成功!";
				$view_date="可喜可贺，可喜可贺";
			}
		}
		$title = "";
		$to_user = "";
	}
	//list mail
	$sql=$pdo->prepare("SELECT * FROM `mail` WHERE to_user='".$_SESSION['user_id']."'
						ORDER BY mail_id DESC");
	$sql->execute();
	$res=$sql->fetchAll();//$res[$i]['mail_id']
	$view_mail=Array();
	
	for($i=0;$i<count($res);$i++){
		$view_mail[$i][0]=$res[$i]['mail_id'];
		if ($res[$i]['new_mail']) $view_mail[$i][0].= "<span class='badge'>New</span>";
		$view_mail[$i][1]="<a href='mail.php?vid=".$res[$i]['mail_id']."'>".$res[$i]['title']."</a>";
		$view_mail[$i][2]="<a href='userinfo.php?user=".$res[$i]['from_user']."'>".$res[$i]['from_user']."</a>";
		$view_mail[$i][3]=$res[$i]['in_date'];
		$view_mail[$i][4]="<a href='api/mail_delete.php?vid=".$res[$i]['mail_id']."'>删除</a>";
	}
	//Page Includes
	require("./pages/mail.php");
?>
	
</html>