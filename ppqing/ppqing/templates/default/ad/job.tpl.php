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
            <h2 id="main-title">招贤纳士</h2>

            <div class="one-position">
                <h4>网站编辑</h4>

                <ul>
                    <h5>岗位职责：</h5>
                    <li> 能写优秀的文章，对社区有足够的了解</li>
                    <li>负责网站的编辑工作</li>
                    <li>让身旁网与时俱进</li>
                </ul>

                <ul>
                    <h5>职位要求：</h5>
                    <li>文科毕业，有一定的相关电脑操作</li>
                    <li>掌握一定的html知识，写过优秀文章优先</li>
                    <li>有责任心</li>
                    <li>良好的沟通和学习能力</li>
                </ul>
            </div>

            <div class="one-position">
                <h4> 市场部</h4>

                <ul>
                    <h5>岗位职责：</h5>
                    <li> 负责市场的开发</li>
                    <li>营销</li>
                    <li>让身旁网的牌子走得更远</li>
                </ul>

                <ul>
                    <h5>职位要求：</h5>
                    <li>文科,理科都可，有一定的相关电脑操作</li>
                    <li>对互联网市场了解，懂得市场的运转</li>
                    <li>有一二年的市场营销经验</li>
                    <li>良好的沟通和学习能力</li>
                </ul>
            </div>

            <div class="one-position">
                <h4> php程序员</h4>

                <ul>
                    <h5>岗位职责：</h5>
                    <li> 身旁网的开发和运维</li>
                    <li>保证网站的正常运行</li>
                    <li>开发更多的功能</li>
                </ul>

                <ul>
                    <h5>职位要求：</h5>
                    <li>本科毕业，计算机相关专业</li>
                    <li>精通php,js,css.html</li>
                    <li>有服务器运维经验，有大网站开发，运维经验优先</li>
                    <li>熟悉linux,mysql,memcached,等相关和识</li>
                    <li>有责任心</li>
                </ul>
            </div>


            <div class="one-position">
                <h4>邮箱：hr@shenpang.cc</h4>
                <h4>或邮箱：shenpang.hr@gmail.com</h4>
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