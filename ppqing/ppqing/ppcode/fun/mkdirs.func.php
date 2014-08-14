<?php
/**
 * 远程图片本地化
 */



function pictolocal($con){
	
	preg_match_all('/(<img[^>]+src\s*=\s*"?([^>"\s]+)"?[^>]*>)/im', $con, $matches);

	$imgs=$matches[2];
	$oldimgs=array();
	$newimgs=array();
	foreach($imgs as $key => $values){
		$theurl=parse_url($values);
		if(($theurl['host'])&&($theurl['host']!='shenpang.cc')&&($theurl['host']!='www.shenpang.cc'))
		{
			$oldimgs[$key]=$values;
			$picData=file_get_contents($values);
			
			$picinfo=explode('.', $values);
			$picend=end($picinfo);
			$path='remotepic/'.date('Y/m/d')."/";
			mkdirs($path);
			$picname=md5($values);
			$newimgs[$key]=$path.$picname.".".$picend;
			file_put_contents($newimgs[$key], $picData);
			
		}
		
	}
	
	if($newimgs)$con=str_replace($oldimgs, $newimgs, $con);
	return $con;
	
}

function mkdirs($dir)  
{  
	if(!is_dir($dir))  
	{  
	if(!mkdirs(dirname($dir))){  
	   return false;  
	}  
	if(!mkdir($dir,0777)){  
	   return false;  
	}  
	}  
	 return true;  
}  
?>