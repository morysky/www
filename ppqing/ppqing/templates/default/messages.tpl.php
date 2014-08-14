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
    <link href="<?php echo BASE_URL;?>css/show.css" rel="stylesheet" type="text/css"/>
    <?php TPL::plugin('include/tophead');?>

</head>
<body>
<?php TPL::plugin('include/header');?>
<div id='container'>
    <div id='content' class='content'>
        <div id='right_column'>
            <?php TPL::plugin('include/right');?>
        </div>
        <div id='left_column'>
            <?php
            $userinfo = USER::get('userinfo');
            $cid = V('g:id');
            if ($cid) $userinfo['uid'] = $cid;
            $page = V('g:page');
            if (!$page) $page = 1;
            $sum = 20;
            $total = ($page - 1) * $sum;
            $db = APP :: ADP('db');

            $rows = $db->query('select count(uid) as count   from ' . $db->getTable(T_MESSAGE) . ' where  (uid=' . $userinfo['uid'] . ' or  touid=' . $userinfo['uid'] . ' ) order by  mid desc');
            $allcount = $rows[0]['count'];
            $fresults = $db->query('select *,x.uid as uid,y.name as yname from ' . $db->getTable(T_MESSAGE) . ' x left join ' . $db->getTable(T_USERS) . ' y on x.touid=y.uid where  (x.uid=' . $userinfo['uid'] . ' or  x.touid=' . $userinfo['uid'] . ' ) order by  x.mid desc limit ' . $total . ',' . $sum);
            $fresults = APP::F('content_filter', $fresults);
            ?>
            <style type="text/css">
                <!--
                body {
                    behavior: url(images/iehoverfix.htc);
                }

                .user_photo {
                    width: 75px;
                }

                .user_photo .photo_img {
                    display: block;
                    width: 62px;
                    height: 62px;
                    border-radius: 6px;
                    -moz-border-radius: 6px;
                    -khtml-border-radius: 6px;
                    -webkit-border-radius: 6px;
                }

                -->
            </style>
            <div class="wrapper clearfix">
                <div class="user_photo"><a class="photo_img"
                                           style="background:url('<?php if (file_exists('avatar/i_upload/' . $userinfo['uid'] . '_small_2.jpg')) {
                                               echo   BASE_URL . 'avatar/i_upload/' . $userinfo['uid'] . '_small_2.jpg?id=' . rand(1110, 9900);
                                           } else if (file_exists('avatar/i_upload/' . $userinfo['uid'] . '_small.jpg')) {
                                               echo   BASE_URL . 'avatar/i_upload/' . $userinfo['uid'] . '_small.jpg';
                                           } else {
                                               echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                           }?>') no-repeat" href="index.php?m=ta&uid=<?php echo $userinfo['uid'];?>"
                                           title="<?php echo $userinfo['name'];?>"></a></div>
                <div class="c_box">
                    <div class="c_b_t"></div>
                    <div class="c_b_c clearfix">
                        <!-- 子导航 -->
                        <div class="sub_nav">
                            <li><a href="<?php if (PPREWRITE == 1) {
                                echo BASE_URL; ?>m.post.text<?php } else { ?>index.php?m=post.text<?php }?>" title="文本"><img
                                    src="<?php echo BASE_URL;?>css/newimage/images/icon_01.png" alt="文本"/></a></li>
                            <li><a href="<?php if (PPREWRITE == 1) {
                                echo BASE_URL; ?>m.post.photo<?php } else { ?>index.php?m=post.photo<?php }?>"
                                   title="图片"><img src="<?php echo BASE_URL;?>css/newimage/images/icon_03.png"
                                                   alt="图片"/></a></li>
                            <li><a href="<?php if (PPREWRITE == 1) {
                                echo BASE_URL; ?>m.post.quote<?php } else { ?>index.php?m=post.quote<?php }?>"
                                   title="引用"><img src="<?php echo BASE_URL;?>css/newimage/images/icon_05.png"
                                                   alt="引用"/></a></li>
                            <li><a href="<?php if (PPREWRITE == 1) {
                                echo BASE_URL; ?>m.post.link<?php } else { ?>index.php?m=post.link<?php }?>" title="链接"><img
                                    src="<?php echo BASE_URL;?>css/newimage/images/icon_07.png" alt="链接"/></a></li>
                            <li><a href="<?php if (PPREWRITE == 1) {
                                echo BASE_URL; ?>m.post.chat<?php } else { ?>index.php?m=post.chat<?php }?>" title="对话"><img
                                    src="<?php echo BASE_URL;?>css/newimage/images/icon_09.png" alt="对话"/></a></li>
                            <li><a href="<?php if (PPREWRITE == 1) {
                                echo BASE_URL; ?>m.post.audio<?php } else { ?>index.php?m=post.audio<?php }?>"
                                   title="音乐"><img src="<?php echo BASE_URL;?>css/newimage/images/icon_11.png"
                                                   alt="音乐"/></a></li>
                            <li><a href="<?php if (PPREWRITE == 1) {
                                echo BASE_URL; ?>m.post.video<?php } else { ?>index.php?m=post.video<?php }?>"
                                   title="视频"><img src="<?php echo BASE_URL;?>css/newimage/images/icon_13.png"
                                                   alt="视频"/></a></li>
                        </div>
                    </div>
                    <div class="c_b_b"></div>
                    <div class="c_b_arrow"></div>
                </div>
            </div>
            <?php
            if ($allcount > 0) {
                ?>
                <div class='clist'>
                    <div class='tagtitle'>
                        <span style='font-size:18px;font-weight:bold;'>留言（<?php echo $allcount;?>）条</span>
                    </div>

                    <?php   foreach ($fresults as $gkey => $fvalue) { ?>
                    <div class="wrapper postwrap clearfix" id='postother'>
                        <div class="user_photo"></div>

                        <div class="c_box">
                            <div class="c_b_t"></div>
                            <div class="c_b_c clearfix">
                                <img style='margin-left:8px;padding:2px;border:1px solid #616161'
                                     src='<?php if (file_exists('avatar/i_upload/' . $fvalue['uid'] . '_small.jpg')) {
                                         echo BASE_URL . '/avatar/i_upload/' . $fvalue['uid'] . '_small.jpg';
                                     } else {
                                         echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                     }?>' width='24px'></img>
                                <?php echo '<a  style=color:#AB810F href=' . BASE_URL . 'index.php?m=ta&uid=' . $fvalue['uid'] . '>' . $fvalue['uname'] . '</a><a href=' . BASE_URL . 'index.php?m=post.delmsg&id=' . $fvalue['mid'] . '></a>';?> <?php if ($fvalue['yname']) {
                                echo "(回复：<a target=_blank href=index.php?m=ta&uid=" . $fvalue['touid'] . ">" . $fvalue['yname'] . "</a>)";
                            }?>
                                <img class="modalInput"
                                     id="<?php echo $fvalue['uid'];?>:::<?php echo $fvalue['uname'];?>:::<?php echo $gkey;?>"
                                     rel="#prompt" style='border:0px' src='css/bgimg/replay.gif'
                                     style="cursor:hand"></img>
                            <p>
                                <?php if ($fvalue['msg']) { ?>
                                <div style='background:#fafafa;margin:8px;padding:4px;'>
                                    <?php echo $fvalue['msg'];?>
                                    --(<?php echo APP::F('format_time', $fvalue['mdate']); ?>)
                                </div>
                                <?php }?>
                            </div>

                            <div class="c_b_b"></div>


                        </div>
                    </div>
                    <?php }?>

                </div>
                <?php }?>
            <?php $theurl = "index.php?m=index.messages";
            ?>

            <div class="pages">
                <?php
                $addtype = '';

                $theurl .= '&page';
                $pages = APP::N('pages', 20, $allcount, $page, $theurl); // 创建对象
                $pages->setShowPageNum(5);     // 设置显示的页数
                $pages->setCurrentIndexPage(3);   // 设置当前页在分页栏中的位置
                $pages->setFirstPageText('<<');   // 设置链接第一页显示的文字
                $pages->setLastPageText('>>');    //  设置链接最后一页显示的文字
                $pages->setPrePageText('<');   //   设置链接上一页显示的文字
                $pages->setNextPageText('>');  //    设置链接下一页显示的文字
                $pages->setPageCss('pagea');        //设置各分页码css样式的class名称
                $pages->setCurrentPageCss('current');   // 设置当前页码css样式的class名称
