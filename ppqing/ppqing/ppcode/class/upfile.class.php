<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 * 文件上传类 
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class upfile {
	public $ExtensionFileFormat = array ();
	public $returninfo = array ();
	private $ImageFileFormat = array ('gif', 'bmp', 'jpg', 'jpe', 'jpeg', 'png' );
	private $OtherFileFormat = array ('zip', 'pdf', 'rar', 'xls', 'doc', 'ppt', 'csv' );
	private $savePath;
	private $attachment_path = './upfiles/';
	private $overwrite = false; # 同名时是否覆盖
	private $maxSize = 0; # 文件最大字节，为0时不限制大小
	private $ext;
	private $errno = 0;
	/* 构造函数
* (string)$savePath 文件保存路径，默认为$attachment_path
* (array)$extensionFileFormat 自定义上传文件的扩展名，未设置时为$ImageFileFormat || $OtherFileFormat
* (bool)$overwrite 是否覆盖同名文件
*/
	public function __construct($savePath = '', $extensionFileFormat = array(), $overwrite = true) {
		$this->savePath = empty ( $savePath ) ? $this->attachment_pathsavePath . '/' :$savePath;
		$this->extensionFileFormat = is_array ( $extensionFileFormat ) ? $extensionFileFormat : array ();
		$this->overwrite = is_bool ( $overwrite ) ? $overwrite : false;
	}
	/*上传函数
* (array)$files 待上传的文件数组$_FILES['attach']
* (number)$maxSize 文件的最大字节数，默认为0不限制上传大小
*/
	public function upload($files, $maxSize = 0) {
		$this->maxSize = is_numeric ( $maxSize ) ? $maxSize : 0;
		if (isset ( $files ) && is_array ( $files )) {
			if (is_array ( $files ['name'] )) {
				foreach ( $files as $key => $var ) {
					foreach ( $var as $id => $val ) {
						$attachments [$id] [$key] = $val;
					}
				}
			} else {
				$attachments [] = $files;
			}
		}
		self::check_file_type ( $attachments );
		if (empty ( $this->filelist )) {
			$this->log .= "待上传的文件列表为空。\n";
			return array ();
		}
		if (! self::makeDirectory () || ! @is_writable ( $this->savePath )) {
			$this->log .= $this->savePath . "不能创建或其权限为不可写。\n";
			return array ();
		}
		$filearray = array ();
		//file_put_contents('log.txt',serialize($this->filelist ));
		foreach ( $this->filelist as $k => $f ) {
			if($f['type']=='image/jpeg'||$f['type']=='image/jpg'){
				$imagetype='.jpg';
			}else if($f['type']=='image/gif'){
				$imagetype='.gif';
			}else if($f['type']=='image/png'){
				$imagetype='.png';
			}
			$f ['name']=md5($f ['name']+time()).$imagetype;
			if ($this->maxSize && $f ['size'] > $this->maxSize) {
				$this->log .= $f ['name'] . "其大小超过了设定的值：" . $this->maxSize . "\n";
			} elseif ($this->overwrite == false && file_exists ( $this->savePath . $f ['name'] )) {
				$this->log .= $f ['name'] . "已经存在于目录：" . $this->savePath . "\n";
			} else {
				@unlink ( $this->savePath . $f ['name'] );
				if (@move_uploaded_file ( $f ['tmp_name'], $this->savePath . mb_convert_encoding ( $f ['name'], 'gbk', 'utf-8' ) )) { //如果不进行编码转换，中文将无法支持
					$this->log .= $f ['name'] . "成功上传到目录：" . $this->savePath . "\n";
					$filearray [$k] = $this->savePath . $f ['name'];
				} else {
					$this->log .= $f ['name'] . "上传失败。\n";
				}
			}
		}
		return $filearray;
	}
	/*检测文件的类型
*(array)$files 文件数组
*/
	private function check_file_type($files) {
		$this->filelist = array ();
		foreach ( $files as $key => $file ) {
			if ($file ['error'] == 0) {
				$ext = strtolower ( substr ( $file ['name'], strrpos ( $file ['name'], '.' ) + 1 ) );
				$str = @file_get_contents ( $file ['tmp_name'], FALSE, NULL, 0, 20 );
				if ((in_array ( $ext, array ('jpg', 'jpeg' ) ) && substr ( $str, 0, 3 ) !== "\xFF\xD8\xFF") || ($ext == 'gif' && substr ( $str, 0, 4 ) !== 'GIF8') || ($ext == 'png' && substr ( $str, 0, 8 ) !== "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A") || ($ext == 'bmp' && substr ( $str, 0, 2 ) !== 'BM') || ($ext == 'swf' && (substr ( $str, 0, 3 ) !== 'CWS' || substr ( $str, 0, 3 ) !== 'FWS')) || ($ext == 'zip' && substr ( $str, 0, 4 ) !== "PK\x03\x04") || ($ext == 'rar' && substr ( $str, 0, 4 ) !== 'Rar!') || ($ext == 'pdf' && substr ( $str, 0, 4 ) !== "\x25PDF") || ($ext == 'chm' && substr ( $str, 0, 4 ) !== 'ITSF') || ($ext == 'rm' && substr ( $str, 0, 4 ) !== "\x2ERMF") || ($ext == 'exe' && substr ( $str, 0, 2 ) !== "MZ") || (in_array ( $ext, array ('doc', 'xls', 'ppt' ) ) && substr ( $str, 0, 4 ) !== "\xD0\xCF\x11\xE0")) {
					$this->log .= $file ['name'] . "文件类型与文件内容不符合。\n";
				} elseif ((! empty ( $this->extensionFileFormat ) && in_array ( $ext, $this->extensionFileFormat )) || (empty ( $this->extensionFileFormat ) && (in_array ( $ext, $this->ImageFileFormat ) || in_array ( $ext, $this->OtherFileFormat )))) {
					$this->filelist [$key] = $file;
				} else {
					$this->log .= $file ['name'] . "不符合上传文件的类型。\n";
					@unlink ( $file ['tmp_name'] );
				}
			}
		}
	}
	/*生成上传目录
*
*/
	private function makeDirectory() {
		$directoryName = str_replace ( "\\", "/", $this->savePath );
		$dirNames = explode ( '/', $directoryName );
		$total = count ( $dirNames );
		$temp = '';
		for($i = 0; $i < $total; $i ++) {
			$temp .= $dirNames [$i] . '/';
			if (! is_dir ( $temp )) {
				$oldmask = @umask ( 0 );
				if (! @mkdir ( $temp, 0777 ))
					return false;
				@umask ( $oldmask );
			}
		}
		;
		if (is_dir ( $this->savePath )) {
			return true;
		} else {
			return false;
		}
		;
	}
}
?>
