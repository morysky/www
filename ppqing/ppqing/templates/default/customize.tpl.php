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
?>
<?php 
$userinfo = USER::get('userinfo');
$db = APP :: ADP('db');
$theinfo = $db->query('select * from ' . $db->getTable(T_USERS) . ' where uid=' . $uid);
$SPconfig = unserialize(SPCONFIG);
$tplArr = false;
if (file_exists('usercss/' . $userinfo['uid'] . '.tpl')) {
    $tpl = file_get_contents('usercss/' . $userinfo['uid'] . '.tpl');
    $tplArr = unserialize($tpl);
}
?>

<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>自定义页面-<?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL;?>css/n_customize.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jscolor.js"></script>

</head>
<body>
<div id="customize-panel">
    <ul id="customize-nav">
        <li><a id="nav-customize-user-info" href='<?php if (PPREWRITE == 1) {
            echo BASE_URL; ?>m.index<?php } else { ?><?php echo BASE_URL; ?>index.php<?php }?>'>身旁首页</a></li>
        <li><a class="active" id="nav-customize-theme-list" onclick='setprocess(1)'>模版主题</a></li>
        <li><a id="nav-customize-advanced" onclick='setprocess(2)'>自定义主题外观</a></li>
        <li><a id="nav-customize-contribute" href='<?php if (PPREWRITE == 1) {
            echo BASE_URL; ?>m.setting<?php } else { ?><?php echo BASE_URL; ?>index.php?m=setting<?php }?>'>高级设置</a>
        </li>
    </ul>
    <div id="customize-action">
        <a class="round-button" onclick='savetheme()' id="customize-save"><span>保存</span>
        </a> <a class="round-button round-button-cancel" id="customize-cancel" href="<?php if (PPREWRITE == 1) {
        echo BASE_URL; ?>m.ta?uid=<?php echo $userinfo['uid']; ?><?php } else { ?><?php echo BASE_URL; ?>/index.php?m=ta&&uid=<?php echo $userinfo['uid']; ?><?php }?>"><span>取消</span>
    </a>
    </div>

    <div id="customize-theme-list" class="customize-item" style="">
        <div class="customize-theme-list-scroll-wrap">
            <ul class="clearfix" id="customize-theme-ul">
                <li id="theme-32"><a onclick="pretheme('fan')" class="customize-theme-thumb"
                                     style="background-image: url(&quot;<?php echo BASE_URL;?>css/fan_skin/thumbpic.png&quot;);">蓝色爱情</a><a
                        onclick="pretheme('fan')" class="customize-theme-name">蓝色爱情</a></li>
                <li id="theme-29"><a onclick="pretheme('glass')" class="customize-theme-thumb"
                                     style="background-image: url(&quot;<?php echo BASE_URL;?>css/glass_skin/thumbpic.png&quot;);">玻璃动感</a><a
                        onclick="pretheme('glass')" class="customize-theme-name">玻璃动感</a></li>
                <li id="theme-28"><a onclick="pretheme('letter')" class="customize-theme-thumb"
                                     style="background-image: url(&quot;<?php echo BASE_URL;?>css/letter_skin/thumbpic.png&quot;);">书签</a><a
                        onclick="pretheme('letter')" class="customize-theme-name">书签</a></li>
                <li id="theme-27"><a onclick="pretheme('love')" class="customize-theme-thumb"
                                     style="background-image: url(&quot;<?php echo BASE_URL;?>css/love_skin/thumbpic.png&quot;);">简单</a><a
                        onclick="pretheme('love')" class="customize-theme-name">简单</a></li>
                <li id="theme-24"><a onclick="pretheme('nature')" class="customize-theme-thumb"
                                     style="background-image: url(&quot;<?php echo BASE_URL;?>css/nature_skin/thumbpic.png&quot;);">自然海洋</a><a
                        onclick="pretheme('nature')" class="customize-theme-name">自然海洋</a></li>
                <li id="theme-19"><a onclick="pretheme('new')" class="customize-theme-thumb"
                                     style="background-image: url(&quot;<?php echo BASE_URL;?>css/new_skin/thumbpic.png&quot;);">黑色经典</a><a
                        onclick="pretheme('new')" class="customize-theme-name">黑色经典</a></li>
                <li id="theme-25"><a onclick="pretheme('xdai')" class="customize-theme-thumb"
                                     style="background-image: url(&quot;<?php echo BASE_URL;?>css/xdai_skin/thumbpic.png&quot;);">个性写照</a><a
                        onclick="pretheme('xdai')" class="customize-theme-name">个性写照</a></li>
                <li id="theme-22"><a onclick="pretheme('newsimple')" class="customize-theme-thumb"
                                     style="background-image: url(&quot;<?php echo BASE_URL;?>css/newsimple_skin/thumbpic.png&quot;);">简洁风</a><a
                        onclick="pretheme('newsimple')" class="customize-theme-name">简洁风</a></li>
            </ul>
            <div class="customize-advanced-html-action" style="display:none">
                <a class="simple-gray-button" id="customize-advanced-html-button">自定义HTML</a>
            </div>
        </div>
    </div>
    <div id="customize-theme-property" class="customize-item" style="display: none;">
        <h3>
            主题外观设置<a id="customize-theme-property-reset" onclick='delcss()'>重置为默认值</a>
        </h3>

        <div class="customize-theme-property-form" id="customize-theme-property-form">
            <div class="customize-property-item customize-property-item-color"><label>背景颜色</label><input
                    id='spproperty1' autocomplete="off"
                    class="shadow-input-text customize-property-item-color-input color {styleElement:'jsColorPreview1'}"
                    value="<?php if ($tplArr) {
                        echo $tplArr['nowColor1'];
                    }?>" type="text"><span id="jsColorPreview1" class="customize-property-item-color-preview"
                                           style="background-color: rgb(213, 213, 213); color: rgb(0, 0, 0);"></span><input
                    class="customize-property-item-value" value="#D5D5D5" type="hidden"></div>

            <div class="customize-property-item customize-property-item-color"><label>正文颜色</label><input
                    id='spproperty2' autocomplete="off"
                    class="shadow-input-text customize-property-item-color-input color {styleElement:'jsColorPreview2'}"
                    value="<?php if ($tplArr) {
                        echo $tplArr['nowColor2'];
                    }?>" type="text"><span id="jsColorPreview2" class="customize-property-item-color-preview"
                                           style="background-color: rgb(124, 124, 124); color: rgb(255, 255, 255);"></span><input
                    class="customize-property-item-value" value="#7C7C7C" type="hidden"></div>

            <div class="customize-property-item customize-property-item-color"><label>链接颜色</label><input
                    id='spproperty3' autocomplete="off"
                    class="shadow-input-text customize-property-item-color-input color {styleElement:'jsColorPreview5'}"
                    value="<?php if ($tplArr) {
                        echo $tplArr['nowColor3'];
                    }?>" type="text"><span id="jsColorPreview5" class="customize-property-item-color-preview"
                                           style="background-color: rgb(46, 109, 123); color: rgb(255, 255, 255);"></span><input
                    class="customize-property-item-value" value="#2E6D7B" type="hidden"></div>
            <div class="customize-property-item customize-property-item-number"><label>背景图片url</label><input
                    id='spproperty4' value="<?php if ($tplArr) {
                echo $tplArr['nowColor4'];
            }?>" class="shadow-input-text customize-property-item-number-input" style="width:150px;' type=" text"
                ><input value="" class="customize-property-item-value" type="hidden"></div>

            <div class="customize-property-item customize-property-item-css"><label>自定义CSS样式</label>

                <div class="customize-advanced-css-header">
                    <div id="customize-advanced-css-flash-holder"></div>
                    <div id="customize-advanced-css-flash-tip" style="display:none;">正在上传...</div>
                    <div class="customize-advanced-css-input"><textarea
                            class="shadow-input-text customize-property-item-css-input" type="text"
                            id="customize-advanced-css-input"><?php if ($tplArr) {
                        echo $tplArr['mycss'];
                    }?></textarea></div>
                    <input value="" class="customize-property-item-value" type="hidden"></div>
            </div>
            <div>
                <div class="customize-advanced-css-action"><a class="simple-gray-button" onclick='postcss()'
                                                              id="customize-advanced-preview">预览效果</a></div>
            </div>
        </div>
    </div>

