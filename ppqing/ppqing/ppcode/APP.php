<?php
/*
 * 全局功能类
 * ppcode框架
 * @author chuxuwang
 */

class APP {
	public static $funPath = 'ppcode/fun/';
	public static $classPath = 'ppcode/class/';
	public static $modPath = 'actions/';
	//得到mod的入口
	public $m;
	
	/**
	 * APP的初始化入口
	 */
	static function init() {
		self::_initConfig ();
		self::_doPreActions ();
		self::_M ();
	
	}
	
	/**
	 * 初始化配置
	 * @return 无返回值
	 */
	function _initConfig() {
		define ( 'BASE_URL', defined ( 'BASE_URL_PATH' ) ? rtrim ( BASE_URL_PATH, '/\\' ) . '/' : '/' );
		$fName = basename ( V ( 'S:SCRIPT_FILENAME' ) );
		define ( 'BASE_FILENAME', $fName ? $fName : 'index.php' );
	}
	
	/**
	 * 加载相关的函数
	 * 
	 */
	static function F() {
		
		$fnum = func_num_args ();
		$fun = func_get_arg ( 0 );
		$p = func_get_args ();
		array_shift ( $p );
		include_once (APP::$funPath) . $fun . ".func.php";
		return call_user_func_array ( $fun, $p );
	}
	
	/**
	 * 加载相关的类
	 */
	static function N() {
		$fnum = func_num_args ();
		$class = func_get_arg ( 0 );
		$p = func_get_args ();
		array_shift ( $p );
		//eval('$ok = $p;');
		//print_r($ok);
		foreach ( $p as $pk => $pv ) {
			$p [$pk] = "'" . $pv . "'";
		}
		//$addp=implode(',',$p);
		include_once (APP::$classPath) . $class . ".class.php";
		eval ( '$newclass=new $class(' . implode ( ",", $p ) . ');' );
		return $newclass;
	}
	
	/**
	 * 跳转
	 */
	static function ReUrl($toUrl) {
		header ( "location:$toUrl" );
	}
	
	/**
	 * 得到mod的m值进行判断，对入口进行重定向
	 */
	
	function _M() {
		$modAll = $_GET ['m'];
		$modArr = explode ( '.', $modAll );
		$modAction = $modArr [0];
		$modFun = $modArr [1];
		$mods = explode ( '/', $modAction );
		$mod = end ( $mods );
		$modfirst = array_shift ( $mods );
		if ($modFun) {
			APP::setData ( 'RuningRoute', array ('path' => $modfirst, 'class' => $mod, 'function' => $modFun ) );
		} else {
			APP::setData ( 'RuningRoute', array ('path' => $modfirst, 'class' => $mod, 'function' => 'default_action' ) );
		}
		if ($modAction) {
			//echo $modAction;
			APP::Mod ( $modAction, $modFun );
		} else {
			if (DEFAULTMOD) {
				APP::Mod ( DEFAULTMOD );
			} else {
				APP::Mod ( 'index' );
			}
		}
	}
	
	/**
	 * 加载mod类的函数
	 */
	
	static function Mod($mod, $fun = 0) {
		include_once (APP::$modPath) . $mod . ".mod.php";
		$mods = explode ( '/', $mod );
		$mod = end ( $mods );
		$class = $mod . "_mod";
		
		eval ( '$modClass=new $class();' );
		
		if (empty ( $fun ) || $fun == '0') {
			
			$modClass->default_action ();
		
		} else if (method_exists ( $modClass, $fun )) {
			
			$modClass->$fun ();
		} else {
			APP::ReUrl ( 'index.php' );
		}
	}
	
