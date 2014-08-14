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
$ruid = V('g:uid');
$rpassword = V('g:password');
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
    <?php TPL::plugin('include/topcontainer');?>
    <div id='contentre' class='content'>
        <div class='contenttop'></div>
        <div id="invite-holder">
            <h2>密码重置</h2>

            <p>
            <h4>(如果你忘记了密码)</h4>

            <div style="" id="invite-url-holder" class="invite-section">
                <h4>请填写相关的新密码。</h4>

                <div id="invite-url">
                    新输入新密码：<input type="password" class="simple-input-text" id="invite-url-input1" value="">
                    <span id="invite-url-tip"></span>
                </div>
                <div style='height:20px'></div>
                <div id="invite-url">
                    再次输入密码：<input type="password" class="simple-input-text" id="invite-url-input2" value="">
                    <span id="invite-url-tip"></span>
                </div>
                <input type='hidden' id='ruid' value='<?php echo $ruid;?>'></input>
                <input type='hidden' id='rpassword' value='<?php echo $rpassword;?>'></input>
            </div>
            <div style="" id="invite-email-holder" class="invite-section">
                <h4></h4>

                <div id="invite-email">
                    <a class="shadow-link" id="send-mail-btn" href="javascript:invate()">设置新密码</a>
                    <span style="display:none;" id="send-mail-tip"></span>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</div>

<script>
    id = 0;
    function invate() {
        id++;
        var com = $('#invite-url-input1').val();
        var com2 = $('#invite-url-input2').val();
        var ruid = $('#ruid').val();
        var rpassword = $('#rpassword').val();
        if (com == com2) {
            $.ajax({
                type: "POST",
                url: "index.php?m=index.resetpassword",
                data: "com=" + com + '&ruid=' + ruid + '&rpassword=' + rpassword,
                success: function(msg) {
                    $('#send-mail-btn').html(msg);
                }
            });
        } else {
            $('#send-mail-btn').html('密码不一致，请重新填写');
        }
    }
</script>
</body>
</html>