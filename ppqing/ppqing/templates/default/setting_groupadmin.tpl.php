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
            <?php TPL::plugin('include/setright');?>
            <?php
            $userinfo = USER::get('userinfo');
            $db = APP :: ADP('db');
            $thinfo = $db->query('select * from ' . $db->getTable(T_SCHOOL) . '  where uid=' . $userinfo['uid']);
            ?>
        </div>
        <div id='left_column'>
            <div id='text_post'>
                <h1>轻博群管理</h1>

                <h2><a href='index.php?m=setting.setgroup'>增加+</a>　新轻博群(最多只能加３个)</h2>

                <div style="height:30px;"></div>
                <table border="1" cellspacing="0" cellpadding="0">
                    <tr>
                        <td style='width:40px;background:#d1d1d1;'>编号</td>
                        <td style='width:500px;background:#d1d1d1;'>轻博群</td>
                        <td style='width:40px;background:#d1d1d1;'>操作</td>
                    </tr>
                    <?php
                    $groupresults = $db->query('select * from ' . $db->getTable(T_GROUP_CONFIG) . '  where uid=' . $userinfo['uid']);
                    foreach ($groupresults as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo $key + 1;?>:</td>
                            <td style='width:500px;'><a
                                    href=index.php?m=group&gid=<?php echo $value['gid'];?> ><?php echo $value['gname']?></a>
                            </td>
                            <td style='width:40px'><a href=index.php?m=setting.setgroup&gid=<?php echo
                            $value['gid'];  ?>>管理</a></td>
                        </tr>
                        <?php }?>
                </table>
                <style>
                    table tr {
                        height: 40px;
                    }

                    table td {
                        height: 40px;
                        border: solid 3px #d1d1d1;
                    }
                </style>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <img id="content_bottom" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_bottom_edit_form.png?alpha">
</div>
<?php TPL::plugin('include/infooter2');?>

</body>
</html>