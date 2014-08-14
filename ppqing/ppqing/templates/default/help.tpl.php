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
    <title>新手帮助－<?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL;?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL;?>css/help-style.css" rel="stylesheet" type="text/css"/>
    <?php TPL::plugin('include/tophead');?>
</head>
<body>

<?php TPL::plugin('include/header');?>
<div id='container'>
    <?php TPL::plugin('include/topcontainer');?>
    <div id="main">
        <div id="help">
            <div id="help-title">帮助中心</div>
            <div class="help-item">玩转身旁</div>
            <div class="help-item">问题帮助</div>
        </div>
        <div id="wellcome">
            欢迎来到身旁网，来看看身旁网能带给您什么?
        </div>

        <div class="detail">
            <div class="detail-img">
                <img width='360px' src="<?php echo BASE_URL;?>css/help/detail-img-1.jpg">
            </div>

            <div class="detail-article">
                <h3>标签客厅是什么</h3>

                <div class="text">标签页汇聚了您身边好友的最新动态，在这里您可以了解身边朋友的在做什么，想什么。</div>

                <div class="buttom"><a href="<?php echo BASE_URL;?>index.php?m=index.tagexplore"><img
                        src="<?php echo BASE_URL;?>css/help/look.jpg"></a></div>
            </div>
        </div>
        <div class="clr"></div>
        <div class="detail">
            <div class="detail-img">
                <img width='360px' src="<?php echo BASE_URL;?>css/help/detail-img-2.jpg">
            </div>

            <div class="detail-article">
                <h3>新进博客</h3>

                <div class="text">让我们在这里欢迎我们的新朋友，或许在这您有意外的发现哦。</div>
                <div class="buttom"><a href="<?php echo BASE_URL;?>index.php?m=index.newblog"><img
                        src="<?php echo BASE_URL;?>css/help/look.jpg"></a></div>
            </div>
        </div>
        <div class="clr"></div>
        <div class="detail">
            <div class="detail-img">
                <img width='360px' src="<?php echo BASE_URL;?>css/help/detail-img-3.jpg">
            </div>

            <div class="detail-article">
                <h3>发现身旁新鲜事</h3>

                <div class="text">身旁网各种新鲜事都在“发现”频道为您展现。</div>
                <div class="buttom"><a href="<?php echo BASE_URL;?>index.php?m=index.wall"><img
                        src="<?php echo BASE_URL;?>css/help/look.jpg"></a></div>
            </div>
        </div>
        <div class="clr"></div>
        <div class="detail">
            <div class="detail-img">
                <img width='360px' src="<?php echo BASE_URL;?>css/help/detail-img-4.jpg">
            </div>

            <div class="detail-article">
                <h3>推荐博客</h3>

                <div class="text">好东西要和大家一同分享，发现身旁精彩博客时，可以点击<a href="#"><img
                        src="<?php echo BASE_URL;?>css/help/bowen.jpg" alt="推荐优秀博客"></a>与您的朋友一同分享。
                </div>
                <div class="buttom"><a href="<?php echo BASE_URL;?>index.php?m=index.recommend"><img
                        src="<?php echo BASE_URL;?>css/help/look.jpg"></a></div>
            </div>
        </div>

        <div class="clr"></div>
        <div class="detail">
            <div class="detail-img">
                <img width='360px' src="<?php echo BASE_URL;?>css/help/detail-img-5.jpg">
            </div>

            <div class="detail-article">
                <h3>强大的功能列表</h3>

                <div class="text">
                    身旁网具有完善的功能列表，方便您浏览分享。身旁网将秉承“生命要用心涂鸦，每个人都是艺术家”的信念，竭诚为您服务。
                </div>
                <div class="buttom"><a href="<?php echo BASE_URL;?>index.php?m=index"><img
                        src="<?php echo BASE_URL;?>css/help/look.jpg"></a></div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php TPL::plugin('include/footer');?>
</body>
