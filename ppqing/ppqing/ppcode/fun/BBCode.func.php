<?php
/**************************************************

* 处理论坛的BBCode代码，返回经过替换后的HTML代码。 
* 
* @param string $string 输入字符串 
* @return srting 返回字符串 
*
*  @Author chuxuwang(chuxuwang@gmail.com)
*  
***************************************************/

function BBCode($string) 
{ 
    /* [url]URL[/ url] */ 
    $string = preg_replace("/\[url\](.*?)\[\/url\]/i",'<A target=_blank href="$1">$1</A>',$string); 
    /* [url=URL]URL描述[/ url] */ 
    $string = preg_replace("/\[url=(.*?)\](.*?)\[\/url\]/i",'<A target=_blank  href="$1">;$2</A>;',$string); 

    /* [b]粗体字[/ b]  */ 
    $string = preg_replace("/\[b](.*?)\[\/b\]/is",'<STRONG>;$1</STRONG>;',$string); 
    /* [i]斜体字[/ i] */ 
    $string = preg_replace("/\[i](.*?)\[\/i\]/is",'<EM>;$1</EM>;',$string); 
    /* [u]下划线[/ u] */ 
    $string = preg_replace("/\[u](.*?)\[\/u\]/is",'<U>;$1</U>;',$string); 
    /* [color=red]改变颜色[/ color] */ 
    $string = preg_replace("/\[color=(.*?)\](.*?)\[\/color\]/is",'<FONT color="$1">;$2</FONT>;',$string); 
    /* [size=4]改变字体大小[/ size] */ 
    $string = preg_replace("/\[size=(.*?)\](.*?)\[\/size\]/is",'<FONT size="$1">;$2</FONT>;',$string); 
    /* 改变字体[/ font] */ 
    $string = preg_replace("/\[font\](.*?)\[\/font\]/is",'<FONT face="$1">;$2</FONT>;',$string); 
   
    
    return $string; 
} 
?>
