<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>管理员登录--power by 身旁网&拍旁轻博客</title>
    <link href="<?php echo BASE_URL;?>css/admin.css" rel="stylesheet" type="text/css"/>
    <script type='text/javascript' src='<?php echo BASE_URL;?>js/admin.js'></script>
    <style type="text/css">
        html {
            background: #98B3CC;
        }
    </style>
    <script>
        function refreshCc() {
            var ccImg = document.getElementById("checkCodeImg");
            if (ccImg) {
                ccImg.src = ccImg.src + '&' + Math.random();
            }
        }
        $(function() {
            $('input[type="text"],textarea,input[type="password"]').blur(function() {
                checkForm(this);
            });
            $('#username').focus();
        });
        function ajax_submit() {
            if (!checkForm($('#loginFrm').get(0))) {
                return false;
            }
            var url = '<?php echo URL('admin/admin.login');?>';
            var data = {
                'adminuser': $('#adminuser').val(),
                'adminpassword': $('#adminpassword').val(),
                'verify_code': $('#verify_code').val()
            };
            $.post(url, data, function(json) {
                json = eval('(' + json + ')');

                if (json.state == '200') {
                    window.location.href = '<?php echo URL('admin/admin.index');?>';
                } else {
                    if (json.state == '402') {
                        $('#verify_code_msg').html(json.msg).addClass("a-error").show();
                        $('#username_msg').hide();
                    } else {
                        $('#username_msg').html(json.msg).addClass("a-error").show();
                        $('#verify_code_msg').hide();
                    }
                }
            })
        }
    </script>
    <script type='text/javascript' src='<?php echo BASE_URL;?>js/jquery.min.js'></script>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico">
</head>
<body>
<div id="login-wrap">
    <div class="login-main">
        <div class="login-t">
            <div class="admin-logo"></div>
            <div class="tit">拍旁轻博客系统后台管理</div>
        </div>
        <div class="login-m">
            <form id="loginFrm" action="" method="post" onsubmit="ajax_submit();return false;">
                <div class="account1">
                    <label>管理员：</label>
                    <input class="input-box admin-txt" id="adminuser" name="adminuser"/>
                </div>
                <div class="account1">
                    <label for="">密码：</label>
                    <input class="input-box admin-txt" id="adminpassword" name="adminpassword" type="password"/>
                    <span id="username_msg"></span>
                </div>
                <?php if (IS_USE_CAPTCHA): ?>
                <div class="account2">
                    <label for="">验证码：</label>
                    <input class="input-box admin-txt" id="verify_code" name="verify_code" type="text"
                           autocomplete="off"/>
                    <span id="verify_code_msg"></span>
                </div>
                <div class="account3">
                    <img id="checkCodeImg" src="<?php echo APP::mkModuleUrl('authImage.paint', 'w=70&h=25');?>"/>
                    <a href="javascript:refreshCc();">看不清楚，换一张</a>
                </div>
                <?php endif;?>
                <input class="admin-btn" onfocus="this.blur()" name="" type="submit" value="登 录"/>
                <!--<input class="admin-btn-no" name=""  type="submit" value="登 录" />-->
            </form>
        </div>
    </div>
</div>
</body>
</html>
