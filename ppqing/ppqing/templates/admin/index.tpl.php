<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html id="index" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>管理中心--power by 身旁网&拍旁轻博客--power by 身旁网&拍旁轻博客</title>
    <link href="<?php echo BASE_URL;?>css/admin.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/admin.js"></script>
    <script>
        $(function() {
            admin.index.init();
        });
    </script>
</head>
<body>
<div id="wrapper">
    <div id="header">
        <div class="logo"></div>
        <div class="menu">
            <a href="#" id="function"></a>
            <a href="#" id="operations"></a>
            <a href="#" id="account"></a>
        </div>
        <div class="log-info">
            <span>欢迎回来：<?php $info = unserialize($admin_root);echo $info['adminuser'];?></span>
            <em>|</em>
            <a href="<?php echo URL('admin/admin.logout');?>">退出系统</a>
            <a class="back-home" href="index.php" target="_blank">轻博首页</a>
        </div>
    </div>
    <div id="container">
        <div class="sidebar">
            <div class="sub-menu">
                <h3 class="sidebar-title-top">功能设置</h3>

                <div class="sub-menu-info">
                    <a href="<?php echo URL('admin/setting.core');?>" target="mainframe">核心设置</a>
                    <a href="<?php echo URL('admin/setting.mail');?>" target="mainframe">邮件发送设置</a>
                    <a href="<?php echo URL('admin/setting.statistics');?>" target="mainframe">网站统计设置</a>
                </div>
            </div>
            <div class='sub-menu'>
                <h3>用户管理</h3>

                <div class="sub-menu-info">
                    <a href="<?php echo URL('admin/users.search');?>" target="mainframe">用户列表</a>
                    <a href="<?php echo URL('admin/users.getReSort');?>" target="mainframe">用户推荐管理</a>
                    <a href="<?php echo URL('admin/users.banUser');?>" target="mainframe">用户封禁管理</a>
                </div>
                <h3 class="sub-menu-titleline">内容管理</h3>

                <div class="sub-menu-info">
                    <a href="<?php echo URL('admin/qingbo.econtent');?>" target="mainframe">内容管理</a>
                    <a href="<?php echo URL('admin/qingbo.etags');?>" target="mainframe">标签管理</a>
                    <a href="<?php echo URL('admin/qingbo.ecomment');?>" target="mainframe">评论管理</a>
                </div>
                <h3 class="sub-menu-titleline">过滤管理</h3>

                <div class="sub-menu-info">
                    <a href="<?php echo URL('admin/keyword.keywordList');?>" target="mainframe">关键字过滤</a>
                </div>
                <h3 class="sub-menu-titleline">友情链接</h3>

                <div class="sub-menu-info">
                    <a href="<?php echo URL('admin/friendlink.flist');?>" target="mainframe">友情链接</a>
                </div>
            </div>
            <div class='sub-menu'>
                <h3>帐号管理</h3>

                <div class="sub-menu-info">
                    <a href="<?php echo URL('admin/setting.repassword');?>" target="mainframe">修改密码</a>
                </div>
            </div>
        </div>
        <div class="main">
            <iframe id="mainframe" width="100%" name="mainframe" frameborder="0" src="#" scrolling="yes"></iframe>
        </div>
    </div>
</div>


</body>
</html>
