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
            <?php TPL::plugin('ad/adright');?>
        </div>
        <div id='left_column' style="padding:20px;">
            <h2 id="main-title">关于身旁网</h2>

            <div class="one-position">
                <h4>我们是谁？</h4>
                <ul>
                    <h5>身旁网的目标：做有追求，有理想，有价值的轻社区。</h5>
                    身旁网，立足南方，服务草根，学生。 我们不要求进来的人都是精英，但我们希望从身旁网走出去都是精英。
                </ul>
                <ul>
                    <h5>王楚旭（身旁网创始人）</h5>
                    一个平常而不平凡的家伙，不喜欢高调，喜欢简洁高效，喜欢交友，很执着，喜欢幻想，爱看科幻片，喜欢武侠片。来自华南理工大学，去过多玩，酷狗。
                    带着自己的追求与梦想，用二三个月写下身旁网第一版,立志把身旁网打造成为一个有追求，有理想的轻社区。 立志以“追求，团结，轻松，自由”建设一个以人为核心的身旁网团队。
                    不摆架子，不搞神秘，这就是平平常常，温和的我。这就是创始人：王楚旭。
                </ul>

                <ul>
                    <h5>邝展鹰（身旁网联合创始人）</h5>
                    一个相信奇迹，不认输，坚信身旁网能成为有影响力社区的家伙；一个愿意为身旁网不惜一切代价，帮助身旁网发展的家伙 ，一个坚信“以人为本”，才是最正确方向的家伙, 他就是身旁网的联合创始人：邝展鹰。
                </ul>

                <ul>
                    <h5>身旁网团队</h5>
                    一群在校大学生，研究生，带着对梦想的追求，对现实的挑战,对朋友的真诚，对知识的渴望。他们就是身旁网的核心队伍，经验虽少，却有一颗无比美好的心，他们将会是身旁网的栋梁。
                </ul>

            </div>


        </div>
        <div class="clear"></div>
    </div>
    <img id="content_bottom" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_bottom_edit_form.png?alpha">
</div>

<style>
    body {
        font-size: 16px;
    }

    h5 {
        font-weight: bold;
    }

    h2#main-title {
        color: #2D4159;
        font-size: 32px;
        margin: 0 0 30px;
    }

    .one-position {
        border-top: 1px solid #D3D5D7;
        margin-top: 20px;
    }

    .one-position h4 {
        color: #38546B;
        font-size: 22px;
        margin-top: 20px;
    }

    .one-position li {
        line-height: 20px;
        list-style: disc outside none;
        margin-left: 30px;
    }

    .one-position ul h5 {
        font-size: 14px;
        margin-bottom: 10px;
    }

    .one-position ul {
        margin-top: 20px;
    }
</style>
<?php TPL::plugin('include/infooter2');?>
</body>
</html>