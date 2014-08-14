<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 * 框架核心类 APP类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/

//----------------------------------------------------------------------
/**
 * 获取一个变量值  APP::V 的同名函数
 * @param $vRoute	变量路由
 * @param $def		默认值
 * @return 			变量值
 */
function V($vRoute, $def = NULL, $setVar = false) {
	return APP::V ( $vRoute, $def, $setVar );
}

//----------------------------------------------------------------------
/**
 * 获取一个url APP::mkModuleUrl 的同名函数
 * @param $mRoute	模块路由
 * @param $qData	URL 参数可以是字符串如 "a=xxx&b=ooo" 或者数组 array('k'=>'k_var')
 * @param $entry	模块入口 默认为当前入口，可指定入口程序 如 admin.php
 * @return 			URL
 */
function URL($mRoute, $qData = false, $entry = false) {
	return APP::mkModuleUrl ( $mRoute, $qData, $entry );
}
//----------------------------------------------------------------------
/// cache
class CACHE {
	//------------------------------------------------------------------
	function CACHE() {
	}
	//------------------------------------------------------------------
	/**
	 * CACHE::getInstance();
	 * 获取当前缓存适配器的实例
	 * @return unknown_type
	 */
	function getInstance() {
		return APP::ADP ( 'cache', false );
	}
	//------------------------------------------------------------------
	function &instance() {
		static $c;
		if (empty ( $c )) {
			$c = APP::ADP ( 'cache' );
		}
		return $c;
	}
	//------------------------------------------------------------------
	/**
	 * CACHE::get($key);
	 * 获取缓存
	 * @param $key		缓存存储的 KEY
	 * @return 如果缓存存在并未过期则返回缓存值 ，否则返回   false
	 */
	function get($key) {
		//echo "\nGET:".$key."\n";
		$c = & CACHE::instance ();
		return $c->get ( $key );
	}
	//------------------------------------------------------------------
	/**
	 * CACHE::set($key, $value, $ttl = 0) ;
	 * 保存一个缓存
	 * @param $key		缓存  key
	 * @param $value	缓存值
	 * @param $ttl		有效时间 ，单位：秒
	 * @return 失败返回  false
	 */
	function set($key, $value, $ttl = 0) {
		//echo "\nSET:".$key."\n";
		$c = & CACHE::instance ();
		return $c->set ( $key, $value, $ttl );
	}
	//------------------------------------------------------------------
	/**
	 * CACHE::delete($key);
	 * 删除一个缓存
	 * @param $key	缓存  KEY
	 * @return 失败返回 false
	 */
	function delete($key) {
		$c = & CACHE::instance ();
		return $c->delete ( $key );
	}
	//------------------------------------------------------------------
	/**
	 * CACHE::gSet($gName, $key, $value, $ttl = 0);
	 * 建立一个缓存组
	 * @param $gName	缓存组名称
	 * @param $id		缓存组中的ID
	 * @param $ttl		有效时间 ，单位：秒
	 * @return 失败返回 false
	 */
	