	/**
	 * V($vRoute,$def_v=NULL);
	 * APP:V($vRoute,$def_v=NULL);
	 * 获取还原后的  $_GET ，$_POST , $_FILES $_COOKIE $_REQUEST $_SERVER $_ENV
	 * 同名全局函数： V($vRoute,$def_v=NULL);
	 * @param $vRoute	变量路由，规则为：“<第一个字母>[：变量索引/[变量索引]]
	 * 例:	V('G:TEST/BB'); 表示获取 $_GET['TEST']['BB']
	 * V('p'); 		表示获取 $_POST
	 * V('c:var_name');表示获取 $_COOKIE['var_name']
	 * @param $def_v
	 * @return unknown_type
	 */
	function V($vRoute, $def_v = NULL, $setVar = false) {
		static $v;
		if (empty ( $v )) {
			$v = array ();
		}
		$vRoute = trim ( $vRoute );
		
		//强制初始化值
		if ($setVar) {
			$v [$vRoute] = $def_v;
			return true;
		}
		
		if (! isset ( $v [$vRoute] )) {
			$vKey = array ('C' => $_COOKIE, 'G' => $_GET, 'P' => $_POST, 'R' => $_REQUEST, 'F' => $_FILES, 'S' => $_SERVER, 'E' => $_ENV, '-' => $GLOBALS [V_CFG_GLOBAL_NAME] );
			if (empty ( $vKey ['R'] )) {
				$vKey ['R'] = array_merge ( $_COOKIE, $_GET, $_POST );
			}
			if (! preg_match ( "#^([cgprfse-])(?::(.+))?\$#sim", $vRoute, $m ) || ! isset ( $vKey [strtoupper ( $m [1] )] )) {
				trigger_error ( "Can't parse var from vRoute: $vRoute ", E_USER_ERROR );
				return NULL;
			}
			
			//----------------------------------------------------------
			$m [1] = strtoupper ( $m [1] );
			$tv = $vKey [$m [1]];
			
			//----------------------------------------------------------
			if (empty ( $m [2] )) {
				$v [$vRoute] = ($m [1] == '-' || $m [1] == 'F' || $m [1] == 'S' || $m [1] == 'E') ? $tv : APP::_magic_var ( $tv );
			} elseif (empty ( $tv )) {
				return $def_v;
			} else {
				$vr = explode ( '/', $m [2] );
				while ( count ( $vr ) > 0 ) {
					$vk = array_shift ( $vr );
					if (! isset ( $tv [$vk] )) {
						return $def_v;
						break;
					}
					$tv = $tv [$vk];
				}
			}
			$v [$vRoute] = ($m [1] == '-' || $m [1] == 'F' || $m [1] == 'S' || $m [1] == 'E') ? $tv : APP::_magic_var ( $tv );
		}
		
		return $v [$vRoute];
	}
	//------------------------------------------------------------------
	

	//------------------------------------------------------------------
	/**
	 * 根据用户服务器环境配置，递归还原变量
	 * @param $mixed
	 * @return 还原后的值
	 */
	function _magic_var($mixed) {
		if ((function_exists ( 'get_magic_quotes_gpc' ) && get_magic_quotes_gpc ()) || @ini_get ( 'magic_quotes_sybase' )) {
			if (is_array ( $mixed ))
				return array_map ( array ('APP', '_magic_var' ), $mixed );
			return stripslashes ( $mixed );
		} else {
			return $mixed;
		}
	}
	
	//------------------------------------------------------------------
	/**
	 * APP::addPreAction($doRoute, $type, $args=false);
	 * 此方法必须在 APP::init();之前执行
	 * @param $doRoute		模块路由，如 demo/index.show
	 * @param $type			模块类型，可选值为： m , f , c ; 分别表示 模块 函数 和 类库
	 * @param $args			模块所需要的参数，统一用数据传递，$type 为 m 时无效
	 * @param $except		例外模块，在这些模块中 将不执行此预处理程序 默认为空 可以是数组或者字符串
	 * @return 无返回值
	 */
	function addPreDoAction($doRoute, $type, $args = array(), $except = '') {
		APP::setData ( $doRoute . ',' . $type, array ($doRoute, $type, $args, $except ), '_PreDoActions' );
	}
	
	//------------------------------------------------------------------
	/**
	 * APP::setData($k,$v=false,$category='STATIC_STORE');
	 * 保存一个静态全局数据
	 */
	function setData($k, $v = false, $category = 'STATIC_STORE') {
		if (! isset ( $GLOBALS [V_GLOBAL_NAME] [$category] ) || ! is_array ( $GLOBALS [V_GLOBAL_NAME] [$category] )) {
			$GLOBALS [V_GLOBAL_NAME] [$category] = array ();
		}
		if (is_array ( $k )) {
			$GLOBALS [V_GLOBAL_NAME] [$category] = array_merge ( $GLOBALS [V_GLOBAL_NAME] [$category], $k );
		} else {
			$GLOBALS [V_GLOBAL_NAME] [$category] [$k] = $v;
		}
	}
	//------------------------------------------------------------------
	/// 重置一个静态数据分组
	function resetData($category = 'STATIC_STORE') {
		$GLOBALS [V_GLOBAL_NAME] [$category] = array ();
	}
	/**
	 * APP::getData($k=false, $category='STATIC_STORE');
	 * 获取一个静态存储数据
	 */
	function getData($k = false, $category = 'STATIC_STORE', $defV = NULL) {
		if (! isset ( $GLOBALS [V_GLOBAL_NAME] [$category] ) || ! is_array ( $GLOBALS [V_GLOBAL_NAME] [$category] )) {
			return $defV;
		}
		$gV = $GLOBALS [V_GLOBAL_NAME] [$category];
		return $k ? (isset ( $gV [$k] ) ? $gV [$k] : $defV) : $gV;
	}
	
