<?php
/*
 * 核心框架类
 * @author chuxuwang
 */
//------------------------------------------------------------------------


/// 系统模板文件扩展名
define ( 'TPL_EXT', ".tpl.php" );
/// 适配器文件扩展名
define ( 'EXT_ADAPTER', ".adp.php" );
/// 系统适配器文件的存放目录
define ( 'P_ADAPTER', PP_ROOT . "/adp" );
/// 系统模板文件的存放目录
define ( 'P_TEMPLATE', PP_ROOT . "/../templates" );
/// 用于存储全局数据的变量名
define ( 'V_GLOBAL_NAME', "__PPGG" );
/// 存放可变数据的目录名
define ( 'P_VAR_NAME', 'var' );
/// 系统文件数据（上传数据，缓存数据，字体，LOG 等）的存放目录
define ( 'P_VAR', 'var' );
/// 系统永久存储的数据目录
define ( 'P_VAR_DATA', "var/data" );
/// 标识是否在运用程序中的常量 可用于防止某文件被直接从URL调用
define ( 'IN_APPLICATION', 'XMBLOG' );
define ( 'IS_IN_APPLICATION_CODE', 'if(!defined("IN_APPLICATION")) { exit("Access Denied"); }' );
define ( 'P_VAR_CACHE', 'var/cache' );

/// 模块路由的变量名 , 当 R_MODE 为 0 时 可用
define ( 'R_GET_VAR_NAME', "m" );
if (! defined ( 'R_DEF_MOD' )) {
	define ( 'R_DEF_MOD', "index" );
}
/// 缓存组的KEY前缀
define ( 'GROUP_CACHE_KEY_PRE', 'gCacheKey_' );
/// 数据组件的缓存KEY前缀
define ( 'COM_CACHE_KEY_PRE', 'comCache_' );

/// 用于存储用户配置的全局变量名
define ( 'V_CFG_GLOBAL_NAME', "cfg" );
/// 约定的适配器初始化接口方法
define ( 'ADP_INIT_FUNC', "adp_init" );
/// HTTP		适配器选择配置
define ( 'HTTP_ADAPTER', 'curl' );
/// CACHE 		适配器选择配置
define ( 'CACHE_ADAPTER', 'file' );
/// SMTP		适配器选择配置
define ( 'SMTP_ADAPTER', 'smtp' );
/// DB			适配器选择配置
define ( 'DB_ADAPTER', 'mysql' );
///　上传适配器
define ( 'UPLOAD_ADAPTER', 'file' );
/// FILE		适配器选择配置
define ( 'FILE_ADAPTER', 'file' );

//适配器
/// 全局配置变量
$cfg = array ();
/// 适配器选择器
/// 适配器选择器
$cfg ['adapter'] = array ('io' => FILE_ADAPTER, 'db' => DB_ADAPTER, 'http' => HTTP_ADAPTER, 'cache' => CACHE_ADAPTER, 'mailer' => SMTP_ADAPTER, 'upload' => UPLOAD_ADAPTER );

/// 适配器初始化数据配置变量
$cfg ['adapter_cfg'] = array ();
$_adapter = &$cfg ['adapter_cfg'];

//----------------------------------------------------------------------
$_adapter ['db'] = array ();
$_adapter ['db'] ['mysql'] = array ('host' => DB_HOST, 'port' => DB_PORT, 'user' => DB_USER, 'pwd' => DB_PASSWD, 'charset' => DB_CHARSET, 'tbpre' => DB_PREFIX, 'db' => DB_NAME, 'slaves' => array (array ('host' => DB_HOST, 'port' => DB_PORT, 'user' => DB_USER, 'pwd' => DB_PASSWD ) ) );

$_adapter ['cache'] = array ();
$_adapter ['cache'] ['file'] = array ('baseDir' => P_VAR_CACHE, 'pathLevel' => 3, 'nameLen' => 2, 'varName' => '__cache_data' );
$_adapter ['cache'] ['serialize'] = array ('baseDir' => P_VAR_CACHE, 'pathLevel' => 3, 'nameLen' => 2 );
$_adapter ['cache'] ['eaccelerator'] = array ();
/**
 * 包含的文件头
 */


?>