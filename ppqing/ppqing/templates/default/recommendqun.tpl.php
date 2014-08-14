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
    <title>推荐轻博群－<?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
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
    showPopWin('index.php?m=setting.fristpic', 700, 400, null);

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
        if ($fenlei) $fenleiadd = ' and types=\'' . $fenlei . '\' ';
        if ($cid) $userinfo['uid'] = $cid;
        $page = V('g:page');
        if (!$page) $page = 1;
        $sum = 20;
        $total = ($page - 1) * $sum;
        $db = APP :: ADP('db');
        $rows = $db->query('select count(uid) as count from ' . $db->getTable(T_GROUP_CONFIG) . ' where descs !=\'\' ' . $fenleiadd . '  order by tuinum desc limit 100');
        $allcount = $rows[0]['count'];
        $fresults = $db->query('select * from ' . $db->getTable(T_GROUP_CONFIG) . ' where descs !=\'\' ' . $fenleiadd . '   order by tuinum desc limit 21 ');

        ?>
        <div class="to-be-discovered">
            <a href="index.php?m=post.recommendqunadd" id="to-be-discovered">推荐优秀博群</a></div>
        <div class="tag-tabs-holder hot-tag-selected clearfix">
            <h2 class="discovery-title clearfix">
                <a href="index.php?m=index.recommend" class="current">推荐轻博群</a></h2>
        </div>
        <div class="tag-recommend-tips">这里只会展示被推荐次数多、内容优秀的博客，所以，如果想出现在这里的话，让朋友们多多推荐你的博客吧！</div>
        <div class="tags-holder clearfix">
            <h4>分类：</h4>

            <div class="tags-list-holder">
                <ul class="clearfix">
                    <li  <?php if ($fenlei == '其他') { ?>class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=其他">其他</a></li>
                    <li <?php if ($fenlei == '华南理工大学') { ?>class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=华南理工大学">华南理工大学</a></li>
                    <li  <?php if ($fenlei == '广东外语外贸大学') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=广东外语外贸大学">广东外语外贸大学</a></li>
                    <li  <?php if ($fenlei == '华南师范大学') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=华南师范大学">华南师范大学</a></li>
                    <li  <?php if ($fenlei == '中山大学') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=中山大学">中山大学</a></li>
                    <li  <?php if ($fenlei == '广东工业大学') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=广东工业大学">广东工业大学</a></li>
                    <li  <?php if ($fenlei == '广州大学') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=广州大学">广州大学</a></li>
                    <li  <?php if ($fenlei == '广东药学院') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=广东药学院">广东药学院</a></li>
                    <li  <?php if ($fenlei == '广州中医药大学') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=广州中医药大学">广州中医药大学</a></li>
                    <li  <?php if ($fenlei == '广州美术学院') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=广州美术学院">广州美术学院</a></li>
                    <li  <?php if ($fenlei == '星海音乐学院') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=星海音乐学院">星海音乐学院</a></li>
                    <li  <?php if ($fenlei == '华南农业大学') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=华南农业大学">华南农业大学</a></li>
                    <li  <?php if ($fenlei == '中山大学南方学院') { ?> class="selected" <?php }?>><a
                            href="index.php?m=index.recommendqun&fenlei=中山大学南方学院">中大南方学院</a></li>
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

                <div class="users-col ">

                    <div class="one-user one-user-style-1 new">
                        <div class="user-info"><a id="user-148587" class="user-name"
                                                  href="index.php?m=group&gid=<?php echo $value['gid'];?>"
                                                  target="_blank"><span
                                style="background-image:url(<?php if (file_exists('var/upload/group/' . $value['gid'] . '.jpg')) {
                                    echo BASE_URL . 'var/upload/group/' . $value['gid'] . '.jpg';
                                } else {
                                    echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                }?>)"></span><?php echo $value['gname'];?></a><span class="user-bio">
<?php if ($value['descs']) {
                            echo  $value['descs'];
                        } else {
                            echo '本轻博群还没有描述简介';
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
<style>
    .tags-holder li {
        width: 125px;
    }
</style>
<div style="height:30px;"></div>
<?php TPL::plugin('include/infooter2');?>
</body>
</html>