<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 input.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
?>
<div class='toplogout'><a href='index.php?m=account.logout'>退出</a></div>
<style>
    .toplogout {
        text-align: right;
        padding-right: 80px;

    }

    .toplogout a {
        color: #ffffff;
    }
</style>
<div class="talkBox">
    <form oncomplete="false" id="miniblog_publish" action="index.php?m=index.add" method="post">
        <input type="hidden" value="0" name="publish_type">

        <div class="cntBox">
            <textarea style="width:99.3%;_width:99%; height:78px;padding:5px 0;" rows="" cols="" id="content_publish"
                      name="content"></textarea>

            <div style="z-index:-1000" class="txtShadow"></div>
        </div>
        <div class="funBox">
            <div class="left" id="publish_type_content_before"><span>添加：</span><a class="a52"
                                                                                  onclick="ui.emotions(this)"
                                                                                  target_set="content_publish"
                                                                                  href="javascript:void(0)"><img
                    src="<?php echo BASE_URL;?>css/bgimg/zw_img.gif" class="icon_add_face_d">表情</a> <a class="a52"
                                                                                                       onclick="addtheme()"
                                                                                                       href="javascript:void(0)"><img
                    src="<?php echo BASE_URL;?>css/bgimg/zw_img.gif" class="icon_add_topic_d">话题</a> <a class="a52"
                                                                                                        onclick="weibo.plugin.image.click(169)"
                                                                                                        href="javascript:void(0)"><img
                    src="<?php echo BASE_URL;?>css/bgimg/zw_img.gif" class="icon_add_img_d">图片</a> <a class="a52"
                                                                                                      onclick="weibo.plugin.video.click(221)"
                                                                                                      href="javascript:void(0)"><img
                    src="<?php echo BASE_URL;?>css/bgimg/zw_img.gif" class="icon_add_video_d">视频</a> <a class="a52"
                                                                                                        onclick="weibo.plugin.music.click(271)"
                                                                                                        href="javascript:void(0)"><img
                    src="<?php echo BASE_URL;?>css/bgimg/zw_img.gif" class="icon_add_music_d">音乐</a></div>
        </div>
        <input type="hidden" value="17f8064a8af379825722d0a4fb25f5f5" name="__hash__">

        <div style="margin:0 auto;padding-left:240px;margin-top:8px;">
            <input type='submit' class='sumbitbutton' value=''></input>
        </div>
    </form>
</div>

<style>
    .talkBox {
        margin: 0 auto;
        border: 4px solid #313131;
        padding: 4px;
        background: #ffffff;
        margin-top: 18px;
        font-size: 12px;
    }

    .talkBox img {
        border: 0px;
    }
</style>