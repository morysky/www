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
$userinfo = USER::get('userinfo');
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
    <?php TPL::plugin('include/tophead');?>
</head>
<body>
<?php if (!file_exists('avatar/i_upload/' . $userinfo['uid'] . '_small_2.jpg')) { ?>


    <?php }?>
<?php TPL::plugin('include/header');?>
<div id='container'>

    <div id='contentre' class='content'>
        <div class='contenttop'></div>
        <div id="invite-holder">
            <h2>密码重置</h2>

            <p>
            <h4>(如果你忘记了密码)</h4>

            <div style="" id="invite-url-holder" class="invite-section">
                <h4>请填写邮箱，重置链接将会发到你的邮箱。</h4>

                <div id="invite-url">
                    邮箱：<input type="text" class="simple-input-text" id="invite-url-input" value="">
                    <span id="invite-url-tip"></span>
                </div>
            </div>
            <div style="" id="invite-email-holder" class="invite-section">
                <h4>重置链接将会发到你的邮箱，将确认邮箱是否收到相关的邮件</h4>

                <div id="invite-email">
                    <a class="shadow-link" id="send-mail-btn" href="javascript:invate()">重置密码</a>
                    <span style="display:none;" id="send-mail-tip"></span>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>
<?php TPL::plugin('include/infooter2');?>
<script>
    id = 0;
    function invate() {
        id++;
        var com = $('#invite-url-input').val();
        $.ajax({
            type: "POST",
            url: "index.php?m=index.forgetpassword",
            data: "com=" + com,
            success: function(msg) {
                $('#send-mail-btn').html(msg);
            }
        });
    }
</script>
</body>
</html>