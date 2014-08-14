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
            $gid = V('g:gid');
            $db = APP :: ADP('db');
            $thinfo = $db->query('select * from ' . $db->getTable(T_GROUP_CONFIG) . '  where gid=' . $gid . ' and uid=' . $userinfo['uid']);
            ?>
        </div>
        <div id='left_column'>
            <div id='text_post'>

                <?php
                $msg = USER::get('msg');
                if ($msg) echo $msg;
                $gnum = $db->query('select count(*) as count from ' . $db->getTable(T_GROUP_CONFIG) . '  where  uid=' . $userinfo['uid']);
                if ($gnum[0]['count'] < 3 || $gid > 0) {
                    ?>
                    <h1><?php echo $thinfo[0]['gname']?></h1>
                    <form name="form1" id="form1" method="post" action="index.php?m=setting.groupadd"
                          enctype="multipart/form-data">
                        <h3 class="first">轻博群名称</h3>

                        <div class="text_field_container"><input type="text" value="<?php if ($thinfo) {
                            echo $thinfo[0]['gname'];
                        }?>" name="name" id="post_one" class="text_field big wide"></div>


                        <div style="height:30px;"></div>
                        <h3 style="float:left; margin-top:0px;"> 是否开放</h3>

                        <div style="height:30px;"></div>
                        <div class="text_field_container">
                            <select name='open' style='width: 200px;'>
                                <option value='1'<?php if ($thinfo && $thinfo[0]['open'] == '1') {
                                    echo ' selected';
                                }?>  >开放
                                </option>
                                <option value='0'<?php if ($thinfo && $thinfo[0]['open'] == '0') {
                                    echo ' selected';
                                }?>  >关闭
                                </option>
                            </select>
                        </div>
                        <div style="height:30px;"></div>
                        <h3 style="float:left; margin-top:0px;"> 风格</h3>

                        <div style="height:30px;"></div>
                        <div class="text_field_container">
                            <select name='face' style='width: 200px;'>
                                <option value='default'<?php if ($thinfo && $thinfo[0]['face'] == 'default') {
                                    echo ' selected';
                                }?>  >默认
                                </option>
                            </select>
                        </div>
                        <div style="height:30px;"></div>
                        <h3 style="float:left; margin-top:0px;"> 学校(目前只开放部分学校)</h3>

                        <div style="height:30px;"></div>
                        <div class="text_field_container">
                            <select name='types' style='width: 200px;'>
                                <option value='其他'<?php if ($thinfo && $thinfo[0]['types'] == '其他') {
                                    echo ' selected';
                                }?>>其他
                                </option>
                                <option value='华南理工大学'<?php if ($thinfo && $thinfo[0]['types'] == '华南理工大学') {
                                    echo ' selected';
                                }?>  >华南理工大学
                                </option>
                                <option value='广东外语外贸大学'<?php if ($thinfo && $thinfo[0]['types'] == '广东外语外贸大学') {
                                    echo ' selected';
                                }?>>广东外语外贸大学
                                </option>
                                <option value='华南师范大学'<?php if ($thinfo && $thinfo[0]['types'] == '华南师范大学') {
                                    echo ' selected';
                                }?>>华南师范大学'
                                </option>
                                <option value='中山大学'<?php if ($thinfo && $thinfo[0]['types'] == '中山大学') {
                                    echo ' selected';
                                }?>>中山大学
                                </option>
                                <option value='广东工业大学'<?php if ($thinfo && $thinfo[0]['types'] == '广东工业大学') {
                                    echo ' selected';
                                }?>>广东工业大学
                                </option>
                                <option value='广州大学'<?php if ($thinfo && $thinfo[0]['types'] == '广州大学') {
                                    echo ' selected';
                                }?>>广州大学
                                </option>
                                <option value='广东药学院'<?php if ($thinfo && $thinfo[0]['types'] == '广东药学院') {
                                    echo ' selected';
                                }?>>广东药学院
                                </option>
                                <option value='广州中医药大学'<?php if ($thinfo && $thinfo[0]['types'] == '广州中医药大学') {
                                    echo ' selected';
                                }?>>广州中医药大学
                                </option>
                                <option value='广州美术学院'<?php if ($thinfo && $thinfo[0]['types'] == '广州美术学院') {
                                    echo ' selected';
                                }?>>广州美术学院
                                </option>
                                <option value='星海音乐学院'<?php if ($thinfo && $thinfo[0]['types'] == '星海音乐学院') {
                                    echo ' selected';
                                }?>>星海音乐学院
                                </option>
                                <option value='华南农业大学'<?php if ($thinfo && $thinfo[0]['types'] == '华南农业大学') {
                                    echo ' selected';
                                }?>>华南农业大学
                                </option>

                            </select>
                        </div>
                        <div style="height:30px;"></div>
                        <h3 class="first">图片</h3>

                        <div class="text_field_container"><input style='height:24px' name="gidimg" type="file"/></div>
                        <?php if ($gid && file_exists('var/upload/group/' . $gid . '.jpg')) { ?><img
                            src='<?php echo BASE_URL;?>var/upload/group/<?php echo $gid?>.jpg'></img><?php }?>
                        <div style="height:30px;"></div>
                        <h3 style="float:left; margin-top:0px;"> 轻博群简介</h3>
                        <textarea class="wide" style="height:200px;" id="post_two" name="descs"><?php  if ($thinfo) {
                            echo $thinfo[0]['descs'];
                        }?></textarea>

                        <div style="height:30px;"></div>
                        <input type='hidden' name='gid' value=<?php echo $gid;?>></input>

                        <h3 class="first">欢迎使用轻博群(一个轻博只能开三个群)</h3>
                        <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                                id="save_button" class="positive" type="submit">
                            <img alt="" src="http://assets.tumblr.com/images/check.png">
                            <span id="create_post_button_label"><?php if ($thinfo) { ?>修改<?php } else { ?>
                                确定<?php }?></span>
                        </button>

                    </form>
                    <?php } else { ?>
                    <h1>你已经创建了三个轻博群</h1>

                    <?php }?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <img id="content_bottom" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_bottom_edit_form.png?alpha">
</div>
<?php TPL::plugin('include/infooter2');?>

</body>
</html>