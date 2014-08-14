<?php
/**************************************************
*  Created:  2010-06-13
*
*  内容过滤
*
*  @Author chuxuwang(chuxuwang@gmail.com)
*  
***************************************************/
function make_text($str,$did,$c){
		if($c==1){
	preg_match_all('/(<img[^>]+src\s*=\s*"?([^>"\s]+)"?[^>]*>)/im', $str, $matches);
    
	$imgs=$matches[2];
	foreach ($imgs as $key => $value){
		$arr=getimagesize($value); 
	if($arr[0]>500&&empty($theImg))
	{
		$theImg='<img width="500px" src='.$imgs[$key].' />';
	}else if($arr[0]>200&&empty($theImg)){
		$theImg='<img  src='.$imgs[$key].' />';
	}else if(empty($theImg)&&($key+1==count($imgs))){
		$theImg='<img  src='.$imgs[$key].' />';
	}
	
	
	}
	
	$thenewstr=preg_replace('/(<img[^>]+src\s*=\s*"?([^>"\s]+)"?[^>]*>)/isU','',$str);
	$thenewstr2=$thenewstr;
	$thenewstr=$theImg.APP::F('cut_strs',$thenewstr,240);
	
	$cut_newstr=$thenewstr.'<br><a style="color:#014A66" href="javascript:readmore('.$did.')">未完继续阅读</a>';
	if(empty($theImg)&&strlen($thenewstr2)<240){
		$cut_newstr=$str;
	}
	if(count($imgs)==1&&strlen($thenewstr2)<240){
		$cut_newstr=$str;
	}
	return $cut_newstr ;
		}else{
			return $str;
			
		}
	
	}
	
?>
