<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 * 框架核心类 tpl类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/

//----------------------------------------------------------------------
/**
 * 请在模板文件第一行加入： if(!defined("IN_APPLICATION")) { exit("Access Denied"); }
 */
class TPL {
	
    //初始构造函数
	function TPL(){}
	
	//------------------------------------------------------------------
	/**
	 * TPL::display($tpl, $langs=array(), $ttl=0, $tplDir="");
	 * 显示一个模板
	 * @param $tpl		模板路由
	 * @param $langs	语言包，可以是半角逗号隔开的列表，也可以是数组
	 * @param $ttl		缓存时间 单位秒 （ 未实现 ）
	 * @param $baseSkin	模板基准目录选项，默认为 true ，将使用系统配置的皮肤目录
	 * @return 无返回值
	 */
	static function display($tpl, $langs=array(),$ttl=0, $baseSkin=true){
	  if (is_array($GLOBALS[V_GLOBAL_NAME]['TPL'])) {
			extract($GLOBALS[V_GLOBAL_NAME]['TPL']);
		}
	    if ( !empty($langs) ){
			if ( !is_array($langs) ) $langs = explode(",", $langs);
			foreach ($langs as $t){
				if(!empty($t)) APP::importLang($t);
			}
		}
		$___tpl_args = array($tpl, $langs, $ttl, $baseSkin);
		include TPL::tplFile( $___tpl_args[0], $___tpl_args[3],$baseSkin);
	}
	
	//------------------------------------------------------------------------
	/**
	 * TPL::tplFile
	 * @param $tpl    模板的路径
	 * @param $ttl    模板的时间
	 * @return 返回模板的位置
	 */
	static function tplFile($tpl,$ttl,$baseSkin=true){
		if($baseSkin==true){
			$baseSkin='default';
			$tplFile=P_TEMPLATE."/".$baseSkin ."/". $tpl . TPL_EXT;
		}else{
			$tplFile=P_TEMPLATE."/". $tpl . TPL_EXT;	
		}
	    if(!file_exists($tplFile)){
	    	echo 'the file is not exist';exit;
	    }
	   
		return $tplFile;
	}
	
	//----------------------------------------------------------------------------
	/**
	 * 
	 * 输出或者获取一个 HTML 插件
	 * @param $tpl		模板路由
	 * @param $args		插件变量，是一个关联数组，在插件模板中，数组的下标即是变量名
	 * 
	 */
	static function plugin($tpl, $args=array(), $baseSkin=true, $output=true){
		if (is_array($args)){
			extract($args);
		}
		
	    if ($output){
	
			include TPL::tplFile($tpl);
		}else{
			ob_start();
			include TPL::tplFile($tpl);
			$data = ob_get_contents();
			ob_end_clean();
			return $data ;
		}
	   
	}
	
	function assign($k,$v=null){
		if ( !isset($GLOBALS[V_GLOBAL_NAME]['TPL']) || !is_array($GLOBALS[V_GLOBAL_NAME]['TPL']) ) {
			$GLOBALS[V_GLOBAL_NAME]['TPL'] = array();
		}
		if (!is_array($k)){
			$GLOBALS[V_GLOBAL_NAME]['TPL'][$k] = $v;
		}else{
			TPL::assignExtract($k);
		}
	}
	
	function assignExtract($data){
		if ( !isset($GLOBALS[V_GLOBAL_NAME]['TPL']) || !is_array($GLOBALS[V_GLOBAL_NAME]['TPL']) ) {
			$GLOBALS[V_GLOBAL_NAME]['TPL'] = array();
		}

		foreach($data as $k=>$v){
			$GLOBALS[V_GLOBAL_NAME]['TPL'][$k] = $v;
		}
	}
	
	
	
}
?>