	//------------------------------------------------------------------
	/// 处理预加载模块
	function _doPreActions() {
		$as = APP::getData ( false, '_PreDoActions' );
		
		if (empty ( $as ) || ! is_array ( $as )) {
			return true;
		}
		
		foreach ( $as as $v ) {
			
			$route = trim ( $v [0] );
			$type = strtoupper ( $v [1] );
			$arg = $v [2];
			$noRun = $v [3];
			if (! empty ( $noRun )) {
				if (! is_array ( $noRun )) {
					$noRun = array ($v [3] );
				}
				//print_r($noRun);exit;
				if (APP::_isIgnorePreDo ( $noRun )) {
					continue;
				}
			}
			
			switch ($type) {
				case 'M' :
					APP::M ( $route );
					break;
			}
		}
	}
	
	//------------------------------------------------------------------
	/// 是否忽略指定的预处理
	function _isIgnorePreDo($ignoreArr) {
		$nowRoute = APP::V ( 'g:m' );
		
		if (in_array ( $nowRoute, $ignoreArr )) {
			return true;
		}
		foreach ( $ignoreArr as $ig ) {
			$tig = str_replace ( '*', '', $ig );
			if (($nowRoute . '.' == $tig) || $tig != $ig && strpos ( $nowRoute, $tig ) === 0) {
				return true;
			}
		}
		return false;
	}
	
