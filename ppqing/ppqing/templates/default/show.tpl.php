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
$id = V('g:id');
$db = APP :: ADP('db');
$theinfo = $db->query('select * from ' . $db->getTable(T_CONTENT) . ' where did=' . $id);

$title = APP::F('cut_str', $theinfo[0]['title'], 60);

$SPuid = $theinfo[0]['uid'];
$SPconfig = unserialize(SPCONFIG);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $title;?>-<?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL;?>css/base2.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL;?>css/show.css" rel="stylesheet" type="text/css"/>


</head>
<body>
<div id='facetmp'>
    <?php

    $uid = $SPuid;
    $facerows = $db->query('select * from ' . $db->getTable(T_USER_CONFIG) . ' where uid=' . $uid);
    if ($facerows) {
        ?>
        <link href="<?php echo BASE_URL;?>css/<?php echo $facerows[0]['face'];?>_skin/skin.css" rel="stylesheet"
              type="text/css"/>



        <?php
        if (file_exists('usercss/' . $uid . '.tpl')) {
            $tpl = file_get_contents('usercss/' . $uid . '.tpl');
            $tplArr = unserialize($tpl);
            echo '<style>';

            if ($tplArr['nowColor1']) {
                echo 'html{background:#' . $tplArr['nowColor1'] . '} ';
            }
            if ($tplArr['nowColor2']) {
                echo '.post{color:#' . $tplArr['nowColor2'] . '} ';
            }
            if ($tplArr['nowColor3']) {
                echo '#container a{color:#' . $tplArr['nowColor3'] . '} ';
            }
            if ($tplArr['nowColor4']) {
                echo 'body{background:url(' . $tplArr['nowColor4'] . ')} ';
            }
            if ($tplArr['mycss']) {
                echo $tplArr['mycss'];
            }
            echo '</style>';
        }
    }?>
</div>
<link href="<?php echo BASE_URL;?>css/ta.css" rel="stylesheet" type="text/css"/>
<?php if ($facerows && file_exists('templates/default/themes/' . $facerows[0]['face'] . '/show.tpl.php')) { ?>
    <?php TPL::plugin('include/taheader', array('SPuid' => $SPuid)); ?>
    <?php TPL::plugin('themes/' . $facerows[0]['face'] . '/show', array('SPuid' => $SPuid)); ?>
    <?php } else { ?>
<link href="<?php echo BASE_URL;?>css/newimage/css/layout.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo BASE_URL;?>css/newimage/css/base.css" type="text/css" rel="stylesheet"/>
    <?php TPL::plugin('include/taheader', array('SPuid' => $SPuid));
    if (file_exists('usercss/' . $uid . '.tpl')) {
        $tpl = file_get_contents('usercss/' . $uid . '.tpl');
        $tplArr = unserialize($tpl);
        echo '<style>';

        if ($tplArr['nowColor1']) {
            echo 'html{background:#' . $tplArr['nowColor1'] . '}';
        }
        if ($tplArr['nowColor2']) {
            echo '.post{color:#' . $tplArr['nowColor2'] . '}';
        }
        if ($tplArr['nowColor3']) {
            echo '#container a{color:#' . $tplArr['nowColor3'] . '} ';
        }
        if ($tplArr['nowColor4']) {
            echo 'body{background:url(' . $tplArr['nowColor4'] . ')} ';
        }
        if ($tplArr['mycss']) {
            echo $tplArr['mycss'];
        }
        echo '</style>';
    }

    ?>
<div id='container'>
    <div id='content' class='content'>
        <div id='right_column'>
            <?php TPL::plugin('include/taright', array('SPuid' => $SPuid));?>
        </div>
        <div id='left_column'>

            <?php TPL::plugin('include/showitem');?>
        </div>
        <div class="clear"></div>
    </div>
</div>
    <?php }?>
<div style="clear:both;height:6px;"></div>
<?php TPL::plugin('include/footer');?>
</body>
</html>