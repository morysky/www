<?php
/**
 * 对非法的字符进行过滤。
 * @param $str
 */
 function savacom($str) 
 { 
 	$str=preg_replace('/<div id="livemargins_control"(.*)+<\/div>/isU','',$str);
   $farr = array(                                                                                          
   "/<(\/?)(script|i?frame|table|div|img|p|tr|td|font|br|strong|tbody|a|h1|h2|h3|h4|h5|h6|html|style|body|span|title|link|meta)([^>]*?)>/isU",   
   "/(<[^>]*)on[a-zA-Z]+s*=([^>]*>)/isU",                                      
    
    ); 
    $tarr = array( 
   "",           //如果要直接清除不安全的标签，这里可以留空 
   "\1\2", 
    ); 
 
   $str = preg_replace($farr,$tarr,$str); 
 $str = preg_replace("/style=.+?['|\"]/i",'',$str);//去除样式 
    return $str; 
 }
 ?>