<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 login.tpl.php
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
    <link href="<?php echo BASE_URL;?>css/newimage/css/layout2.css" rel="stylesheet" type="text/css"/>
    <!--[if IE 6]>
    <script type="text/javascript" src="<?php echo BASE_URL;?>css/newimage/js/DD_belatedPNG.js"></script>
    <script type="text/javascript">
        DD_belatedPNG.fix('.logo');
    </script>
    <![endif]-->
    <script type="text/javascript" src="<?php echo BASE_URL;?>css/newimage/js/jquery-1.2.6.min.js"></script>
</head>
<body onkeyup="EnterKeyUp(event)">
<div class="main">
    <!-- 头部开始 -->
    <div class="header">
        <h1 class="logo loginpage">身旁网</h1>
        <a class="btn_reg" href="index.php?m=account.register" title="注册">注册</a></div>
    <!-- 内容开始 -->
    <div class="content clearfix">


        <!-- 登录表 -->
        <form class="login_form" id="login_form" action="index.php?m=account.loginin" method="post">

            <div class="input_wrapper login_input">
                <input type="text" id="mail" name="mail" class="input_text" value="邮箱"
                       onfocus="this.className='input_on';this.onmouseout='';if (value =='邮箱'){value =''}"
                       onblur="this.className='input_off';this.onmouseout=function(){this.className='input_out'};if (value ==''){value='邮箱'}"
                       onmousemove="this.className='input_move'" onmouseout="this.className='input_out'"/>

                <div class="reg_tip" id="reg_tip1">
                    <!--填个常用邮箱作为登录帐号-->
                </div>
            </div>
            <div class="input_wrapper login_input">
                <input type="password" id="password" name="password" class="input_text" value="" onfocus="ckeckreg1()"
                       onblur="ckeckreg1()" onkeyup="ckeckreg1()" onmousemove="this.className='input_move'"
                       onmouseout="this.className='input_out'"/>
                <label class="reg-label" for="blogName">密码</label>

                <div class="reg_tip" id="reg_tip2"></div>
            </div>

            <div class="input_wrapper login_button"><a class="login_btn" href="javascript: login()" title="登录">登录</a>
            </div>
            <div class="clearfix"></div>
            <div class="forgetpass"><input type="checkbox" name="remb" value="remember" 　/>保存登录状态　　<a
                    href="index.php?m=index.forget">忘记密码？</a>　　
            </div>

        </form>
    </div>

    <!-- 底部开始 -->
    <div class="footer">
        <a href="http://www.shenpang.cc/staff">官方轻博客</a> | <a
            target=_blank href="index.php?m=index.friendlink">友情链接</a> | <a href="index.php?m=ad.about">关于我们</a> <br/>
        让我的身旁有个你！&nbsp;&nbsp;&nbsp;版权所有：身旁网&nbsp;&nbsp;&nbsp;备案号：粤ICP备08128591号-2 <?php echo $SPconfig['statistics'];?>
        技术支持:<a target=_blank href="http://team.shenpang.cc">身旁TEAM</a> <a href='http://www.paipang.com'>拍旁网</a>  <a href='admin.php?m=admin/admin.login'>后台管理</a></div>
</div>

<script>
    function ckeckreg1() {
        if ($('#psw').val() == '') {
            $(".reg-label").eq(0).html("密码");
        } else {
            $(".reg-label").eq(0).html("");
        }


    }
    function EnterKeyUp(e) {
        var code = e.keyCode;
        if (code == "13") {
            var obj = null;
            if (window.event) {
                obj = document.activeElement;
            }
            else {
                obj = e.explicitOriginalTarget;
            }
            if (obj == null)
                return;
            login()
        }
    }
    function login() {
        var error1 = 0,error2 = 0;
        var mail = $("#mail").val();
        var pass = $("#password").val();
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(mail)) {
            $("#reg_tip1").text("邮箱格式错误");
            $("#mail").focus();
            error1 = 1;
        } else {
            $("#reg_tip1").text("");
            error1 = 0;
        }
        if (pass == "") {
            $("#reg_tip2").text("请输入登录密码");
            $("#password").focus();
            error2 = 1;
        }
        if (error1 == 0 && error2 == 0) {
            var form = document.getElementById("login_form");
            form.submit();
        }
    }
</script>
</body>
</html>