	function gSet($gName, $id, $value, $ttl = 0) {
		//echo "CACHE GSET [$gName, $id, $ttl] \n";
		$gKey = GROUP_CACHE_KEY_PRE . ' ' . trim ( $gName );
		$vKey = $gKey . ' ' . trim ( $id );
		$gVer = CACHE::get ( $gKey );
		if (! $gVer) {
			$gVer = APP_LOCAL_TIMESTAMP . '_' . rand ( 1000000, 9999999 );
			//echo "SET GKEY: $gKey = $gVer \n";
			CACHE::set ( $gKey, $gVer, 0 );
		}
		$gData = array ('v' => $value, 'ver' => $gVer );
		return CACHE::set ( $vKey, $gData, $ttl );
	}
	/**
	 * CACHE::gGet($gName, $id);
	 * 获取某个缓存组中的缓存
	 * @param $gName	缓存组名称
	 * @param $id		缓存组中的ID
	 * @return 失败返回 false
	 */
	function gGet($gName, $id) {
		//echo "CACHE GGET [$gName, $id] \n";
		$gKey = GROUP_CACHE_KEY_PRE . ' ' . trim ( $gName );
		$vKey = $gKey . ' ' . trim ( $id );
		$gVer = CACHE::get ( $gKey );
		//echo "GET GKEY: #$gKey# = #$gVer# \n";
		if ($gVer) {
			$gData = CACHE::get ( $vKey );
			if (is_array ( $gData ) && $gData ['ver'] == $gVer) {
				return $gData ['v'];
			} else {
				//echo "CACHE : [$gName, $id] expired\n";
			}
		}
		CACHE::delete ( $vKey );
		return false;
	}
	/**
	 * CACHE::gDelete($gName);
	 * 删除某个缓存组
	 * @param $gName	缓存组名称
	 * @return 失败返回 false
	 */
	function gDelete($gName) {
		$gKey = GROUP_CACHE_KEY_PRE . ' ' . trim ( $gName );
		return CACHE::delete ( $gKey );
	}
}

//----------------------------------------------------------------------
class IO {
	//------------------------------------------------------------------
	function IO() {
	}
	//------------------------------------------------------------------
	/**
	 * IO::getInstance();
	 * 获取当前IO适配器实例
	 * @return IO 实例
	 */
	function getInstance() {
		return APP::ADP ( 'io', false );
	}
	//------------------------------------------------------------------
	function &instance() {
		static $c;
		if (empty ( $c )) {
			$c = APP::ADP ( 'io' );
		}
		return $c;
	}
	//------------------------------------------------------------------
	/**
	 * IO::ls($path,$r=false,$info=false);
	 * 获取某个目录的文件列表
	 * @param $path		要处理的目录
	 * @param $r		是否递归子目录
	 * @param $info		是否获取每个文件的文件信息
	 * @return 文件信息列表
	 */
	function ls($path, $r = false, $info = false) {
		$c = & IO::instance ();
		return $c->ls ( $path, $r, $info );
	}
	//------------------------------------------------------------------
	/**
	 * IO::write($file,$contents,$append=false);
	 * 写入一个文件
	 * @param $file			目标文件路径，如果目录结构不存在则自动创建
	 * @param $contents		文件内容
	 * @param $append		是否将内容追加到文件末尾，默认为 false 重写文件
	 * @return 写入字节数 失败返回 false
	 */
	function write($file, $contents, $append = false) {
		$c = & IO::instance ();
		return $c->write ( $file, $contents, $append );
	}
	/**
	 * IO::read($file);
	 * @param $file		目标文件路径
	 * @return 如果文件存在，返回内容 反之返回 false
	 */
	function read($file) {
		$c = & IO::instance ();
		return $c->read ( $file );
	}
	/**
	 * IO::mkdir($path);
	 * 生成目录结构，创建目录
	 * @param $path		目录结构
	 * @return 成功返回 true 失败返回 false
	 */
	function mkdir($path) {
		$c = & IO::instance ();
		return $c->mkdir ( $path );
	}
	/**
	 * IO::rm($path);
	 * 删除一个路径，如果是目录则删除它的子目录以及文件
	 * @param $path	要删除的目标路径
	 * @return 删除成功 返回 true 反之 返回 false
	 */
	function rm($path) {
		$c = & IO::instance ();
		return $c->rm ( $path );
	}
	/**
	 * IO::info($path,$key=false);
	 * 获取一个文件、目录的信息
	 * @param $path		目标路径
	 * @param $key		如果 $key 为空 返回所有文件信息  反之返回 文件信息中的  $key 项
	 * @return 文件信息
	 */
	function info($path, $key = false) {
		$c = & IO::instance ();
		return $c->info ( $path );
	}
	//------------------------------------------------------------------
}
//----------------------------------------------------------------------


?>
