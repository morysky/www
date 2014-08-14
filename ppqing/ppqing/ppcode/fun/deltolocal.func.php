<?php
/**
 * 远程图片本地化
 */



function deltolocal($con){

	preg_match_all('/(<img[^>]+src\s*=\s*"?([^>"\s]+)"?[^>]*>)/im', $con, $matches);

	$imgs=$matches[2];
	$oldimgs=array();
	$newimgs=array();
	foreach($imgs as $key => $values){
	
		if(preg_match('/remotepic/isU',$values,$matche2)){
			unlink($values);
		}
		
	}
	
	
	return 0;
	
}


?>