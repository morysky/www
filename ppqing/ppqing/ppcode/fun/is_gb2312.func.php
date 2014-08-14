<?php
/**
 * 判断字符串的编码
 * @param $str
 */
function is_gb2312($str)
{
	for($i=0; $i<strlen($str); $i++) {
		$v = ord( $str[$i] );
		if( $v > 127) {
			if( ($v >= 228) && ($v <= 233) ){
				if( ($i+2) >= (strlen($str) - 1)) return true;  // not enough characters
				$v1 = ord( $str[$i+1] );
				$v2 = ord( $str[$i+2] );
				if( ($v1 >= 128) && ($v1 <=191) && ($v2 >=128) && ($v2 <= 191) )
					return false;	//UTF-8编码
				else
					return true;	//GB编码
			}
		}
	}
}

 ?>