<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 * 图片处理类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/

class MakeMiniature {
	var $srcFile;
	var $dstFile;
	var $fileType;
	var $im;
	var $imgType = array ("jpg", "JPG", "gif", "png", "bmp" );
	/**

	 *@param string $fileName 
	 *@return boolean 
	 */
	function findType($fileName) {
		$type = pathinfo ( $fileName );
		$var = $type ['extension'];
		for($i = 0; $i <= count ( $this->imgType ); $i ++) {
			if (Strcmp ( $this->imgType [$i], $var ) == 0) {
				$this->fileType = $var;
				return true;
			}
		}
		return false;
	}
	/**
	 *@param $fileType 
	 *@return resource 
	 */
	function loadImg($fileType) {
		$type = $this->isNull ( $fileType );
		switch ($type) {
			case "jpg" :
				$im = ImageCreateFromjpeg ( $this->srcFile );
				break;
			case "JPG" :
				$im = ImageCreateFromjpeg ( $this->srcFile );
				break;
			case "gif" :
				$im = ImageCreateFromGIF ( $this->srcFile );
				break;
			case "png" :
				$im = imagecreatefrompng ( $this->srcFile );
				break;
			case "bmp" :
				$im = imagecreatefromwbmp ( $this->srcFile );
				break;
			default :
				$im = 0;
				echo "not you input file type!
";
				break;
		}
		$this->im = $im;
		return $im;
	}
	/**

	 */
	function isNull($var) {
		if (! isset ( $var ) || empty ( $var )) {
			echo "！
";
			exit ( 0 );
		}
		return $var;
	}
	/**


	 *@param string srcFile 
	 *@param String dstFile 
	 */
	function setParam($srcFile, $dstFile) {
		$this->srcFile = $this->isNull ( $srcFile );
		$this->dstFile = $this->isNull ( $dstFile );
		if (! $this->findType ( $srcFile )) {
			echo "file type error!asdfas";
		}
		if (! $this->loadImg ( $this->fileType )) {
			echo "open " . $this->srcFile . "error!
";
		}
	}
	/**
	 *@param resource im 
	 *@return int width 
	 */
	function getImgWidth($im) {
		$im = $this->isNull ( $im );
		$width = imagesx ( $im );
		return $width;
	}
	/**
	 *@param resource im 
	 *@return int height 
	 */
	function getImgHeight($im) {
		$im = $this->isNull ( $im );
		$height = imagesy ( $im );
		return $height;
	}
	/**
	 *@param resource im 
	 *@param int scale 
	 *@param boolean page 
	 */
	function createImg($im, $scale, $page) {
		$im = $this->isNull ( $im );
		$scale = $this->isNull ( $scale );
		$srcW = $this->getImgWidth ( $im );
		$srcH = $this->getImgHeight ( $im );
		$detW = round ( $srcW * $scale / 100 );
		$detH = round ( $srcH * $scale / 100 );
		//$om=ImageCreate($detW,$detH);
		$om = imagecreatetruecolor ( $detW, $detH );
		//ImageCopyResized($om,$im,0,0,0,0,$detW,$detH,$srcW,$srcH);
		imagecopyresampled ( $om, $im, 0, 0, 0, 0, $detW, $detH, $srcW, $srcH );
		$this->showImg ( $om, $this->fileType, $page );
	
	}
	/**
	 *@param resource im 
	 *@param int scale 
	 *@param boolean page 
	 */
	function createNewImg($im, $width, $height, $page) {
		$im = $this->isNull ( $im );
		//$scale=$this->isNull($scale);
		$srcW = $this->getImgWidth ( $im );
		$srcH = $this->getImgHeight ( $im );
		$detW = $this->isNull ( $width );
		$detH = $this->isNull ( $height );
		//$om=ImageCreate($detW,$detH);
		$om = imagecreatetruecolor ( $detW, $detH );
		//ImageCopyResized($om,$im,0,0,0,0,$detW,$detH,$srcW,$srcH);
		imagecopyresampled ( $om, $im, 0, 0, 0, 0, $detW, $detH, $srcW, $srcH );
		$this->showImg ( $om, $this->fileType, $page );
	
	}
	/**
	 *@param boolean boolean 
	 */
	function inputError($boolean) {
		if (! $boolean) {
			echo "img input error!
";
		}
	}
	/**
	 *@param resource $om 
	 *@param String $type 
	 *@param boolean $page 
	 */
	function showImg($om, $type, $page) {
		$om = $this->isNull ( $om );
		$type = $this->isNull ( $type );
		switch ($type) {
			case "jpg" :
				if ($page) {
					$suc = imagejpeg ( $om );
					$this->inputError ( $suc );
				} else {
					$suc = imagejpeg ( $om, $this->dstFile );
					$this->inputError ( $suc );
				}
				break;
			case "JPG" :
				if ($page) {
					$suc = imagejpeg ( $om );
					$this->inputError ( $suc );
				} else {
					$suc = imagejpeg ( $om, $this->dstFile );
					$this->inputError ( $suc );
				}
				break;
			case "gif" :
				if ($page) {
					$suc = imagegif ( $om );
					$this->inputError ( $suc );
				} else {
					$suc = imagegif ( $om, $this->dstFile );
					$this->inputError ( $suc );
				}
				break;
			case "png" :
				if ($page) {
					$suc = imagepng ( $om );
					$this->inputError ( $suc );
				} else {
					$suc = imagepng ( $om, $this->dstFile );
					$this->inputError ( $suc );
				}
				break;
			case "bmp" :
				if ($page) {
					$suc = imagewbmp ( $om );
					$this->inputError ( $suc );
				} else {
					$suc = imagewbmp ( $om, $this->dstFile );
					$this->inputError ( $suc );
				}
				break;
			default :
				echo "not you input file type!
";
				break;
		}
	}
}

?>
