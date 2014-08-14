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
                <h1>个性化域名</h1>
                <?php
                $msg = USER::get('msg');
                if ($msg) echo $msg;
                ?>
                <form name="form1" id="form1" method="post" action="index.php?m=setting.domnameadd">
                    <h3 class="first">域名:http://www.shenpang.cc/_______(请在下面填写用户名，用户必须是英文或数字）</h3>

                    <div class="text_field_container"><input type="text" value="<?php echo  $thinfo[0]['domname'];?>"
                                                             name="name" id="post_one" class="text_field big wide">
                    </div>
                    <div style="height:30px;"></div>
                    <?php if (1) { ?>
                    <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                            id="save_button" class="positive" type="submit">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label">修改</span>
                    </button>
                    <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                            id="save_button" class="positive" type="reset">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label">重置</span>
                    </button>
                    <?php }?>
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