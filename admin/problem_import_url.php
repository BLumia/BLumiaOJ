<?php 
	session_start(); $ON_ADMIN_PAGE="Yap"; 
	//Vars
	require_once('../include/setting_oj.inc.php');
	require_once('../include/simple_html_dom.php');
	
	//Prepares
	$PROB_ID = 0;
	$PROB_SPJ = 0;
	
	if (isset($_GET['hdu_id']) && !empty($_GET['hdu_id'])) {
		
		$pid = intval($_GET['hdu_id']);
		$url = "http://acm.hdu.edu.cn/showproblem.php?pid=".$pid;
		$baseurl = "http://acm.hdu.edu.cn/";
		//if ($pid<1000 || $pid>9999) exit(0);
		$page_helper = "Imported from HDU ".$pid;
		$html = file_get_html($url);
		foreach($html->find('img') as $element)
			$element->src=$baseurl.$element->src;
			
		$element=$html->find('h1',0);
		$PROB_TITLE=$element->plaintext;
		$element=$html->find('span',0);
		$PROB_TIME=$element->plaintext; 
		$PROB_TIME=substr($PROB_TIME,12);
		$PROB_TIME=substr($PROB_TIME,strpos($PROB_TIME, '/')+1,strpos($PROB_TIME, ' MS') - strpos($PROB_TIME, '/'));
		$PROB_MEMORY=$element->plaintext;
		$PROB_MEMORY=substr($PROB_MEMORY, strpos($PROB_MEMORY, "Memory"));
		$PROB_MEMORY=substr($PROB_MEMORY, strpos($PROB_MEMORY, '/')+1,strpos($PROB_MEMORY, ' K') - strpos($PROB_MEMORY, '/'));
		$PROB_TIME/=1000;
		$PROB_MEMORY/=1000;
		
		$element=$html->find('div[class=panel_content]',0);
		$PROB_DESC=$element->outertext;
		$element=$html->find('div[class=panel_content]',1);
		$PROB_INPUT=$element->outertext;
		$element=$html->find('div[class=panel_content]',2);
		$PROB_OUTPUT=$element->outertext;
		
		$element=$html->find('pre',0);
		$element=$element->find('div',0);
		$PROB_SAMP_IN =$element->innertext;
		$element=$html->find('pre',1);
		$element=$element->find('div',0);
		$PROB_SAMP_OUT =$element->innertext;
		
		$PROB_HINT = "";
		
	} else if (isset($_GET['poj_id']) && !empty($_GET['poj_id'])) {
		$pid = intval($_GET['poj_id']);
		$url = "http://poj.org/problem?id=".$pid;
		$baseurl = "http://poj.org/";
		//if ($pid<1000 || $pid>9999) exit(0);
		$page_helper = "Imported from PKU POJ ".$pid;
		$html = file_get_html($url);
		foreach($html->find('img') as $element)
			$element->src=$baseurl.$element->src;
			
		$element=$html->find('div[class=ptt]',0);
		$PROB_TITLE=$element->plaintext;
		$element=$html->find('div[class=plm]',0);
		$PROB_TIME=$element->find('td',0);//->next_sibling();
		$PROB_TIME=substr($PROB_TIME->plaintext,11);
		$PROB_TIME=substr($PROB_TIME,0,strlen($PROB_TIME)-2);
		$PROB_MEMORY=$element->find('td',2);//->nextSibling();
		$PROB_MEMORY=substr($PROB_MEMORY->plaintext,13);
		$PROB_MEMORY=substr($PROB_MEMORY,0,strlen($PROB_MEMORY)-1);
		$PROB_TIME/=1000;
		$PROB_MEMORY/=1000;
		
		$element=$html->find('div[class=ptx]',0);
		$PROB_DESC=$element->outertext;
		$element=$html->find('div[class=ptx]',1);
		$PROB_INPUT=$element->outertext;
		$element=$html->find('div[class=ptx]',2);
		$PROB_OUTPUT=$element->outertext;
		
		$element=$html->find('pre[class=sio]',0);
		$PROB_SAMP_IN=$element->innertext;
		$element=$html->find('pre[class=sio]',1);
		$PROB_SAMP_OUT=$element->innertext;
		
		$PROB_HINT = "";
	} else {
		echo "未收到参数或参数错误";
		exit(0);
	}
	//Page Includes
	require("./pages/problem_mod.php");
?>
	
</html>