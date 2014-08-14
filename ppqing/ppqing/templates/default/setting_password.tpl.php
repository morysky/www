<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 index.tpl.php
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
        <div id='right_column'>
            <?php TPL::plugin('include/setright');?>
            <?php
            $userinfo = USER::get('userinfo');
            $db = APP :: ADP('db');
            $thinfo = $db->query('select * from ' . $db->getTable(T_USERS) . '  where uid=' . $userinfo['uid']);
            ?>
        </div>
        <div id='left_column'>
            <div id='text_post'>
                <h1>修改密码</h1>
                <?php
                $msg = USER::get('msg');
                if ($msg) echo $msg;
                ?>
                <form name="form1" id="form1" method="post" action="index.php?m=setting.passwordadd">
                    <h3 class="first"></h3>

                    <div class="text_field_container" style="margin:8px;">旧密码:<input type="password" value=""
                                                                                     name="oldpassword" id="post_one"
                                                                                     class="text_field big wideright">
                    </div>
                    <div class="text_field_container" style="margin:8px;"> 新密码:<input type="password" value=""
                                                                                      name="password" id="post_one"
                                                                                      class="text_field big wideright">
                    </div>
                    <div class="text_field_container" style="margin:8px;">重复密码:<input type="password" value=""
                                                                                      name="repassword" id="post_one"
                                                                                      class="text_field big wideright">
                    </div>
                    <div style="height:30px;"></div>

                    <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                            id="save_button" class="positive" type="submit">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label">修改</span>
                    </button>


                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <img id="content_bottom" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_bottom_edit_form.png?alpha">
</div>
<?php TPL::plugin('include/infooter2');?>

</body>
</html>