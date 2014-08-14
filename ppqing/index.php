<?php 
/**
 * 拍旁轻博客入口
 * @author chuxuwang
 * 这不是一个免费的软件
 */
include('tables.php');
include('config.php');
define('DEFAULTMOD','index');
include('ppcode/init.php');
APP::addPreDoAction('account.gloCheckLogin', 'm', false, array('account.*','show','index.wall','index.forget','index.checklog','index.forgetpassword','index.reset','index.resetpassword','index.recommend','index.recommendqun','index.recommendbao','index.recommendbook','index.recommendbooklist','index.recommendbookshow','index.recommendmovie','index.recommendmovielist','index.recommendmovieshow','index.recommendmp3','index.recommendmp3list','index.recommendmp3show','index.verify','index.friendlink','ta','ta.tarighttop','group','post.uploadify','ad.*'));
APP::init();

?>