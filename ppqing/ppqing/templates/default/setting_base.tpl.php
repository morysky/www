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
            $thinfo = $db->query('select * from ' . $db->getTable(T_USERS) . '  where uid=' . $userinfo['uid']);
            ?>
        </div>
        <div id='left_column'>
            <div id='text_post'>
                <h1>个人资料</h1>
                <?php
                $msg = USER::get('msg');
                if ($msg) echo $msg;
                ?>
                <form name="form1" id="form1" method="post" action="index.php?m=setting.baseadd">
                    <h3 class="first">用户名</h3>

                    <div class="text_field_container"><input type="text" value="<?php echo  $thinfo[0]['name'];?>"
                                                             name="name" id="post_one" class="text_field big wide">
                    </div>
                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;"> 博客的类型</h3>

                    <div style="height:30px;"></div>
                    <div class="text_field_container">
                        <select name='fenlei' style='width: 200px;'>
                            <option value='0'>无</option>
                            <option value='影视'<?php if ($thinfo[0]['fenlei'] == '影视') {
                                echo ' selected';
                            }?>  >影视
                            </option>
                            <option value='艺术'<?php if ($thinfo[0]['fenlei'] == '艺术') {
                                echo ' selected';
                            }?>>艺术
                            </option>
                            <option value='时尚'<?php if ($thinfo[0]['fenlei'] == '时尚') {
                                echo ' selected';
                            }?>>时尚
                            </option>
                            <option value='音乐'<?php if ($thinfo[0]['fenlei'] == '音乐') {
                                echo ' selected';
                            }?>>音乐
                            </option>
                            <option value='摄影'<?php if ($thinfo[0]['fenlei'] == '摄影') {
                                echo ' selected';
                            }?>>摄影
                            </option>
                            <option value='宠物'<?php if ($thinfo[0]['fenlei'] == '宠物') {
                                echo ' selected';
                            }?>>宠物
                            </option>
                            <option value='美食'<?php if ($thinfo[0]['fenlei'] == '美食') {
                                echo ' selected';
                            }?>>美食
                            </option>
                            <option value='历史'<?php if ($thinfo[0]['fenlei'] == '历史') {
                                echo ' selected';
                            }?>>历史
                            </option>
                            <option value='动漫'<?php if ($thinfo[0]['fenlei'] == '动漫') {
                                echo ' selected';
                            }?>>动漫
                            </option>
                            <option value='旅行'<?php if ($thinfo[0]['fenlei'] == '旅行') {
                                echo ' selected';
                            }?>>旅行
                            </option>
                            <option value='恋物'<?php if ($thinfo[0]['fenlei'] == '恋物') {
                                echo ' selected';
                            }?>>恋物
                            </option>
                            <option value='怪趣'<?php if ($thinfo[0]['fenlei'] == '怪趣') {
                                echo ' selected';
                            }?>>怪趣
                            </option>
                            <option value='体育'<?php if ($thinfo[0]['fenlei'] == '体育') {
                                echo ' selected';
                            }?>>体育
                            </option>
                            <option value='汽车'<?php if ($thinfo[0]['fenlei'] == '汽车') {
                                echo ' selected';
                            }?>>汽车
                            </option>
                            <option value='建筑'<?php if ($thinfo[0]['fenlei'] == '建筑') {
                                echo ' selected';
                            }?>>建筑
                            </option>
                            <option value='科学'<?php if ($thinfo[0]['fenlei'] == '科学') {
                                echo ' selected';
                            }?>>科学
                            </option>
                            <option value='阅读'<?php if ($thinfo[0]['fenlei'] == '阅读') {
                                echo ' selected';
                            }?>>阅读
                            </option>
                            <option value='生活'<?php if ($thinfo[0]['fenlei'] == '生活') {
                                echo ' selected';
                            }?>>生活
                            </option>
                            <option value='数码'<?php if ($thinfo[0]['fenlei'] == '数码') {
                                echo ' selected';
                            }?>>数码
                            </option>
                            <option value='网络'<?php if ($thinfo[0]['fenlei'] == '网络') {
                                echo ' selected';
                            }?>>网络
                            </option>
                            <option value='编程'<?php if ($thinfo[0]['fenlei'] == '编程') {
                                echo ' selected';
                            }?>>编程
                            </option>
                            <option value='企业'<?php if ($thinfo[0]['fenlei'] == '企业') {
                                echo ' selected';
                            }?>>企业
                            </option>
                            <option value='招聘'<?php if ($thinfo[0]['fenlei'] == '招聘') {
                                echo ' selected';
                            }?>>招聘
                            </option>
                        </select>
                    </div>
                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;"> 我的简介(只有写了简介的,才有可能出现在推荐博客)</h3>
                    <textarea class="wide" style="height:200px;" id="post_two"
                              name="descs"><?php echo  $thinfo[0]['descs'];?></textarea>

                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;">
                        我的签名(签名只有在文章数大于10时，才会出现.支持bbcode,链接可用，如[url]http://www.shenpang.cc[/url])</h3>
                    <textarea class="wide" style="height:200px;" id="post_two"
                              name="sign"><?php echo  $thinfo[0]['sign'];?></textarea>

                    <div style="height:30px;"></div>
                    <div class='tip' style='background:#919191;width:580px;padding:8px'>
                        <b style='font-size:1被留言时提示：4px'>邮件提示:</b> <span class='label-for-checkbox'> <input name="fol"
                                                                                                            type="checkbox"
                                                                                                            id="aa"
                                                                                                            value="1"  <?php if ($thinfo[0]['foltip']) { ?>checked <?php }?>/>被关注时提示   </span><span
                            class='label-for-checkbox'><input name="com" type="checkbox" id="aa"
                                                              value="1"  <?php if ($thinfo[0]['comtip']) { ?>checked <?php }?>/>  被评论时提示    </span><span
                            class='label-for-checkbox'><input name="msg" type="checkbox" id="aa"
                                                              value="1"  <?php if ($thinfo[0]['msgtip']) { ?>checked <?php }?>/>被留言时提示</span>
                    </div>
                    <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                            id="save_button" class="positive" type="submit">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label">修改</span>
                    </button>
                    <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                            id="save_button" class="positive" type="reset">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label">重置</span>
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