<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php 
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 register.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$SPconfig = unserialize(SPCONFIG);
?>
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
<body>
<div class="main">
    <!-- 头部开始 -->
    <div class="header">
        <h1 class="logo">身旁网</h1>
        <a class="btn_login" href="index.php?m=account.login" title="登录">登录</a></div>
    <!-- 内容开始 -->
    <div class="content clearfix">
        <!--<div id="slide_box">
            <ul class="slide_list">
            <li class="slide_li2"></li>
            <li class="slide_li3"></li>
            <li class="slide_li1"></li>
            </ul>
        </div>-->
        <div class="slides">
            <ul class="slides_img">
                <li class="cur">
                    <img src="var/ad/banner1.jpg" alt="df"/>
                </li>
                <li>
                    <img src="var/ad/banner2.jpg" alt="df"/>
                </li>
                <li>
                    <img src="var/ad/banner3.jpg" alt="df"/>
                </li>
            </ul>
            <ul class="slides_contorl" style="display:none;">
                <li class="cur">aaaaa</li>
                <li>bbbbb</li>
                <li>ccccc</li>
            </ul>
        </div>
        <script type="text/javascript" src="<?php echo BASE_URL;?>css/newimage/js/slides_index.js"></script>
        <!-- 注册表 -->
        <form class="reg_form" id='reg_form' method="post" action="index.php?m=account.add">
            <h2>注册新账户</h2>

            <div class="input_wrapper">
                <input type="text" id="email" name='mail' class="input_text" value="邮箱"
                       onfocus="this.className='input_on';this.onmouseout='';if (value =='邮箱'){value =''}"
                       onblur="this.className='input_off';this.onmouseout=function(){this.className='input_out'};if (value ==''){value='邮箱'}"
                       onmousemove="this.className='input_move'" onmouseout="this.className='input_out'"/>

                <div class="reg_tip" id="reg_tip1">
                    <!--填个常用邮箱作为登录帐号-->
                </div>
            </div>
            <div class="input_wrapper">
                <input type="password" id='psw' class="input_text" name="password" onfocus="ckeckreg1()"
                       onblur="ckeckreg1()" onkeyup="ckeckreg1()" onmousemove="this.className='input_move'"
                       onmouseout="this.className='input_out'"/>
                <label class="reg-label" for="blogName">密码</label>

                <div class="reg_tip" id="reg_tip2"></div>
            </div>
            <div class="input_wrapper">
                <input type="password" id="pswa" name='passwordr' class="input_text" value="" onfocus="ckeckreg2()"
                       onblur="ckeckreg2()" onkeyup="ckeckreg2()" onmousemove="this.className='input_move'"
                       onmouseout="this.className='input_out'"/>
                <label class="reg-label" for="blogName">重复密码</label>

                <div class="reg_tip" id="reg_tip3"></div>
            </div>
            <div class="input_wrapper">
                <input type="text" id="uesrname" name='name' class="input_text" value="用户名"
                       onfocus="this.className='input_on';this.onmouseout='';if (value =='用户名'){value =''}"
                       onblur="this.className='input_off';this.onmouseout=function(){this.className='input_out'};if (value ==''){value='用户名'}"
                       onmousemove="this.className='input_move'" onmouseout="this.className='input_out'"/>

                <div class="reg_tip" id="reg_tip4"></div>
            </div>
            <div class="input_wrapper">
                <input type="text" id="loveu" name='tuya' class="input_text" value="涂鸦码(iloveyou)"
                       onfocus="this.className='input_on';this.onmouseout='';if (value =='涂鸦码(iloveyou)'){value =''}"
                       onblur="this.className='input_off';this.onmouseout=function(){this.className='input_out'};if (value ==''){value='涂鸦码(iloveyou)'}"
                       onmousemove="this.className='input_move'" onmouseout="this.className='input_out'"/>

                <div class="reg_tip" id="reg_tip5"></div>
            </div>
            <input type="hidden" id="haveemail" value="1"></input>

            <div class="input_wrapper"><a class="reg_btn" href="javascript:register();" title="注册，轻松体验社区">注册，轻松体验社区</a>
            </div>
        </form>
    </div>
    <!-- 底部开始 -->
    <div class="footer">生命要用心涂鸦！每个人都是艺术家！&nbsp;&nbsp;&nbsp;版权所有：<a href='http://www.shenpang.cc' target=_blank >身旁网</a>&nbsp;&nbsp;&nbsp;开发支持：<a href='http://www.paipang.com'>拍旁网</a>&nbsp;&nbsp;&nbsp;备案号：粤ICP备08128591号-2   <a href='admin.php?m=admin/admin.login'>后台管理</a></div>
    <script type="text/javascript">
        var pkBaseURL = (("https:" == document.location.protocol) ? "https://tong.paipang.com/" : "http://tong.paipang.com/");
        document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
        try {
            var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
            piwikTracker.trackPageView();
            piwikTracker.enableLinkTracking();
        } catch(err) {
        }
    </script>
    <noscript><p><img src="http://tong.paipang.com/piwik.php?idsite=1" style="border:0" alt=""/></p></noscript>
