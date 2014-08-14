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
                <h1>申请入住身旁网校园部(大学生的乐园)</h1>
                <?php
                $msg = USER::get('msg');
                if ($msg) echo $msg;
                ?>
                <form name="form1" id="form1" method="post" action="index.php?m=setting.schooladd">
                    <h3 class="first">真实性名</h3>

                    <div class="text_field_container"><input type="text" value="<?php if ($thinfo) {
                        echo $thinfo[0]['realname'];
                    }?>" name="name" id="post_one" class="text_field big wide"></div>
                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;"> 学校(目前只开放部分学校)</h3>

                    <div style="height:30px;"></div>
                    <div class="text_field_container">
                        <select name='school' style='width: 200px;'>
                            <option value='华南理工大学'<?php if ($thinfo && $thinfo[0]['school'] == '华南理工大学') {
                                echo ' selected';
                            }?>  >华南理工大学
                            </option>
                            <option value='广东外语外贸大学'<?php if ($thinfo && $thinfo[0]['school'] == '广东外语外贸大学') {
                                echo ' selected';
                            }?>>广东外语外贸大学
                            </option>
                            <option value='华南师范大学'<?php if ($thinfo && $thinfo[0]['school'] == '华南师范大学') {
                                echo ' selected';
                            }?>>华南师范大学'
                            </option>
                            <option value='中山大学'<?php if ($thinfo && $thinfo[0]['school'] == '中山大学') {
                                echo ' selected';
                            }?>>中山大学
                            </option>
                            <option value='广东工业大学'<?php if ($thinfo && $thinfo[0]['school'] == '广东工业大学') {
                                echo ' selected';
                            }?>>广东工业大学
                            </option>
                            <option value='广州大学'<?php if ($thinfo && $thinfo[0]['school'] == '广州大学') {
                                echo ' selected';
                            }?>>广州大学
                            </option>
                            <option value='广东药学院 '<?php if ($thinfo && $thinfo[0]['school'] == '广东药学院') {
                                echo ' selected';
                            }?>>广东药学院
                            </option>
                            <option value='广州中医药大学'<?php if ($thinfo && $thinfo[0]['school'] == '广州中医药大学') {
                                echo ' selected';
                            }?>>广州中医药大学
                            </option>
                            <option value='广州美术学院 '<?php if ($thinfo && $thinfo[0]['school'] == '广州美术学院') {
                                echo ' selected';
                            }?>>广州美术学院
                            </option>
                            <option value='星海音乐学院'<?php if ($thinfo && $thinfo[0]['school'] == '星海音乐学院') {
                                echo ' selected';
                            }?>>星海音乐学院
                            </option>
                            <option value='华南农业大学'<?php if ($thinfo && $thinfo[0]['school'] == '华南农业大学') {
                                echo ' selected';
                            }?>>华南农业大学
                            </option>
                            <option value='中山大学南方学院'<?php if ($thinfo && $thinfo[0]['school'] == '中山大学南方学院') {
                                echo ' selected';
                            }?>>中山大学南方学院
                            </option>
                        </select>
                    </div>
                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;"> 学历</h3>

                    <div style="height:30px;"></div>
                    <div class="text_field_container">
                        <select name='xueli' style='width: 200px;'>
                            <option value='本科生'<?php if ($thinfo && $thinfo[0]['xueli'] == '本科生') {
                                echo ' selected';
                            }?>  >本科生
                            </option>
                            <option value='研究生'<?php if ($thinfo && $thinfo[0]['xueli'] == '研究生') {
                                echo ' selected';
                            }?>  >研究生
                            </option>
                            <option value='博士生'<?php if ($thinfo && $thinfo[0]['xueli'] == '博士生') {
                                echo ' selected';
                            }?>  >博士生'
                            </option>
                        </select>
                    </div>
                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;"> 年级</h3>

                    <div style="height:30px;"></div>
                    <div class="text_field_container">
                        <select name='grade' style='width: 200px;'>
                            <option value='2010'<?php if ($thinfo && $thinfo[0]['grade'] == '2010') {
                                echo ' selected';
                            }?>  >2010
                            </option>
                            <option value='2009'<?php if ($thinfo && $thinfo[0]['grade'] == '2009') {
                                echo ' selected';
                            }?>  >2009
                            </option>
                            <option value='2008'<?php if ($thinfo && $thinfo[0]['grade'] == '2008') {
                                echo ' selected';
                            }?>  >2008
                            </option>
                            <option value='2007'<?php if ($thinfo && $thinfo[0]['grade'] == '2007') {
                                echo ' selected';
                            }?>  >2007
                            </option>
                            <option value='2006'<?php if ($thinfo && $thinfo[0]['grade'] == '2006') {
                                echo ' selected';
                            }?>  >2006
                            </option>
                        </select>
                    </div>
                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;"> 性别</h3>

                    <div style="height:30px;"></div>
                    <div class="text_field_container">
                        <select name='sex' style='width: 200px;'>
                            <option value='男'<?php if ($thinfo && $thinfo[0]['sex'] == '男') {
                                echo ' selected';
                            }?>  >男
                            </option>
                            <option value='女'<?php if ($thinfo && $thinfo[0]['sex'] == '女') {
                                echo ' selected';
                            }?>  >女
                            </option>
                        </select>
                    </div>
                    <div style="height:30px;"></div>
                    <h3 class="first">专业(将填写正确的专业)</h3>

                    <div class="text_field_container"><input type="text" value="<?php if ($thinfo) {
                        echo $thinfo[0]['profession'];
                    }?>" name="profession" id="post_one" class="text_field big wide"></div>
                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;"> 我的简介(只有写了简介的,才有可能出现在推荐博客)</h3>
                    <textarea class="wide" style="height:200px;" id="post_two" name="descs"><?php  if ($thinfo) {
                        echo $thinfo[0]['desc_school'];
                    }?></textarea>

                    <div style="height:30px;"></div>
                    <h3 class="first">温馨提示(申请入住校园部,必须是有上传头像的,如果还没上传头像 <a href='index.php?m=setting.setpic'>请点击</a>)</h3>
                    <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                            id="save_button" class="positive" type="submit">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label"><?php if ($thinfo) { ?>修改<?php } else { ?>确定<?php }?></span>
                    </button>

                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <img id="content_bottom" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_bottom_edit_form.png?alpha">
</div>

<?php TPL::plugin('include/infooter2');?>
</body>
</html>