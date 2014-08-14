<?php 
/**
 * 得到xiami的音乐列表
 * @author chuxuwang(164935394@qq.com)
 */

$key=$_GET['key'];
$key2=$key;
$page=$_GET['page'];
$key=urlencode($key);
$url="http://www.xiami.com/app/nineteen/search/key/".$key."/logo/1/page/".$page;

$content=file_get_contents($url);
$json_string = json_decode($content);
echo "<ul>";
if($json_string->total>8){
	$num=8;
}else{
	$num=$json_string->total;
}
for($i=0;$i<$num;$i++){
	echo "<li onMouseOver=\"this.style.backgroundColor='#dddddd'\" onMouseOut=\"this.style.backgroundColor='#FFFFFF'\" onclick=addmusic('".$json_string->results[$i]->song_id."','".$json_string->results[$i]->album_logo."','".$json_string->results[$i]->song_name."(".$json_string->results[$i]->artist_name.")')>".urldecode($json_string->results[$i]->song_name)."(".urldecode($json_string->results[$i]->artist_name).")</li>";
	
}
echo "</ul>";
if($num==8)echo "<a href=javascript:getmusic('".$key2."',".($page+1).")>下一页</a>";
?>