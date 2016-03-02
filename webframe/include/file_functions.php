<?php
	/*创建问题对应的相应测试数据文件*/
	function mkdata($pid,$filename,$input,$OJ_DATA){
		$basedir = "$OJ_DATA/$pid";
		$fp = @fopen($basedir . "/$filename", "w");
		if($fp){
			fputs($fp, preg_replace( "(\r\n)", "\n", $input ));
			fclose($fp);
		}else{
			echo "Error while opening".$basedir . "/$filename ,try [chgrp -R www-data 	$OJ_DATA] and [chmod -R 771 $OJ_DATA ] ";	
		}
	}
	/*将base64编码的字符串解码并存储为文件*/
	function base64decode2File($savepath, $base64_encoded_file) {
		$fp=fopen($savepath ,"wb");
		fwrite($fp,base64_decode($base64_encoded_file));
		fclose($fp);
	}
?>
