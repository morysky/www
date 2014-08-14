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
    <?php TPL::plugin('include/tophead');?>

</head>
<body>
<?php TPL::plugin('include/header');?>
<div id='container'>
    <div id='contentre' class='content'>
        <div class='contenttop'></div>
        <?php
        $userinfo = USER::get('userinfo');
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
        $fresults = $db->query('select * from ' . $db->getTable(T_USERS) . ' where descs !=\'\' ' . $fenleiadd . '   order by tui desc limit 20 ');

        ?>
        <h2 class="recommend-hd">推荐你最喜欢的轻博群给大家！</h2>

        <div class="recommend-bd">
            <div class="recommend-top"></div>
            <div class="recommend-content">
                <form method="post" action="index.php?m=post.recomqunadd" id="J_RecommendForm">
                    <p class="recommend-dlog-url-holder">
                        <label for="recommend-dlog-url">输入要推荐轻博群的gid<span> (如http://localhost/paipang/index.php?m=group&gid=4 则gid为4）</span></label>
                    </p>

                    <p><input type="text" value="" id="recommend-dlog-url" name="tuid"></p>

                    <div style="height:30px;"></div>
                    <div class="recommend-cat">

                    </div>
                    <div class="recommend-error" id="J_RecommendError"></div>
                    <p class="recommend-submit-holder"><input type="submit" value="" name="submit"></p>
                </form>
            </div>
            <div class="recommend-bottom"></div>
        </div>


        <div class="clear"></div>
    </div>
</div>


</body>
</html>