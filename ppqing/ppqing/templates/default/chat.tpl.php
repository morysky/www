<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 text.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$SPconfig = unserialize(SPCONFIG);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL;?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL;?>css/edit.css" rel="stylesheet" type="text/css"/>
    <?php TPL::plugin('include/tophead');?>
</head>
<body>
<?php TPL::plugin('include/header');?>
<div id='container'>
    <img id="content_top" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_top_edit_form.png?alpha">

    <div id='content' class='content'>

        <form name="form1" id="form1" method="post" action="index.php?m=post.chatadd">
            <div id='right_column'>
                <?php TPL::plugin('include/editright');?>
            </div>
            <div id='left_column'>
                <div id='text_post'>

                    <h1>发表对话</h1>

                    <h3 class="first">标题 </h3>

                    <div class="text_field_container"><input type="text" value="" name="title" id="post_one"
                                                             class="text_field big wide"></div>
                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;">对话</h3>

                    <div style="height:30px;"></div>
                    <div style="background-color:#f0f0f0; color:#888; padding:10px; font-size:11px;">
                        <span style="font-weight:bold;">例子</span><br>
    <span style="font-style:italic;">
        小明: 你今天过来吗?<br>大鹏:应该没过去吧.<br>    </span>
                    </div>
                    <textarea name="content" id="post_two" style="height:200px;" class="wide"
                              style='overflow-y:hidden'></textarea>
                    <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                            id="save_button" class="positive" type="submit">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label">发布</span>
                    </button>
                    <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                            id="save_button" class="positive" type="reset">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label">重置</span>
                    </button>
                </div>
            </div>
        </form>

        <div class="clear"></div>
    </div>
    <img id="content_bottom" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_bottom_edit_form.png?alpha">
</div>

<!-- 底部开始 -->
<?php TPL::plugin('include/infooter2');?>
</body>
</html>