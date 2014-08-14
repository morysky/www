<?php
/**************************************************
 * Created:  2010-06-13
 *
 * 内容过滤
 *
 * @Author chuxuwang(chuxuwang@gmail.com)
 * 
 ***************************************************/
function content_filter($strArr) {
	
	$data = file_get_contents ( 'var/data/disable/disable.txt' );
	$cache = unserialize ( $data );
	
	for($i = 0; $i < count ( $cache ); $i ++) {
		$noArr [$i] = '****';
	}
	if (is_array ( $strArr )) {
		foreach ( $strArr as $key => $value ) {
			if (is_array ( $value )) {
				foreach ( $value as $key2 => $value2 ) {
					$strArr [$key] [$key2] = str_replace ( $cache, $noArr, $value2 );
				}
			} else {
				$strArr [$key] = str_replace ( $cache, $noArr, $value );
			}
		}
		//file_put_contents('log9.txt',serialize($strArr));
		return $strArr;
	} else {
		$strArr = str_replace ( $cache, $noArr, $strArr );
		return $strArr;
	}

}
?>