//$pages->setPageStyle('pagea');      设置各分页码的样式，即style属性
//$pages->setCurrentPageStyle($style);  设置当前页码的样式，即style属性
                $pages->setLinkSymbol('=');       // 设置地址链接中页码与变量的连接符，如page=2中的“=”
                $pages->isShowFirstAndLast(true); //   设置是否显示第一页与最后一页的链接
                echo  $pages->generatePages();

                ?>
            </div>

        </div>
        <div class="clear"></div>
    </div>
</div>


<!-- user input dialog -->
<div class="modal" id="prompt" style="top: 95.9px; left: 768px; position: fixed; display: none; z-index: 0; ">
    <h2>私信窗口</h2>

    <p>

    </p>

    <!-- input form. you can press enter too -->
    <form>
        <textarea name="content" id='tcont' rows="6" cols="65" style="overflow:hidden"></textarea>

        <div style="padding-top:15px;">
            <button type="submit" class='btnsp'> 发送</button>
            <button type="button" class="close btnsp"> 取消</button>
        </div>
    </form>
    <br>

</div>


<script>

    // What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
    $(document).ready(function() {
        var gid = 0;
        var guser = 0;
        var gkey = 0;
        var triggers = $(".modalInput").overlay({
            // some mask tweaks suitable for modal dialogs
            mask: {
                color: '#888888',
                loadSpeed: 200,
                opacity: 0.4
            },

            closeOnClick: false
        });
        $(".modalInput").click(function(e) {
            gid = $(this).attr('id').split(":::")[0];
            guser = $(this).attr('id').split(":::")[1];
            gkey = $(this).attr('id').split(":::")[2];
        });

        var buttons = $("#yesno button").click(function(e) {

            // get user input
            var yes = buttons.index(this) === 0;

            // do something with the answer
            triggers.eq(0).html("You clicked " + (yes ? "yes" : "no"));
        });


        $("#prompt form").submit(function(e) {

            // close the overlay
            triggers.eq(gkey).overlay().close();

            // get user input

            var input = $("input", this).val();
            var textarea = $("textarea", this).val();
            var id = gid;

            var com = textarea;

            if (com) {
                $.ajax({
                    type: "POST",
                    url: "index.php?m=index.messageadd2",
                    data: "id=" + id + '&com=' + com,
                    success: function(msg) {
                        if (msg != 'sucesss') {
                            alert(msg);
                        }
                    }
                });
            }

            //alert(guser);
            // do something with the answer
            //triggers.eq(1).html(input);

            // do not submit the form
            return e.preventDefault();
        });

    });
</script>


<?php TPL::plugin('include/infooter');?>

<div id="exposeMask"
     style="position: absolute; top: 0px; left: 0px; width: 1920px; height: 959px; z-index: 9998; background-color: rgb(235, 236, 255); display: none; opacity: 0.9; "></div>
</body>
</html>