<?php

	function utf8_substr($str,$start=0) {
	/*
		utf-8编码下截取中文字符串,参数可以参照substr函数
		@param $str 要进行截取的字符串
		@param $start 要进行截取的开始位置，负数为反向截取
		@param $end 要进行截取的长度
	*/
		if(empty($str)){
			return false;
		}
		if (function_exists('mb_substr')){
			if(func_num_args() >= 3) {
				$end = func_get_arg(2);
				return mb_substr($str,$start,$end,'utf-8');
			} else {
				mb_internal_encoding("UTF-8");
				return mb_substr($str,$start);
			}       
		} else {
			$null = "";
			preg_match_all("/./u", $str, $ar);
			if(func_num_args() >= 3) {
				$end = func_get_arg(2);
				return join($null, array_slice($ar[0],$start,$end));
			} else {
				return join($null, array_slice($ar[0],$start));
			}
		}
	}
	
	function pdo_real_escape_string($value, $pdo) {
		return substr($pdo->quote($value), 1, -1);       
	}
	
	function fire($status, $message, $result = null) {
	/*
		Ajax返回json，用于API。
		@param $status HTTP状态码
		@param $message 提示信息，正常则"OK"，不正常提示错误原因
		@param $result 待返回结果
	*/
		if ($result == null) unset($result);
		$httpStatusCode = array( 
			200 => "HTTP/1.1 200 OK",
			400 => "HTTP/1.1 400 Bad Request",
			401 => "HTTP/1.1 401 Unauthorized",
			403 => "HTTP/1.1 403 Forbidden",
			404 => "HTTP/1.1 404 Not Found",
			500 => "HTTP/1.1 500 Internal Server Error",
			501 => "HTTP/1.1 501 Not Implemented",
			503 => "HTTP/1.1 503 Service Unavailable",
			504 => "HTTP/1.1 504 Gateway Time-out"
		);
		header('Content-Type: application/json');
		@header($httpStatusCode[$statusCode]);
		exit(json_encode(compact("status", "message", "result")));
	}
?>
