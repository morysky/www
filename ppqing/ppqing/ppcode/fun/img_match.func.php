<?php
/**************************************************
*  Created:  2010-06-13
*
*  内容过滤
*
*  @Author chuxuwang(chuxuwang@gmail.com)
*  
***************************************************/
function img_match($str){
		
	$newstext=preg_replace_callback('/(<img[^>]+src\s*=\s*"?([^>"\s]+)"?[^>]*>)/im', 'makeimg', $str);

	echo $newstext;	
	}
	function makeimg($matches){
		$imginfo=$matches[1];
		preg_match('/width:([^;]*);/isU',$imginfo,$match);
		if($match[1]>500){
			//$style='style="width:500px"';
				return '<a target=_blank rel="lightbox"  class="showoutimg"  href="'.$matches[2].'"><img style="width:500px"  src="'.$matches[2].' "></img></a>';
		}else{
				return '<a  target=_blank rel="lightbox"  class="showoutimg"  href="'.$matches[2].'"><img src="'.$matches[2].'"></img></a>';
		}
	
	}
?>