	//-----------------------------------------------------------------
	/**
	 * APP::M($mRoute);
	 * 执行一个模块
	 * @param $mRoute
	 * @return no nreturn
	 */
	function M($mRoute) {
		$m = APP::_parseRoute ( $mRoute );
		APP::Mod ( $m [2], $m [3] );
	
	}
	//------------------------------------------------------------------
	function _parseRoute($route) {
		/*
		static $staticRoute=array();
		if (isset($staticRoute[$route])){
			return $staticRoute[$route];
		}*/
		$route = trim ( $route );
		$p = preg_match ( "#^([a-z_][a-z0-9_\./]*/|)([a-z0-9_]+)(?:\.([a-z_][a-z0-9_]*))?\$#sim", $route, $m );
		if (! $p) {
			trigger_error ( "route : [ $route  ] is  invalid ", E_USER_ERROR );
			return false;
		}
		if (empty ( $m [3] ))
			$m [3] = R_DEF_MOD_FUNC;
		return $m;
	}
	/**
	 * APP::redirect($mRoute,$type=1);
	 * 重定向 并退出程序
	 * @param $mRoute
	 * @param $type 	1 : 默认 ， 内部模块跳转 ,2 : 给定模块路由，通过浏览器跳转 ,3 : 给定URL  ,4 : 给定URL，用JS跳
	 * @return 无返回值
	 */
	function redirect($mRoute, $type = 1) {
		switch ($type) {
			case 1 :
				APP::M ( $mRoute );
				break;
			case 2 :
				$url = APP::mkModuleUrl ( $mRoute );
				header ( "Location: " . $url );
				break;
			case 3 :
				header ( "Location: " . $mRoute );
				break;
			case 4 :
				
				echo '<script>window.location.href="' . addslashes ( $mRoute ) . '";</script>';
				break;
			default :
				break;
		}
		exit ();
	}
	//------------------------------------------------------------------
	/**
	 * APP::mkModuleUrl($mRoute, $qData=false, $entry=false);
	 * 根据模块路由，query 数据 ，入口程序，生成URL，
	 * @param $mRoute		模块路由，如 demo/index.show
	 * @param $qData		添加在URL后面的参数，可以是数组或者字符串，
	 * 如  array('a'=>'a_var') 或者  "a=a_var&b=b_var"
	 * @param $entry		入口程序名，默认获取当前入口程序，如： index.php admin.php
	 * @return 生成的URL
	 */
	function mkModuleUrl($mRoute, $qData = false, $entry = false) {
		
		$baseUrl = $entry ? BASE_URL . $entry : BASE_URL . BASE_FILENAME;
		$basePath = BASE_URL;
		//--------------------------------------------------------------
		if ($qData) {
			if (is_array ( $qData )) {
				$kv = array ();
				foreach ( $qData as $k => $v ) {
					$kv [] = $k . "=" . urlencode ( $v );
				}
				$qData = implode ( "&", $kv );
			} else {
				$qData = trim ( $qData, "&" );
			}
		} else {
			$qData = '';
		}
		
		//--------------------------------------------------------------
		if (R_MODE == 0) {
			$rStr = R_GET_VAR_NAME . '=' . $mRoute;
			$qData = empty ( $qData ) ? $rStr : $rStr . "&" . $qData;
			return $baseUrl . "?" . $qData;
		}
		//--------------------------------------------------------------
		if (R_MODE == 1) {
			return empty ( $qData ) ? $baseUrl . "/" . trim ( $mRoute, '/ ' ) : $baseUrl . "/" . trim ( $mRoute, '/ ' ) . "?" . $qData;
		}
		//--------------------------------------------------------------
		if (R_MODE == 2 || R_MODE == 3) {
			return empty ( $qData ) ? $basePath . trim ( $mRoute, '/ ' ) : $basePath . trim ( $mRoute, '/ ' ) . preg_replace ( "#(?:^|&)([a-z0-9_]+)=#sim", "/\\1-", $qData );
		}
		//--------------------------------------------------------------
		trigger_error ( "Unknow route type: [ " . R_MODE . " ]", E_USER_ERROR );
		return false;
	}
	//------------------------------------------------------------------
	/**
	 * APP::ADP ($name,$is_single=true,$cfg=false);
	 * 根据配置，获取一个适配器实例，使用配置信息初始化
	 * @param $name			适配器名称如： db 类型由配置文件中确定
	 * @param $is_single	是否获取单例
	 * @param $cfg			初始化此适配器的配置数据，默认从配置中取
	 * @return 相应的适配器实例
	 */
	function ADP($name, $is_single = true, $cfg = false) {
		$type = APP::V ( '-:adapter/' . $name );
		
		if (empty ( $type )) {
			trigger_error ( "Can't find  adapter config data  : \$GLOBALS['" . V_CFG_GLOBAL_NAME . "']['adapter']['{$name}']  ", E_USER_ERROR );
		}
		
		$cfgData = $cfg ? $cfg : APP::V ( '-:adapter_cfg/' . $name . '/' . $type );
		
		//print_r($cfgData);
		//print_r($cfgData);
		return APP::adapter ( $name, $type, $is_single, $cfgData );
	}
	/**
	 * APP::adpFile($name,$type);
	 * 根据适配器的名称和类型取得文件路径
	 * @param $name	适配器名称如： db http cache io 等
	 * @param $name	适配器类型如： db 可能的类型有： mysql access mssql 等
	 * @return 模板文件路径
	 */
	function adpFile($name, $type) {
		if (! preg_match ( "#^[a-z_][a-z0-9_]*\$#sim", $name )) {
			trigger_error ( "Adapter name [ " . $name . " ] is invalid ", E_USER_ERROR );
		}
		if (! preg_match ( "#^[a-z_][a-z0-9_]*\$#sim", $type )) {
			trigger_error ( "Adapter type [ " . $type . " ] is invalid ", E_USER_ERROR );
		}
		return P_ADAPTER . "/" . $name . "/" . $type . "_" . $name . EXT_ADAPTER;
	}
	/**
	 * APP::adapter ($name,$type,$is_single=true,$cfgData=false);
	 * 通用的适配器获取方法
	 * @param $name			适配器名称
	 * @param $type			适配器类型
	 * @param $is_single	是否获取单剑
	 * @param $cfgData		适配器初始化参数
	 * @return 相应的适配器实例
	 */
	function &adapter($name, $type, $is_single = true, $cfgData = false) {
		static $adpClass;
		$class = $type . "_" . $name;
		
		if (isset ( $adpClass [$class] ) && is_object ( $adpClass [$class] ) && $is_single) {
			return $adpClass [$class];
		}
		
		$cFile = APP::adpFile ( $name, $type );
		if (! file_exists ( $cFile )) {
			trigger_error ( "Can't adapter file [ $cFile ] ", E_USER_ERROR );
		}
		
		require_once ($cFile);
		if (! class_exists ( $class )) {
			trigger_error ( "class [ $class ]  is not exists in file [ $cFile ] ", E_USER_ERROR );
		}
		
		$c = new $class ();
		$iniFunc = ADP_INIT_FUNC;
		
		//var_dump($cfgData);
		if (method_exists ( $c, $iniFunc )) {
			$c->$iniFunc ( $cfgData );
		}
		
		if ($is_single) {
			$adpClass [$class] = $c;
		}
		return $c;
	}
	
