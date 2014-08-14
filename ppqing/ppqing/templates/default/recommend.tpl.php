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
$userinfo = USER::get('userinfo');
$SPconfig = unserialize(SPCONFIG);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>推荐轻博客－<?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL;?>css/base.css" rel="stylesheet" type="text/css"/>
    <?php TPL::plugin('include/tophead');?>
</head>
<body>
<?php if (!file_exists('avatar/i_upload/' . $userinfo['uid'] . '_small_2.jpg')) { ?>
<link href="<?php echo BASE_URL;?>css/subModal.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/subModal.js"></script>
<script>
    initPopUp(0);
    showPopWin('index.php?m=setting.fristpic', 700, 360, null);

</script>
    <?php }?>
<?php TPL::plugin('include/header');?>
<div id='container'>
    <div class="clearfix" id="head_nav">
        <?php TPL::plugin('include/tuiheader');?>
    </div>
    <div style="height:30px;"></div>
    <div id='contentre' class='content'>
        <div class='contenttop'></div>
        <?php

        $cid = V('g:id');
        $fenlei = V('g:fenlei');
        $fenleiadd = '';
        if ($fenlei) $fenleiadd = ' and fenlei=\'' . $fenlei . '\' ';
        if ($cid) $userinfo['uid'] = $cid;
        $page = V('g:page');
        if (!$page) $page = 1;
        $sum = 20;
        $total = ($page - 1) * $sum;
        $db = APP :: ADP('db');
        $rows = $db->query('select count(uid) as count from ' . $db->getTable(T_USERS) . ' where descs !=\'\' ' . $fenleiadd . '  order by tui desc limit 100');
        $allcount = $rows[0]['count'];
        $fresults = $db->query('select * from ' . $db->getTable(T_USERS) . ' where descs !=\'\' ' . $fenleiadd . '   order by tui desc limit 21 ');

        ?>
        <div class="to-be-discovered">
            <a href="index.php?m=post.recommendadd" id="to-be-discovered">推荐优秀博客</a></div>
        <div class="tag-tabs-holder hot-tag-selected clearfix">
            <h2 class="discovery-title clearfix">
                <a href="index.php?m=index.recommend" class="current">推荐轻博客</a></h2>
        </div>
        <div class="tag-recommend-tips">这里只会展示被推荐次数多、内容优秀的博客，所以，如果想出现在这里的话，让朋友们多多推荐你的博客吧！</div>
        <div class="tags-holder clearfix">
            <h4>分类：</h4>

            <div class="tags-list-holder">
                <ul class="clearfix">
                    <li  <?php if ($fenlei == '影视') { ?>class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E5%BD%B1%E8%A7%86">影视</a></li>
                    <li <?php if ($fenlei == '艺术') { ?>class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E8%89%BA%E6%9C%AF">艺术</a></li>
                    <li  <?php if ($fenlei == '时尚') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E6%97%B6%E5%B0%9A">时尚</a></li>
                    <li  <?php if ($fenlei == '音乐') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E9%9F%B3%E4%B9%90">音乐</a></li>
                    <li  <?php if ($fenlei == '摄影') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E6%91%84%E5%BD%B1">摄影</a></li>
                    <li  <?php if ($fenlei == '宠物') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E5%AE%A0%E7%89%A9">宠物</a></li>
                    <li  <?php if ($fenlei == '美食') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E7%BE%8E%E9%A3%9F">美食</a></li>
                    <li  <?php if ($fenlei == '历史') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E5%8E%86%E5%8F%B2">历史</a></li>
                    <li  <?php if ($fenlei == '动漫') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E5%8A%A8%E6%BC%AB">动漫</a></li>
                    <li  <?php if ($fenlei == '旅行') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E6%97%85%E8%A1%8C">旅行</a></li>
                    <li  <?php if ($fenlei == '恋物') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E6%81%8B%E7%89%A9">恋物</a></li>
                    <li  <?php if ($fenlei == '怪趣') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E6%80%AA%E8%B6%A3">怪趣</a></li>
                    <li  <?php if ($fenlei == '体育') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E4%BD%93%E8%82%B2">体育</a></li>
                    <li  <?php if ($fenlei == '汽车') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E6%B1%BD%E8%BD%A6">汽车</a></li>
                    <li  <?php if ($fenlei == '建筑') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E5%BB%BA%E7%AD%91">建筑</a></li>
                    <li  <?php if ($fenlei == '科学') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E7%A7%91%E5%AD%A6">科学</a></li>
                    <li  <?php if ($fenlei == '阅读') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E9%98%85%E8%AF%BB">阅读</a></li>
                    <li  <?php if ($fenlei == '生活') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E7%94%9F%E6%B4%BB">生活</a></li>
                    <li  <?php if ($fenlei == '数码') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=%E6%95%B0%E7%A0%81">数码</a></li>
                    <li  <?php if ($fenlei == '网络') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=网络">网络</a></li>
                    <li  <?php if ($fenlei == '编程') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=编程">编程</a></li>
                    <li  <?php if ($fenlei == '企业') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=企业">企业</a></li>
                    <li  <?php if ($fenlei == '招聘') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommend&fenlei=招聘">招聘</a></li>
                </ul>
            </div>
        </div>
        <?php if ($allcount > 0) { ?>
        <div class="users-holder clearfix">
            <?php

            foreach ($fresults as $key => $value) {
                if ($key == 0 || $key % 3 == 0) {
                    echo "<div style='display:block;clear:both'>";
                }
                ;
                ?>

                <div class="users-col users-col-1">

                    <div class="one-user one-user-style-1 new">
                        <div class="user-info"><a id="user-148587" class="user-name"
                                                  href="<?php if ($value['domname']) {
                                                      echo $value['domname'];
                                                  } else { ?>index.php?m=ta&uid=<?php echo $value['uid']; ?><?php }?>"
                                                  target="_blank"><span
                                style="background-image:url(<?php if (file_exists('avatar/i_upload/' . $value['uid'] . '_small_2.jpg')) {
                                    echo BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small_2.jpg';
                                } else {
                                    echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                }?>)"></span><?php echo $value['name'];?></a><span class="user-bio">
<?php if ($value['descs']) {
                            echo  $value['descs'];
                        } else {
                            echo '本博客还没有描述简介';
                        }?></span><?php if ($key < 3) { ?><s class="new-icon"></s><?php }?></div>
                        <div class="user-box-shadow"></div>
                    </div>
                </div>
                <?php if ($key % 3 == 2) {
                    echo '</div>';
                } ?>
                <?php }?>

            <div class="users-col users-col-3"></div>
        </div>
        <?php }?>



        <div class="clear"></div>
    </div>
</div>
<div style="height:30px;"></div>
<?php TPL::plugin('include/infooter2');?>
</body>
</html>