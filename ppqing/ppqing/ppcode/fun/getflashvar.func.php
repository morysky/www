<?php
/**
 * 对非法的字符进行过滤。
 * @param $str
 */
 function getflashvar($link, $host) {
        $return='';
        $content = file_get_contents($link);//获取
        if('youku.com' == $host)
        {
        	preg_match("/id\_(\w+)[=.]/",$link,$flashvar);
        	preg_match("/\+0800\|(.*?)\|\">/i",$content,$img);
        	preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        	$flashvard='http://player.youku.com/player.php/sid/'.$flashvar[1].'=/v.swf';

        }
        elseif('ku6.com' == $host)
        {
            preg_match("/\/([\w\-]+)\.html/",$link,$flashvar);
        	preg_match("/<span class=\"s_pic\">(.*?)<\/span>/i",$content,$img);
        	preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        	$title[1] = iconv("GBK","UTF-8",$title[1]);
        	$flashvard='http://player.ku6.com/refer/'.$flashvar[1].'/v.swf';
        }
        elseif('sina.com.cn' == $host)
        {
        	preg_match("/vid=(.*?)\/s\.swf/",$content,$flashvar);
        	preg_match("/pic\:[ ]*\'(.*?)\'/i",$content,$img);
        	preg_match("/<title>(.*?)<\/title>/i",$content,$title);    
        	$flashvard='http://you.video.sina.com.cn/api/sinawebApi/outplayrefer.php/vid='.$flashvar[1].'/s.swf';    	
        }
        elseif('tudou.com' == $host)
        {
        	preg_match("/iid\_code[^']*\'([\w\-]+)\'/",$content,$flashvar);
        	preg_match("/pic\:[ ]*\"(.*?)\"/i",$content,$img);
        	preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        	$title[1] = iconv("GBK","UTF-8",$title[1]);
        	
        	$flashvard='http://www.tudou.com/v/'.$flashvar[1].'/v.swf';
//        	/echo $content;
        	//echo $flashvard;
        	//exit;
        }
 		elseif('youtube.com' == $host) {
 			
        }
        elseif('5show.com' == $host) {
        	
        }
        elseif('sohu.com' == $host) {        	
            preg_match("/vid=\"(.*?)\"/",$content,$flashvar);
        	preg_match("/cover=\"(.*?)\";/i",$content,$img);
        	preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        	$title[1] = iconv("GBK","UTF-8",$title[1]);
        	$flashvard='http://share.vrs.sohu.com/'.$flashvar[1].'/v.swf';
        }
        elseif('mofile.com' == $host)
        {
            preg_match("/\/([\w\-]+)\.shtml/",$link,$flashvar);
        	preg_match("/thumbpath=\"(.*?)\";/i",$content,$img);
        	preg_match("/<title>(.*?)<\/title>/i",$content,$title);
        	$flashvard='http://tv.mofile.com/cn/xplayer.swf?v='.$flashvar[1];
        }

        $return['flashvar'] = $flashvard;
        $return['img']   = $img[1];
        $return['title'] = $title[1];
        return $return;
}
 ?>