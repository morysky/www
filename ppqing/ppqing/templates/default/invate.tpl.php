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
            <h2>邀请好友加入身旁</h2>

            <p>
            <h4>(被邀请的朋友会自动欣赏你的轻博客)</h4>

            <div style="" id="invite-url-holder" class="invite-section">
                <h4>通过QQ、MSN发送邀请链接给你的朋友</h4>

                <div id="invite-url">
                    <input type="text" class="simple-input-text" id="invite-url-input"
                           value="<?php echo BASE_URL;?>index.php?m=ta.invate&uid=<?php echo $userinfo['uid'];?>"
                           readonly="">
                    <span id="invite-url-tip"></span>
                </div>
            </div>
            <div style="" id="invite-email-holder" class="invite-section">
                <h4>通过发送邮件邀请你的朋友(输入邮箱地址，多个邮箱用分号分隔)</h4>

                <div id="invite-email">
                    <textarea class="simple-input-text send-mail-input-tip" id="send-mail-textarea"></textarea>
                    <a class="shadow-link" id="send-mail-btn" href="javascript:invate()">发送邀请</a>
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
        var allmail = $('#send-mail-textarea').val();
        $.ajax({
            type: "POST",
            url: "index.php?m=index.mail",
            data: "com=" + com + '&allmail=' + allmail,
            success: function(msg) {
                $('#send-mail-btn').html('发送成功,再发送一次(' + id + ')');
            }
        });
    }
</script>
</body>
</html>