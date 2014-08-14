<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 text.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$did = $_GET['did'];
if ($did) {
    $db = APP :: ADP('db');
    $thinfo = $db->query('select * from ' . $db->getTable(T_CONTENT) . '  where did=' . $did . ' and (uid=' . $userinfo['uid'] . ' or 1=' . $userinfo['uid'] . ' or 90=' . $userinfo['uid'] . ')');
}
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


        <form name="form1" id="form1" method="post" action="index.php?m=post.textadd">
            <div id='right_column'>
                <?php TPL::plugin('include/editright', array('thinfo' => $thinfo));?>
            </div>
            <div id='left_column'>
                <div id='text_post'>
                    <h1>发表文本</h1>
                    <?php
                    $msg = USER::get('msg');
                    if ($msg) echo $msg;
                    ?>
                    <h3 class="first">标题(可以不加) </h3>

                    <div class="text_field_container"><input type="text"
                                                             value="<?php if ($thinfo) echo $thinfo[0]['title']; ?>"
                                                             name="title" id="post_one" class="text_field big wide">
                    </div>
                    <div style="height:30px;"></div>
                    <h3 style="float:left; margin-top:0px;">内容</h3>

                    <div style="height:30px;"></div>
                    <div id="gently_editor"></div>
                    <script type="text/javascript" charset="utf-8">
                        var editor = new baidu.editor.ui.Editor({
                            id: 'gently_editor',
                            textarea: 'gently_editor',
                            UEDITOR_HOME_URL:'<?php echo BASE_URL;?>ppeditor/',
                            iframeCssUrl :'<?php echo BASE_URL;?>ppeditor/themes/default/iframe.css' ,
                            minFrameHeight:200,
                            toolbars: [
                                ['FontFamily','FontSize'],
                                ['Bold','Italic','Underline','ForeColor','BackColor'],
                                ['JustifyLeft','JustifyCenter','JustifyRight'],
                                ['InsertOrderedList','InsertUnorderedList'],
                                ['Emoticon','PlaceName','Link','Unlink','|','Undo','Redo'],
                                ['FullScreen']
                            ],
                            // 重写ui.Editor的renderToolbarBoxHtml方法
                            renderToolbarBoxHtml: function () {
                                return '<div class="%%-toolbarinner-left"><table>' +
                                        '<tr><td><div class="%%-toolbarinner-lefttop">' + this.toolbars[0].renderHtml() + '</div></td><td rowspan="2"><span class="%%-toolbarinner-separate"></span></td></tr>' +
                                        '<tr><td><div class="%%-toolbarinner-leftbottom">' + this.toolbars[1].renderHtml() + '</div></td></tr>' +

                                        '</table></div>' +
                                        '<div class="%%-toolbarinner-center"><table>' +
                                        '<tr><td><div class="%%-toolbarinner-centertop">' + this.toolbars[2].renderHtml() + '</div></td><td rowspan="2"><span class="%%-toolbarinner-separate"></span></td></tr>' +

                                        '<tr><td><div class="%%-toolbarinner-centerbottom">' + this.toolbars[3].renderHtml() + '</div></td></tr>' +

                                        '</table></div>' +
                                        '<div class="%%-toolbarinner-right">' + this.toolbars[4].renderHtml() + '</div>' +
                                        '<div class="%%-toolbarinner-fullscreen">' + this.toolbars[5].renderHtml() + '</div>' +
                                        '<div style="clear: both;overflow: hidden;height: 0;"></div>';
                            }
                        });
                        editor.render();
                    </script>


                    <div style="width:600px; float:left; padding: 5px 0 5px 30px;" id="left_column">
                        <input type='hidden' name='did' value='<?php if ($did) echo $did?>'></input>
                        <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                                id="save_button" class="positive" type="submit">
                            <img alt="" src="http://assets.tumblr.com/images/check.png">
                            <span id="create_post_button_label">发布</span>
                        </button>
                        <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                                id="save_button" class="positive" type="reset">
                            <img alt="" src="http://assets.tumblr.com/images/check.png">
                            <span id="create_post_button_label">重置</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="clear"></div>
    </div>
    <img id="content_bottom" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_bottom_edit_form.png?alpha">
</div>
<!-- 底部开始 -->
<?php TPL::plugin('include/infooter2');?>

</body>
</html>