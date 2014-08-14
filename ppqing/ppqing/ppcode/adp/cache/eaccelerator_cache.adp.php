<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *缓存文件
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/

class eaccelerator_cache
{
	
	function eaccelerator_cache() {

	}

	function adp_init($config=array()) {

	}

	function get($key) {
		return eaccelerator_get($key);
	}

	function set($key, $value, $ttl = 0) {
		return eaccelerator_put($key, $value, $ttl);
	}

	function delete($key) {
		return eaccelerator_rm($key);
	}

}

?>