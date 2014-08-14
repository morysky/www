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
    <link href="<?php echo BASE_URL;?>css/show.css" rel="stylesheet" type="text/css"/>
    <?php TPL::plugin('include/tophead');?>
    <style>
        #right_column h3 {
            background: none repeat scroll 0 0 #eaeaea;
            color: #2F4248;
            letter-spacing: 1px;
            margin: 0 0 10px;
            padding: 8px;
            text-transform: uppercase;
        }

        #right_column img {
            padding-top: 16px;
            padding-left: 40px;
        }

        #right_column span {
            padding-top: 16px;
            padding-left: 40px;
            color: #212121;
        }

        #right_column {
            color: #212121;
        }

        .linkpic {
            background: #dddddd;
            line-height: 26px;
            padding: 10px;
            border: 1px solid #efefef;
            margin-top: 12px;
        }

        .linkpic span {

            margin-left: 8px;
        }

        #left_column h3 {
            margin-top: 8px;
            font-size: 14px;
        }
    </style>
</head>
<body>
<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 header.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$m = V('g:m');

?>

<div id='face' style='display:none'>
    <?php TPL::plugin('include/face');?>
</div>

<!-- 头部开始 -->
<div class="header">
    <div class="contentdiv">
        <h1 class="logo">身旁网</h1>

        <div class="header_R">
            <p class="user_msg">让我的身旁有个你！ 友情，信任，合作，共赢，让我们走得更远！</p>
            <!-- 主导航 -->
            <ul class="main_nav">
                <li  <?php if ($m == '' || $m == 'index') { ?> class="current"<?php }?>><a
                        href="<?php if (USER::get('spschool') == 1) {
                            echo  'index.php?m=school';
                        } else {
                            echo 'index.php?m=index';
                        }?>" title="首页">首&nbsp;&nbsp;&nbsp;页</a></li>
                <li <?php if ($m == 'index.tagexplore') { ?>class="current"<?php }?>><a
                        href="index.php?m=index.tagexplore" title="标签客厅">标签客厅</a></li>
                <li <?php if ($m == 'index.newblog') { ?>class="current"<?php }?>><a href="index.php?m=index.newblog"
                                                                                     title="新进轻博">新进轻博</a></li>
                <li <?php if ($m == 'index.wall') { ?> class="current"<?php }?>><a target=blank
                                                                                   href="index.php?m=index.wall"
                                                                                   title="图片墙">图片墙</a></li>
                <li <?php if ($m == 'index.recommend' || $m == 'index.recommendqun') { ?>class="current"<?php }?>><a
                        href="index.php?m=index.recommend" title="推荐轻应用">推荐轻应用<span class="new">new</span></a></li>
            </ul>
        </div>
    </div>
</div>

<div id='container'>
    <div id='content' class='content'>
        <div id='right_column'>
            <h3>本站LOGO:</h3>
            <img src='<?php echo BASE_URL;?>ad/logo_small.png'></img>
            <br></br>
            <span>LOGO大小:100X34</span>
            <br></br>
            <img src='<?php echo BASE_URL;?>ad/logo_middle.png'></img>
            <br></br>
            <span>LOGO大小:120X40</span>
            <br></br>

            <h3>联系方式：</h3>
            <br></br>
            友情链接及其他市场合作请联系,
            <br></br>
            QQ: 1505300896 164935394
            <br></br>
            <br></br>

            <h3>链接要求：</h3>
            <br></br>
            1、违反我国现行法律的或含有令人不愉快内容的网
            　 站勿扰；
            <br></br>
            2、在业界有一定的知名度；
            <br></br>
            3、网站alexa排名不低于40000名；
            <br></br>
            4、站点 google pagerank 不少于1；
            <br></br>
            5、友情链接网站之间有义务向对方报告链接失效，图片更新等问题，在解除友情链接之前亦应该通知对方；
            <br></br>
            6、以上各项，shenpang.cc保留全部解释权。
        </div>
        <div id='left_column'>
            <h3>图片链接:</h3>

            <div class='linkpic'>
                <?php
                $db = APP :: ADP('db');
                $friendpiclink = $db->query('select * from ' . $db->getTable(T_FRIENDLINK) . ' where types="pic" order by sortid desc,fid desc');
                foreach ($friendpiclink as $key => $value) {
                    ?>
                    <span><a target=_blank href=<?php echo  $value['url'];?>><img width=88px height=30
                                                                                  src=<?php echo $value['logo'];?>></img></a></span>
                    <?php }?>
            </div>
            <h3>文字链接:</h3>

            <div class='linkpic'>
                <?php
                $db = APP :: ADP('db');
                $friendpiclink = $db->query('select * from ' . $db->getTable(T_FRIENDLINK) . ' where types="text" order by sortid desc,fid desc');
                foreach ($friendpiclink as $key => $value) {

                    ?>
                    <span><a target=_blank href=<?php echo  $value['url'];?>><?php echo $value['name'];?></a></span>
                    <?php }?>
            </div>
            <h3>学校链接：</h3>

            <div class='linkpic'>
                <?php
                $db = APP :: ADP('db');
                $friendpiclink = $db->query('select * from ' . $db->getTable(T_FRIENDLINK) . ' where types="school" order by sortid desc,fid desc');
                foreach ($friendpiclink as $key => $value) {

                    ?>
                    <span><a target=_blank href=<?php echo  $value['url'];?>><?php echo $value['name'];?></a></span>
                    <?php }?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<br></br>
<br></br>
<?php TPL::plugin('include/infooter2');?>

</body>
</html>