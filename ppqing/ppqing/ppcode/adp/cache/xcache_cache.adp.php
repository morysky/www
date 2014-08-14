<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *xcache缓存
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/

class xcache_cache
{

	function xcache_cache() {

	}

	function adp_init($config=array()) {

	}

	function get($key) {
		return xcache_get($key);
	}

	function set($key, $value, $ttl = 0) {
		return xcache_set($key, $value, $ttl);
	}

	function delete($key) {
		return xcache_unset($key);
	}

}
?>