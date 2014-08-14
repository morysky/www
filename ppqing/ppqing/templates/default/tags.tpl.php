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
    <link rel="shortcut icon" href="<?php
echo BASE_URL;
    ?>favicon.ico"/>
    <link href="<?php
echo BASE_URL;
    ?>css/base.css" rel="stylesheet"
          type="text/css"/>
    <?php
    $id = V('g:id');
    if (file_exists("tagsad/tpl/" . $id . "/style.css")) {
        ?>
        <link href="<?php
echo BASE_URL;
            ?>tagsad/tpl/<?php echo $id;?>/style.css" rel="stylesheet"
              type="text/css"/>
        <?php
    }
    ?>
    <?php TPL::plugin('include/tophead');?>
</head>
<body>
<?php
TPL::plugin('include/header');
?>
<div id='container'>

<?php

    $db = APP :: ADP('db');

    if (file_exists("tagsad/tpl/" . $id . "/index.tpl")) {
        echo file_get_contents("tagsad/tpl/" . $id . "/index.tpl");
    }
    $tagsrow = $db->query('select * from ' . $db->getTable(T_TAGS) . ' where tarid=' . $id);
    ?>
    <div id='content' class='content'>
        <div style='margin-left:-20px!important;margin-left:-32px;margin-right:-38px;width:902px!important; width:918px;height:50px;background:#727780;padding-top:10px!important;margin-top:2px!important;margin-top:30px'>
            <span style='margin-left:60px;font-size:30px;color:#f1f1f1;'>#<b><?php echo $tagsrow[0]['tarname'];?></b> | 发表(<a
                    target=_blank
                    href="index.php?m=post.text&mtags=<?php echo urlencode($tagsrow[0]['tarname']);?>">文本</a>，<a
                    target=_blank
                    href="index.php?m=post.photo&mtags=<?php echo urlencode($tagsrow[0]['tarname']);?>">图片</a>，<a
                    target=_blank
                    href="index.php?m=post.video&mtags=<?php echo urlencode($tagsrow[0]['tarname']);?>">视频</a>，<a
                    target=_blank
                    href="index.php?m=post.audio&mtags=<?php echo urlencode($tagsrow[0]['tarname']);?>">音乐</a>)</span>
        </div>
        <div style="height:20px;"></div>
        <div id='right_column'>
<?php
$id = V('g:id');
    $db = APP::ADP('db');
    $rows = $db->query('select * from ' . $db->getTable(T_TAGS_CONTENT) . ' x left join ' . $db->getTable(T_USERS) . ' y on x.uid=y.uid where tarid=' . $id . ' group by name order by did desc limit 20 ');
    $rows = APP::F('content_filter', $rows);
    ?>
    <div
            style="padding-left: 0; position: relative; padding-top: 0px; margin-bottom: 10px;"
            class="dashboard_nav_item">
        <div class="dashboard_nav_title">新标签用户</div>
        <div id='dashboard_controls_suggested_blogs'>
            <?php foreach ($rows as $key => $value) { ?>
            <div class="dashboard_controls_suggested_blog">
                <a
                        href="<?php if ($value['domname']) {
                            echo $value['domname'];
                        } else { ?>index.php?m=ta&uid=<?php echo $value['uid']; ?><?php }?>"> <img height="40"
                                                                                                   width="40"
                                                                                                   class="suggested_blog_avatar"
                                                                                                   src="<?php if (file_exists('avatar/i_upload/' . $value['uid'] . '_small.jpg')) {
                                                                                                       echo BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small.jpg';
                                                                                                   } else {
                                                                                                       echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                                                                                   }?>">

                    <div class="suggested_blog_name"><?php echo $value['name'];?> </div>

                </a></div>
            <?php }?>

        </div>
    </div>

<?php

    $rows = $db->query('select * from ' . $db->getTable(T_CONTENT) . ' z left join ' . $db->getTable(T_TAGS_CONTENT) . ' x on z.did=x.did left join ' . $db->getTable(T_USERS) . ' y on x.uid=y.uid where x.tarid=' . $id . ' group by z.did order by z.likenum desc limit 20 ');
    $rows = APP::F('content_filter', $rows);
    ?>
    <div
            style="padding-left: 0; position: relative; padding-top: 0px; margin-bottom: 10px;"
            class="dashboard_nav_item">
        <div class="dashboard_nav_title">最受欢迎信息</div>
        <div id='dashboard_controls_suggested_blogs'>
            <?php foreach ($rows as $key => $value) { ?>
            <div class="dashboard_controls_suggested_blog">
                <a
                        href="<?php if ($value['domname']) {
                            echo $value['domname'];
                        } else { ?>index.php?m=ta&uid=<?php echo $value['uid']; ?><?php }?>"> <img height="40"
                                                                                                   width="40"
                                                                                                   class="suggested_blog_avatar"
                                                                                                   src="<?php if (file_exists('avatar/i_upload/' . $value['uid'] . '_small.jpg')) {
                                                                                                       echo BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small.jpg';
                                                                                                   } else {
                                                                                                       echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                                                                                   }?>">

                    <div class="suggested_blog_name"><?php echo $value['title'];?><br>(<b
                            style="color:red"><?php echo $value['likenum']?></b>喜欢)
                    </div>

                </a></div>
            <?php }?>

        </div>
    </div>
        </div>
        <div id='left_column'>

<?php
TPL::plugin('include/tags');
    ?>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php TPL::plugin('include/infooter');?>
</body>
</html>