</div>
<script>
    function ckeckreg1() {
        if ($('#psw').val() == '') {
            $(".reg-label").eq(0).html("密码");
        } else {
            $(".reg-label").eq(0).html("");
        }


    }
    function ckeckreg2() {
        if ($('#pswa').val() == '') {
            $(".reg-label").eq(1).html("重复密码");
        } else {
            $(".reg-label").eq(1).html("");
        }

    }
    $(function() {
        //文本框失去焦点后
        $('#email').blur(function() {
            var email = $("#email").val();
            $.ajax({
                type: "POST",
                url: "index.php?m=account.checkemail",
                data: "email=" + email,
                success: function(msg) {
                    if (msg == 'success') {
                        $("#haveemail").val("0");
                        $("#reg_tip1").text("");
                    } else {
                        $("#haveemail").val("1");
                        $("#reg_tip1").text("邮箱已注册");
                    }
                }
            });
        })
    })

    function register() {
        var error1 = 0,error2 = 0,error3 = 0,error4 = 0;

        var email = $("#email").val();
        if (email == "" || ( email != "" && !/.+@.+\.[a-zA-Z]{2,4}$/.test(email) )) {
            $("#reg_tip1").text("邮箱格式不正确");
            error1 = 1;
        } else {
            $.ajax({
                type: "POST",
                url: "index.php?m=account.checkemail",
                data: "email=" + email,
                success: function(msg) {
                    if (msg == 'success') {
                        $("#haveemail").val("0");
                        $("#reg_tip1").text("");
                    } else {
                        $("#haveemail").val("1");
                        $("#reg_tip1").text("邮箱已注册");
                    }
                }
            });
            error1 = 0;
        }

        var passwordr = $("#psw").val();
        var password = $("#pswa").val();
        if (password != passwordr || (passwordr == '')) {
            $("#reg_tip3").text("密码不一致");
            error2 = 1;
        } else {
            $("#reg_tip3").text("");
            error2 = 0;
        }

        var uesrname = $("#uesrname").val();
        if (uesrname == '用户名' || (uesrname == '')) {
            $("#reg_tip4").text("用户名为空");
            error3 = 1;
        } else {
            $("#reg_tip4").text("");
            error3 = 0;
        }

        var loveu = $("#loveu").val();
        if (loveu != 'iloveyou') {
            $("#reg_tip5").text("涂鸦码不正确");
            error4 = 1;
        } else {
            $("#reg_tip5").text("");
            error4 = 0;
        }

        if (error1 == 0 && error2 == 0 && error3 == 0 && error4 == 0) {
            if ($("#haveemail").val() == 0) {
                var form = document.getElementById("reg_form");
                form.submit();
            }
        }

    }

</script>
</body>
</html>