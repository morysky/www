<?php
if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$new_file_name = new_name( $_FILES['Filedata']['name']);
	$targetFile =  str_replace('//','/',$targetPath) . $new_file_name;

		move_uploaded_file($tempFile,$targetFile);
		//防止中文文件名乱码
		//move_uploaded_file($tempFile,iconv('utf-8','gbk', $targetFile));
        
		//返回文件相对地址
		$data=get_relative_path($targetFile);
		$match=explode(".",$data);
		image_resize($data,$match[0]."_small.".$match[1],160,160);
		//image_resize($data,$match[0]."_middle.".$match[1],510,360);
		
		echo $match[0]."_small.".$match[1];
}

/*重命名文件*/
 function new_name($filename){
	$ext = pathinfo($filename);
	$ext = $ext['extension'];
	$name = basename($filename,$ext); 
	$name = md5($name.time()).'.'.$ext;
	return $name;
 }

/*获取文件相对路径*/
 function get_relative_path($path,$dir = 'uploads'){
	return substr($path,strpos($path,$dir),strlen($path ));
 }
 
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