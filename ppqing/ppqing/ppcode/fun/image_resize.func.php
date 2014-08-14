<?php
/**************************************************
*  Created:  2010-06-13
*
*  图片按比例生成
*
*  @Author chuxuwang(chuxuwang@gmail.com)
*  
***************************************************/
function image_resize($f, $t, $tw, $th){
// 按指定大小生成缩略图，而且不变形，缩略图函数
// Cos.x 2007-9-5
        $temp = array(1=>'gif', 2=>'jpeg', 3=>'png');

        list($fw, $fh, $tmp) = getimagesize($f);

        if(!$temp[$tmp]){
                return false;
        }
        $tmp = $temp[$tmp];
        $infunc = "imagecreatefrom$tmp";
        $outfunc = "image$tmp";

        $fimg = $infunc($f);

        if($fw/$tw > $fh/$th){
                $fw = $tw * ($fh/$th);
        }else{
                $fh = $th * ($fw/$tw);
        }

        $timg = imagecreatetruecolor($tw, $th);
        imagecopyresampled($timg, $fimg, 0,0, 0,0, $tw,$th, $fw,$fh);
        if($outfunc($timg, $t)){
                return true;
        }else{
                return false;
        }
}
?>