</div>
<div style="display:none">
    <h3>更多选项</h3>

    <div class="privacy-blog">
        <h4 class="privacy-blog-hd"><label for="customize-privacy-blog-checkbox"><input
                id="customize-privacy-blog-checkbox" data-privacy="0" type="checkbox">设置成私密博客</label></h4>

        <div class="privacy-blog-tip">只有输入正确的密码，才可以访问这个博客</div>
        <div><input id="customize-privacy-blog-password" class="input-text privacy-password" type="text"><img
                class="customize-privacy-blog-locked" src="shequba_files/privacy_blog_locked_s.png" alt=""></div>
    </div>
</div>
</div>
</div>
<form id="iframePostForm" action="http://www.diandian.com/n/dlog/show/preview/169368" method="post"
      target="previewPanelIframe" style="display: none">&nbsp;</form>
<div id="profile-preview-holder">
    <iframe style='height:891px;'
            src="<?php echo BASE_URL;?>index.php?m=ta&&uid=<?php echo $userinfo['uid'];?>&tname=default"
            id="profile-preview-frame" name="previewPanelIframe" frameborder="0" height="98%" width="100%"></iframe>
</div>


<script>
    var makename = 'default';

    function pretheme(name) {
        makename = name;
        var prename = '<?php echo BASE_URL;?>index.php?m=ta&&uid=<?php echo $userinfo['uid'];?>&tname=' + name;
        $("#profile-preview-frame").attr("src", prename);
    }

    function savetheme() {
        if (makename == 'default') {
            self.location = '<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.ta?uid=<?php echo $userinfo['uid']; ?><?php } else { ?><?php echo BASE_URL; ?>index.php?m=ta&&uid=<?php echo $userinfo['uid']; ?><?php }?>';
        } else {
            $.ajax({
                type: "POST",
                url: "index.php?m=index.face",
                data: "name=" + makename,
                success: function(msg) {
                    self.location = '<?php if (PPREWRITE == 1) {
                        echo BASE_URL; ?>m.ta?uid=<?php echo $userinfo['uid']; ?><?php } else { ?><?php echo BASE_URL; ?>index.php?m=ta&&uid=<?php echo $userinfo['uid']; ?><?php }?>';
                }

            });
        }


    }
    function nosavetheme() {
        self.location = '<?php echo BASE_URL;?>index.php?m=ta&&uid=<?php echo $userinfo['uid'];?>';
    }

    function setprocess(inum) {
        if (inum == 2) {
            $('#nav-customize-theme-list').removeClass('active');
            $('#nav-customize-advanced').addClass('active');
            var divcss = {display:"none"};
            $('#customize-theme-list').css(divcss);
            var divcss2 = {display:"block"};
            $('#customize-theme-property').css(divcss2);
        }
        if (inum == 1) {
            $('#nav-customize-advanced').removeClass('active');
            $('#nav-customize-theme-list').addClass('active');
            var divcss = {display:"none"};
            $('#customize-theme-property').css(divcss);
            var divcss2 = {display:"block"};
            $('#customize-theme-list').css(divcss2);
        }

    }

    function postcss() {
        var nowColor1 = $('#spproperty1').val();
        var nowColor2 = $('#spproperty2').val();
        var nowColor3 = $('#spproperty3').val();
        var nowColor4 = $('#spproperty4').val();
        var mycss = $('#customize-advanced-css-input').val();

        $.ajax({
            type: "POST",
            url: "index.php?m=index.postcss",
            data: 'nowColor1=' + nowColor1 + '&nowColor2=' + nowColor2 + '&nowColor3=' + nowColor3 + '&nowColor4=' + nowColor4 + '&mycss=' + mycss,
            success: function(msg) {
                var prename = '<?php echo BASE_URL;?>index.php?m=ta&&uid=<?php echo $userinfo['uid'];?>&tname=' + makename;
                $("#profile-preview-frame").attr("src", prename);
            }
        });

    }

    function delcss() {
        $.ajax({
            type: "POST",
            url: "index.php?m=index.delcss",
            success: function(msg) {
                var prename = '<?php echo BASE_URL;?>index.php?m=ta&&uid=<?php echo $userinfo['uid'];?>&tname=' + makename;
                $("#profile-preview-frame").attr("src", prename);
            }
        });

    }
</script>
<?php TPL::plugin('include/footer');?>
</body>
</html>