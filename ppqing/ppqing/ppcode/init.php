<?php
/*
 * 核心启动文件
 * @author chuxuwang
 */
//------------------------------------------------------------------------
/**
 * 相关全局配置文件
 */
if (! defined ( 'IS_DEBUG' )) {
	define ( 'IS_DEBUG', '' );
}
// 根据调试状态打开错误信息
if (defined ( 'IS_DEBUG' ) && IS_DEBUG) {
	if (version_compare ( PHP_VERSION, '5.0', '>=' )) {
		error_reporting ( E_ALL & ~ E_STRICT );
	} else {
		error_reporting ( E_ALL );
	}
	
	@ini_set ( 'display_errors', 1 );
} else {
	error_reporting ( 0 ); //? E_ERROR | E_WARNING | E_PARSE
	@ini_set ( 'display_errors', 0 );
}
/// 应用程序目录
define ( 'PP_ROOT', dirname ( __FILE__ ) );
include (PP_ROOT . '/cfg.php');
include (PP_ROOT . '/APP.php');
include (PP_ROOT . '/core/tpl.php');
include (PP_ROOT . '/core/user.php');
include (PP_ROOT . '/core/com.php');

?>