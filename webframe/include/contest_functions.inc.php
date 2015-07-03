<?php
	function formatTimeLength($length) {
	/*
		给定秒数得到实际时间长度...
		l18n注意
	*/
		$hour = 0;
		$minute = 0;
		$second = 0;
		$result = '';
		
		if ($length >= 60) {
			$second = $length % 60;
			if ($second > 0) {
				$result = $second . '秒';
			}
			$length = floor($length / 60);
			if ($length >= 60) {
				$minute = $length % 60;
				if ($minute == 0) {
					if ($result != '') {
						$result = '0分' . $result;
					}
				} else {
					$result = $minute . '分' . $result;
				}
				$length = floor($length / 60);
				if ($length >= 24) {
					$hour = $length % 24;
					if ($hour == 0) {
						if ($result != '') {
							$result = '0小时' . $result;
						}
					} else {
						$result = $hour . '小时' . $result;
					}
					$length = floor($length / 24);
					$result = $length . '天' . $result;
				} else {
					$result = $length . '小时' . $result;
				}
			} else {
				$result = $length . '分' . $result;
			}
		} else {
			$result = $length . '秒';
		}
		return $result;
	}
?>
