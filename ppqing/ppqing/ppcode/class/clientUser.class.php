<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 * session的记录
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/

class clientUser {
	
	function clientUser() {
		if (! defined ( 'IS_SESSION_START' ) || ! IS_SESSION_START) {
			session_start ();
		}
		if (! isset ( $_SESSION [CLIENT_SESSION] ) || ! is_array ( $_SESSION [CLIENT_SESSION] )) {
			$_SESSION [CLIENT_SESSION] = array ();
		}
	}
	function resetInfo() {
		$_SESSION [CLIENT_SESSION] = array ();
	}
	
	function setInfo($k, $v = false) {
		if (is_array ( $k )) {
			$_SESSION [CLIENT_SESSION] = array_merge ( $_SESSION [ADMIN_SESSION], $k );
		} else {
			$_SESSION [CLIENT_SESSION] [$k] = $v;
		}
	}
	
	function getInfo($key = false) {
		$sStore = $_SESSION [CLIENT_SESSION];
		return $key ? (isset ( $sStore [$key] ) ? $sStore [$key] : NULL) : $sStore;
	}
	
	function delInfo($k) {
		if (! is_array ( $k )) {
			$k = array ($k );
		}
		foreach ( $k as $kv ) {
			if (isset ( $_SESSION [CLIENT_SESSION] [$kv] )) {
				unset ( $_SESSION [CLIENT_SESSION] [$kv] );
			}
		}
		return true;
	}
}
?>