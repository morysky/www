<?php 
/**
 * 数据库表定义
 * @auhor chuxuwang
 */

//---------------------------------------------------------------------
///用户表
define('T_USERS',			'users');
//内容表
define('T_CONTENT',			'content');
//关注表
define('T_FOLLOWS',			'follows');
//提到表 
define('T_TME',			'tme');
//评论表
define('T_COMMENTS',			'comments');
//用户配置表
define('T_USER_CONFIG',			'user_config');
//标签表
define('T_TAGS',			'tags');
//标签具体表
define('T_TAGS_CONTENT',			'tags_content');
//推荐表
define('T_RECOMMEND',			'recommend');
//提示
define('T_UNREAD',			'unread');
//喜欢
define('T_LIKE',			'like');
//留言
define('T_MESSAGE',			'message');
//留言
define('T_SCHOOL',			'school');

//反馈信息
define('T_FEEDBACK',         'feedback');

//轻博群
define('T_GROUP_CONFIG',			'group_config');
define('T_GROUP_USERS',			'group_users');
define('T_GROUP_CONTENT',			'group_content');


//轻图书
define('T_BOOKS',			'books');
//轻电影
define('T_MOVIE',			'movie');
//轻音乐
define('T_MP3',			'mp3');
//评分
define('T_SPSORCE',			'spsorce');


//分享图书的次数
define('T_SHAREBOOK',			'sharebook');
//------------------------------------------------------------------------
//后台管理数据表
//管理员帐号
define('T_ADMINUSER',			'adminuser');
//网站设置表
define('T_SETTING',			'setting');
//网站设置表
define('T_DISABLE',			'disable');

//友情链接
define('T_FRIENDLINK',			'friendlink');

//-----------------------------------------------------------------------

/// 默认时区
define('APP_TIMEZONE_OFFSET',	8);
/// 本地时间，与标准时间的差，单位为秒，当本地时钟较快时为　负数　，较慢时为　正数　, 默认为　０　即本地时间是准确的
define('LOCAL_TIME_OFFSET',		0);
/// 经过较准的，本地时间戳　所有使用APP_LOCAL_TIMESTAMP　的地方用这个常替代，防止，无法更改服务器时间导致的问题　
define('APP_LOCAL_TIMESTAMP',	time() + LOCAL_TIME_OFFSET);
date_default_timezone_set("Asia/Shanghai");
$SPconfig=file_get_contents('var/data/setting/SPconfig.tpl');
define('SPCONFIG',$SPconfig);
?>