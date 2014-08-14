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
$gid = $SPgid;
$db = APP :: ADP('db');
$theinfo = $db->query('select * from ' . $db->getTable(T_GROUP_CONFIG) . ' where gid=' . $gid);
$SPconfig = unserialize(SPCONFIG);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $theinfo[0]['gname'];?>-轻博群－<?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL;?>css/base.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL;?>css/color.css" rel="stylesheet" type="text/css"/>

</head>
<body>
<div id='facetmp'>
<?php 


$facerows = $db->query('select * from ' . $db->getTable(T_GROUP_CONFIG) . ' where gid=' . $gid);
if ($facerows) {
    ?>
    <link href="<?php echo BASE_URL;?>css/group_<?php echo $facerows[0]['face'];?>/skin.css" rel="stylesheet"
          type="text/css"/>


</div>
<link href="<?php echo BASE_URL;?>css/group.css" rel="stylesheet" type="text/css"/>
    <?php TPL::plugin('include/groupheader', array('SPgid' => $gid)); ?>
    <?php TPL::plugin('gthemes/' . $facerows[0]['face'] . '/skin', array('SPgid' => $gid)); ?>
    <?php
} else {
    ?>
<link href="<?php echo BASE_URL;?>css/group_default_skin/skin.css" rel="stylesheet" type="text/css"/>


</div>
<link href="<?php echo BASE_URL;?>css/group.css" rel="stylesheet" type="text/css"/>
    <?php TPL::plugin('include/groupheader', array('SPgid' => $gid)); ?>
    <?php TPL::plugin('gthemes/default/skin', array('SPgid' => $gid)); ?>
    <?php }?>
<div class='cbot'>
    <div style="clear:both;height:6px;"></div>
    <?php TPL::plugin('include/footer');?>
</div>
</body>
</html>