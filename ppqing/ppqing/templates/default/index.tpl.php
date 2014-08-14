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
    <?php TPL::plugin('include/tophead');?>

</head>
<body>

<?php
$userinfo = USER::get('userinfo');
$db = APP :: ADP('db');
$rowor = $db->query('select * from ' . $db->getTable(T_CONTENT) . ' where uid=' . $userinfo['uid']);
if (!$rowor) {
    ?>
<link href="<?php echo BASE_URL;?>css/subModal.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/subModal.js"></script>
<script>
    initPopUp(1);
    showPopWin('index.php?m=post.fristarticle', 700, 430, null);

</script>
    <?php }?>
<?php TPL::plugin('include/header');?>
<div class="content">
    <!-- 内容开始 -->
    <div class="container clearfix">
        <div class="c_R">
            <?php TPL::plugin('include/right');?>
        </div>
        <div class="c_L">
            <?php TPL::plugin('include/items');?>
        </div>
    </div>
    <!-- 底部开始 -->
    <?php TPL::plugin('include/infooter');?>


</body>
</html>