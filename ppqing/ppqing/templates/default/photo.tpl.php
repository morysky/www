<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 photo.tpl.php
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
    <style>
        #fileQueue {
            width: auto;
            height: auto;
            overflow: auto;
            margin: 5px;
            float: left;
        }

        .btn-group {
            width: 280px;
            float: left;
        }

        .btn {
            text-decoration: none;
            width: 110px;
            height: 30px;
            display: block;
            background: #515151;
            margin: 10px 0;
            text-align: center;
            font: 14px/2em '微软雅黑';
            color: #fff;
        }

        .btn:hover {
            background: #333;
            font-weight: bold;
        }

        .info {
            border: 2px solid #999;
            width: 400px;
            min-height: 30px;
            float: left;
        }

        .uploadifyQueueItem {
            font: 11px Verdana, Geneva, sans-serif;
            border: 2px solid #E5E5E5;
            background-color: #F5F5F5;
            margin-top: 5px;
            padding: 10px;
            width: 350px;
        }

        .uploadifyError {
            border: 2px solid #FBCBBC !important;
            background-color: #FDE5DD !important;
        }

        .uploadifyQueueItem .cancel {
            float: right;
        }

        .uploadifyProgress {
            background-color: #FFFFFF;
            border-top: 1px solid #808080;
            border-left: 1px solid #808080;
            border-right: 1px solid #C5C5C5;
            border-bottom: 1px solid #C5C5C5;
            margin-top: 10px;
            width: 100%;
        }

        .uploadifyProgressBar {
            background-color: #0099FF;
            width: 1px;
            height: 3px;
        }
    </style>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/swfobject.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.uploadify.v2.1.0.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.dragsort-0.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#uploadify").uploadify({
                'uploader'       : 'js/uploadify.swf',
                'script'         : 'uploadify.php',
                'cancelImg'      : 'css/cancel.png',
                'folder'         : 'uploads',
                'queueID'        : 'fileQueue',
                'auto'           : true,
                'multi'          : true,
                'onComplete':function(event, queueId, fileObj, response, data) {
                    $('#list1').append('<li id=' + queueId + '><div><img src="' + response + '" alt="" width="160" height="160"><br><a href="javascript:delpicitem(\'' + queueId + '\')">删除</a><br/><input name="pimg' + queueId + 'pimg" value="' + response + '" style="display:none"></input> <input name="pinput' + queueId + 'pinput"></input></div></li>');
                }
            });
        });
    </script>
</head>
<body>
<?php TPL::plugin('include/header');?>
<div id='container'>

    <img id="content_top" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_top_edit_form.png?alpha">

    <div id='content' class='content'>


        <form id="uploadForm" method="post" action="index.php?m=post.photoadd">
            <div id='right_column'>
                <?php TPL::plugin('include/editright');?>
            </div>
            <div id='left_column'>
                <div id='text_post'>
                    <h1>发表图片</h1>
                    <style>
                        #conpic {
                            margin-bottom: 8px;
                            padding: 6px;
                            clear: both;
                            height: auto;
                            border: 1px solid #DFDFDF;
                            background: #fbfbfb;
                        }

                        #conpic ul {
                            margin: 0px;
                            padding: 0px;
                            margin-left: 20px;
                        }

                        #list1, #list2 {
                            width: 590px;
                            list-style-type: none;
                            margin: 0px;
                        }

                        #list1 li, #list2 li {
                            float: left;
                            padding: 5px;
                            width: 180px;
                            height: 220px;
                        }

                        #list1 div, #list2 div {
                            width: 170px;
                            height: 210px;
                            border: 1px solid #CCCCCC;
                            background-color: #fafafa;
                            text-align: center;
                            padding-top: 4px;
                        }

                        #list2 {
                            float: right;
                        }

                        #list1 input {
                            border: 1px solid #ffffff;
                        }

                        #list1 li a {
                            color: #555555;
                        }

                        .placeHolder div {
                            background-color: white !important;
                            border: dashed 1px gray !important;
                        }

                    </style>
                    <div id="conpic">


                        <div class="btn-group">
                            <span style='font-size:28px'>上传:</span><input type="file" name="uploadify" id="uploadify"/>
                        </div>
                        <br></br>
                        <ul id="list1"></ul>

                        <!-- save sort order here which can be retrieved on server on postback -->
                        <input name="list1SortOrder" type="hidden"/>

                        <script type="text/javascript">
                            $("#list1, #list2").dragsort({ dragSelector: "div", dragBetween: true, dragEnd: saveOrder, placeHolderTemplate: "<li class='placeHolder'><div></div></li>" });

                            function saveOrder() {
                                var data = $("#list1 li").map(
                                        function() {
                                            return $(this).children().html();
                                        }).get();
                                $("input[name=list1SortOrder]").val(data.join("|"));
                            }
                            ;

                            function delpicitem(id) {
                                //alert($("li#"+id+" div input").val());
                                $("li#" + id).remove();
                            }
                        </script>
                        <br></br>

                        <div class="clear"></div>
                        <div id="fileQueue" style="clear:both;"></div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
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

                    <button style="margin:10px;width:100px;" id="save_button" class="positive" type="submit">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label">发布</span>
                    </button>
                    <button style="margin:10px;width:100px;" id="save_button" class="positive" type="reset">
                        <img alt="" src="http://assets.tumblr.com/images/check.png">
                        <span id="create_post_button_label">重置</span>
                    </button>
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