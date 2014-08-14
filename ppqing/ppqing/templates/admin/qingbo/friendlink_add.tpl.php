<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>友情链接 - 轻博管理 - 运营管理--power by 身旁网&拍旁轻博客</title>
    <link href="<?php echo BASE_URL;?>css/admin.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class="main-wrap">
    <div class="path"><span class="path-icon"></span>当前位置：运营管理<span> &gt; </span>轻博管理<span> &gt; </span>友情链接</div>
    <div class="set-wrap">
        <h4 class="main-title">添加友情链接</h4>

        <div class="set-area-int">
            <div class="user-list-box1">
                <p class="serch-tips"><a href="<?php echo URL('admin/friendlink.flist', '', 'admin.php');?>">返回友情列表</a>
                </p>

                <form action="<?php echo URL('admin/friendlink.add');?>" method="post">
                    网站名:<input name='name' value=''></input>
                    logo:<input name='logo' value=''></input>
                    网址:<input name='url' value=''></input>
                    排序:<input name='sortid' value=''></input>
                    类型:<select name='types'>
                    <option value='pic'>图片</option>
                    <option value='text'>文字</option>
                    <option value='school'>学校</option>
                </select>

                    <div class="button keyword-btn-position"><input type="submit" value="提交"/></div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
