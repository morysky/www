<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 tuiheader.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$guid = V('g:guid');
$tname = V('g:tname');
$db = APP :: ADP('db');
$Tcount = $db->query('select count(uid) as count from ' . $db->getTable(T_CONTENT) . ' where uid=' . $guid);
$count = $Tcount[0]['count'];
$Fcount = $db->query('select count(uid) as count from ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $guid);
$followcount = $Fcount[0]['count'];
$checkFollow = $db->query('select * from ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $userinfo['uid'] . ' and guid=' . $guid);
$thinfo = $db->query('select * from ' . $db->getTable(T_USERS) . '  where uid=' . $guid);
$rowinfo = $db->query('select *  from ' . $db->getTable(T_USERS) . ' where uid=' . $guid);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<HTML>
<HEAD>
    <META http-equiv=Content-Type content="text/html; charset=utf-8">
    <STYLE>BODY {
        PADDING-RIGHT: 0px;
        PADDING-LEFT: 0px;
        PADDING-BOTTOM: 0px;
        MARGIN: 0px;
        PADDING-TOP: 0px;
        ZOOM: 1;
        POSITION: relative
    }

    #shareContainer {
        DISPLAY: none;
        Z-INDEX: 500;
        WIDTH: 234px ! important;
        POSITION: absolute;
        TOP: 0px
    }

    </STYLE>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
    <META content="MSHTML 6.00.2900.6104" name=GENERATOR>
</HEAD>
<BODY><!-- display counter: 64 -->
<DIV id=control_panel
     style="Z-INDEX: 100; RIGHT: 0px; POSITION: absolute; TOP: 0px">
    <SCRIPT>
        window.isPosting = false;
        function doPost(op) {
            if (isPosting) {
                return;
            }
            isPosting = true;
// 这里可以考虑一下遮盖
            document.getElementById("op").value = op;
            document.getElementById("commonForm").submit();
        }
        function delPost(feedId) {
            if (!confirm("是否要删除这篇文章?")) {
                return;
            }
            doPost('del');
        }
        function rightWidth() {
            var backBtns = document.getElementById('control_panel').childNodes,
                    backBtnsTotalWidth = 0,
                    frontLogoWidth = 70 + (20 + 5) * 6 + 9;
            for (var i = 0, len = backBtns.length; i < len; i++) {
                if (backBtns[i].tagName == 'A' && backBtns[i].style.width != '') {
                    backBtnsTotalWidth += Number(backBtns[i].style.width.replace('px', '')) + 5;
                }
            }
            document.getElementById('shareContainer').style.right = (backBtnsTotalWidth - frontLogoWidth - 5) + 'px';
        }
        function showShareLayout() {
            rightWidth();
            document.getElementById('shareContainer').style.display = 'block';
        }
        function hideShareLayout() {
            document.getElementById('shareContainer').style.display = 'none';
        }
    </SCRIPT>

    <?php
    if (empty($tname)) {
        if (($guid != $userinfo['uid']) && $userinfo) {
            ?>
            <!-- 回首页 --><A
                    title=返回首页
                    style="DISPLAY: block; BACKGROUND: url(<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png) no-repeat -286px 0px; FLOAT: right; MARGIN-LEFT: 5px; WIDTH: 80px; HEIGHT: 26px"
                    href="<?php if (PPREWRITE == 1) {
                        echo BASE_URL; ?>m.index<?php } else { ?><?php echo BASE_URL; ?>index.php<?php }?>"
                    target=_top></A><!-- 关注 -->


            <a id='theyes'
               style="margin-left:5px; <?php if (!$checkFollow) { ?>display:block;<?php } else { ?>display:none;<?php }?>float:right;width:71px;height:26px;background:url('<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png') no-repeat -564px 0;_background-image:url('<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png');"
               title="欣赏" href="javascript:tafollow(<?php echo $guid;?>)"></a>

            <a id='theno'
               style="margin-left:5px; <?php if ($checkFollow) { ?>display:block;<?php } else { ?>display:none;<?php }?>float:right;width:71px;height:26px;background:url('<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png') no-repeat -154px 0;_background-image:url('<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png');"
               title="取消欣赏" href="javascript:tadelfollow(<?php echo $guid;?>)"></a>


            <!-- 自定义 --><A
                    title=自定义
                    style="DISPLAY: block; BACKGROUND: url(<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png) no-repeat 0px 0px; FLOAT: right; MARGIN-LEFT: 5px; WIDTH: 65px; HEIGHT: 26px"
                    href="<?php if (PPREWRITE == 1) {
                        echo BASE_URL; ?>m.customize<?php } else { ?><?php echo BASE_URL; ?>index.php?m=customize<?php }?>"
                    target=_top></A><!-- 转载 --><!-- 是否喜欢过 --><!-- 编辑和删除 --><!-- 推荐 --><A title=推荐
                                                                                         style="DISPLAY: block; BACKGROUND: url(<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png) no-repeat -511px 0px; FLOAT: right; MARGIN-LEFT: 5px; WIDTH: 51px; HEIGHT: 26px"
                                                                                         href="<?php echo BASE_URL;?>index.php?m=post.recommendadd&tta=<?php echo $guid;?>"
                                                                                         target=_top></A><!-- 分享 -->
            <?php } else if ($userinfo) { ?>
            <!-- 回首页 --><A
                    title=返回首页
                    style="DISPLAY: block; BACKGROUND: url(<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png) no-repeat -286px 0px; FLOAT: right; MARGIN-LEFT: 5px; WIDTH: 80px; HEIGHT: 26px"
                    href="<?php if (PPREWRITE == 1) {
                        echo BASE_URL; ?>m.index<?php } else { ?><?php echo BASE_URL; ?>index.php<?php }?>"
                    target=_top></A>
            <!-- 自定义 --><A
                    title=自定义
                    style="DISPLAY: block; BACKGROUND: url(<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png) no-repeat 0px 0px; FLOAT: right; MARGIN-LEFT: 5px; WIDTH: 65px; HEIGHT: 26px"
                    href="<?php if (PPREWRITE == 1) {
                        echo BASE_URL; ?>m.customize<?php } else { ?><?php echo BASE_URL; ?>index.php?m=customize<?php }?>"
                    target=_top></A>
            <!-- 推荐 --><A title='我要推荐'
                          style="DISPLAY: block; BACKGROUND: url(<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png) no-repeat -511px 0px; FLOAT: right; MARGIN-LEFT: 5px; WIDTH: 51px; HEIGHT: 26px"
                          href="<?php echo BASE_URL;?>index.php?m=post.recommendadd&tta=<?php echo $guid;?>"
                          target=_top></A>
            <?php } else { ?>
            <a href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.account.register<?php } else { ?><?php echo BASE_URL; ?>index.php?m=account.register<?php }?>"
               title="注册" target="_top"
               style="margin-left: 5px; display: block; float: right; width: 71px; height: 26px; background: url(&quot;<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png&quot;) no-repeat scroll -712px 0pt transparent;"></a>
            <a href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.account.login<?php } else { ?><?php echo BASE_URL; ?>index.php?m=account.login<?php }?>"
               title="登录" target="_top"
               style="margin-left: 5px; display: block; float: right; width: 71px; height: 26px; background: url(&quot;<?php echo BASE_URL;?>css/bgimg/nav-icons-ie6.png&quot;) no-repeat scroll -638px 0pt transparent;"></a>
            <?php
        }
    }?>
</DIV>
<script>
    function tafollow(uid) {
        $.ajax({
            type: "POST",
            url: "index.php?m=ta.ajaxfollow2",
            data: "uid=" + uid,
            success: function(msg) {
                var divcss = {display:"none"};
                $('#theyes').css(divcss);
                var divcss2 = {display:"block"};
                $('#theno').css(divcss2);
            }
        });

    }

    function tadelfollow(uid) {
        $.ajax({
            type: "POST",
            url: "index.php?m=ta.ajaxdelfollow2",
            data: "uid=" + uid,
            success: function(msg) {
                var divcss = {display:"none"};
                $('#theno').css(divcss);
                var divcss2 = {display:"block"};
                $('#theyes').css(divcss2);
            }
        });


    }
</script>
</BODY>
</HTML>

