<?php 
/*************************************************************
 * Created: 2010-4-1
 * 
 * 后台入口
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/

include('tables.php');
include('config.php');
define('SITE_SKIN_TPL_DIR',	'admin');
define('DEFAULTMOD','admin');
include('ppcode/init.php');
APP::init();
//---------------------------------------------------------
?>