	function getRuningRoute($is_acc = false) {
		$m = APP::getData ( 'RuningRoute' );
		return ($is_acc) ? $m : $m ['path'] . $m ['class'] . "." . $m ['function'];
	}
	
	function ajaxRst($rst, $errno = 0, $err = '', $return = false) {
		$r = array ('rst' => $rst, 'errno' => $errno * 1, 'err' => $err );
		if ($return) {
			return json_encode ( $r );
		} else {
			header ( 'Content-type: application/json' );
			echo json_encode ( $r );
			exit ();
		}
	}
	
	function getRequestRoute($is_acc = false) {
		//--------------------------------------------------------------
		$m = "";
		if (R_MODE == 0) {
			$m = APP::V ( "g:" . R_GET_VAR_NAME );
			$m = $m ? $m : R_DEF_MOD;
		
		}
		//--------------------------------------------------------------
		if (R_MODE == 1) {
			$m = ltrim ( APP::V ( "s:PATH_INFO" ), " /" );
			$m = $m ? $m : R_DEF_MOD;
		}
		//--------------------------------------------------------------
		if (R_MODE == 2) {
			$ss = trim ( V ( 'S:PATH_INFO', '' ), '/' );
			if (empty ( $ss )) {
				$m = R_DEF_MOD;
			} else {
				preg_match ( "#^([a-z_][a-z0-9_\./]*/|)([a-z0-9_]+)(?:\.([a-z_][a-z0-9_]*))?(?:/|\$)#sim", $ss, $mm );
				//print_r($mm);
				$m = trim ( $mm [0], '/' );
			}
		}
		//--------------------------------------------------------------
		if (R_MODE == 3) {
			$m = APP::V ( "g:" . R_GET_VAR_NAME );
			if (empty ( $m )) {
				$ss = trim ( V ( 'S:PATH_INFO', '' ), '/' );
				if (empty ( $ss )) {
					$m = R_DEF_MOD;
				} else {
					preg_match ( "#^([a-z_][a-z0-9_\./]*/|)([a-z0-9_]+)(?:\.([a-z_][a-z0-9_]*))?(?:/|\$)#sim", $ss, $mm );
					$m = trim ( $mm [0], '/' );
				}
			}
		}
		//--------------------------------------------------------------
		if (! empty ( $m )) {
			if (! $is_acc) {
				return $m;
			} else {
				$r = APP::_parseRoute ( $m );
				return array ('path' => $r [1], 'class' => $r [2], 'function' => $r [3] );
			}
		}
		//--------------------------------------------------------------
		trigger_error ( "Unknow route type: [ " . R_TYPE . " ]", E_USER_ERROR );
	}
	
	function tips($params, $display = true) {
		static $msg = array ();
		if (! is_array ( $params )) {
			$params = array ('msg' => $params );
		}
		
		if (isset ( $params ['msg'] ) && is_array ( $params ['msg'] )) {
			foreach ( $params ['msg'] as $v ) {
				$msg [] = $v;
			}
		} elseif (isset ( $params ['msg'] )) {
			$msg [] = $params ['msg'];
		}
		
		if ($display) {
			$params ['msg'] = $msg;
			$defParam = array ('timeout' => 0, 'location' => '', 'lang' => '', 'baseskin' => true, 'caching' => '', 'tpl' => '' );
			$params = array_merge ( $defParam, $params );
			$time = $params ['timeout'] * 1;
			$url = $params ['location'];
			
			if ($time) {
				header ( "refresh:{$time};url=" . $url );
			}
			
			if ($params ['tpl']) {
				TPL::assign ( $params );
				if (! isset ( $params ['baseskin'] )) {
					$params ['baseskin'] = true;
				}
				TPL::display ( $params ['tpl'], $params ['lang'], $params ['caching'], $params ['baseskin'] );
				exit ();
			} else {
				if ($time) {
					echo "<meta http-equiv='Refresh' content='{$time};URL={$url}'>\n";
				}
				echo implode ( '<br />', $params ['msg'] );
			}
			exit ();
		}
	}
}
?>