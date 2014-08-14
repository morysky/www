<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 new
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$uid = $SPuid;
$guid = $SPuid;
$userinfo = USER::get('userinfo');
$db = APP :: ADP('db');
$thinfo = $db->query('select * from ' . $db->getTable(T_USERS) . '  where uid=' . $uid);
?>
<!--[if lt IE 7.]>
    <style type="text/css">
        #wrapper #sidebar #bottom {
            background: transparent;
        }

        #wrapper #sidebar #top #avatar {
            background: none;
        }

        #wrapper #sidebar #top #avatar img {
            border: 5px solid #f1f1f1;
        }

        #wrapper #sidebar #top .heading#followontumblr {
            background-image: none;
            text-indent: 0;
        }

        #wrapper #sidebar #top .heading#twitter {
            background-image: none;
        }

        #wrapper #sidebar #top .heading#following {
            background-image: none;
        }

        #wrapper #content .post .audio .player {
            float: none;
        }

        #wrapper #content .post .audio .meta {
            display: none;
            float: none;
        }
    </style>
<![endif]-->

<!--[if lt IE 8.]>
    <style type="text/css">
        #wrapper #content .bottom {
            background: transparent;
        }

        #wrapper #content .post .footer {
            background: transparent;
            color: #000;
        }

        #wrapper #content .post .audio {
            float: none;
            background: transparent;
        }

        #wrapper #content .post .notecontainer .notes {
            padding: 0;
            margin: 0;
        }
    </style>
<![endif]-->
<div id="wrapper">
    <div id="title">
        <a href="<?php if (PPREWRITE == 1) {
            echo BASE_URL, "m.ta?uid=" . $uid;
        } else {
            echo "index.php?m=ta&uid=" . $uid;
        }?>">

            <?php echo $thinfo[0]['name'];?>
        </a>
    </div>

    <div id="content">
        <?php

        $userinfo = USER::get('userinfo');
        $id = V('g:id');
        $db = APP :: ADP('db');

        $results = $db->query('select x.* ,y.* from ' . $db->getTable(T_CONTENT) . ' x left join ' . $db->getTable(T_USERS) . '  y on  x.uid=y.uid where x.did=' . $id);
        if ($results[0]['sercet'] != 1 || ($results[0]['sercet'] == 1 && $results[0]['uid'] == $userinfo['uid'])) {
            foreach ($results as $key => $value) {

                ?>
                <div class="post">
                    <div class="posttop">

                        <?php if ($value['title'] && $value['types'] == 4) { ?><img
                            src='<?php echo BASE_URL;?>css/bgimg/hi.gif'></img>
                        <b><?php echo $value['title'];?></b><p><?php } else { ?>

                        <?php echo "<b  style='font-size:26px' >" . $value['title'] . "</b><p>";
                    }?>
                    </div>
                    <?php  if ($value['types'] == 2) { ?>
                    <?php
                    $imagesall = unserialize($value['data']);
                    if (is_array($imagesall[0])) {
                        $images = $imagesall[0];
                    } else {
                        $images = $imagesall;
                    }
                    $imagestr = BASE_URL . $images[0];
                    for ($i = 1; $i < count($images); $i++) {
                        $imagestr .= "|" . BASE_URL . $images[$i];
                    }
                    if (is_array($imagesall[0])) {
                        $images_small = $imagesall[1];
                        $images_big = $imagesall[0];
                        $images_str = $imagesall[2];
                        ?>
                        <div id='sppic_<?php echo $value['did']; ?>'>
                            <div id='spsmallpic_<?php echo $value['did']; ?>' class='spsmallpic'>
                                <ul>
                                    <?php foreach ($images_small as $pkey => $pvalue) {
                                    ?>
                                    <li>
                                        <img src="<?php echo $pvalue;?>"
                                             onclick="makebig(<?php echo $value['did']; ?>)"></img>
                                    </li>
                                    <?php }?>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div id='spbigpic_<?php echo $value['did']; ?>'
                                 class='spbigpic' <?php if ('Internet Explorer' == APP::F('getbrowser')) {
                                echo '';
                            } else {
                                echo 'style="display:none"';
                            }?>>
                                <ul>
                                    <?php foreach ($images_big as $pkey => $pvalue) {
                                    ?>
                                    <li>
                                        <img src="<?php echo $pvalue;?>"
                                             onclick="makesmall(<?php echo $value['did']; ?>)"></img>
                                        <br></br>
                                        <a href="<?php echo $pvalue;?>" class="showoutimg" rel="lightbox"><img
                                                src="css/bgimg/look.gif"
                                                style="border:0px"></a>  <?php echo $images_str[$pkey];?>
                                        <br></br>
                                    </li>
                                    <?php }?>
                                </ul>
                                <div class="clear"></div>
                            </div>

                        </div>

                        <?php } else { ?>
<embed height="360" width="510" type="application/x-shockwave-flash"
       flashvars="bcastr_file=<?php echo $imagestr;?>&amp;bcastr_link=<?php echo $imagestr;?>&amp;bcastr_config=0x008000:fontcolor|4:fontform|0x008000:fontbgcolor|0:fonttouming|0xffffff:anjiancolor|0x008000:bottoncolor|0x000033:nowbottoncolor|5:palytime|3:picclass|1:botton|_blank:winodws"
       wmode="transparent" quality="high" src="<?php echo BASE_URL;?>flash/bcastr.swf">



<?php }
                } else if ($value['types'] == 3) { ?>
                    <div style="width:510px;">
                        <img src='<?php echo BASE_URL;?>css/bgimg/quote1.gif'></img>
                        <?php echo $value['data'];?>
                        <img src='<?php echo BASE_URL;?>css/bgimg/quote2.gif'></img>
                    </div>
                    <?php } else if ($value['types'] == 5) { ?>
                    <div style="width:510px;">
                        <?php  $contAll = explode('<p>', $value['data']);
                        $tme = $db->query('select * from ' . $db->getTable(T_TME) . ' where did=' . $value['did']);
                        foreach ($contAll as $keys => $values) {
                            $names = explode(':', $values);
                            if (array_key_exists($keys, $tme)) {
                                echo  '<a style=color:#E47200 href=' . BASE_URL . 'index.php?m=ta&uid=' . $tme[$keys]['uid'] . ' >' . $names[0] . '</a>:' . $names[1] . '<p>';
                            } else {
                                echo $names[0] . ":" . $names[1] . '<p>';
                            }
                        }

                        ?>
                    </div>
                    <?php } else if ($value['types'] == 8) {
                    echo $value['data']; ?>
                    <?php } else {
                    echo APP::F('img_match', $value['data']); ?>
                    <?php }?>
                    <?php if ($value['sign'] != '' && $value['articlenum'] > 10) { ?>
                    <div style="height:16px;"></div>
                    <div style='font-weight:bold;
width:490px;
overflow: hidden;
padding: 20px 0 5px;
line-height: 1.6em;
background: url(css/bgimg/sigline.gif) no-repeat 0 0;'>
                        <?php
                        $sign = APP::F('BBCode', $value['sign']);
                        echo $sign;
                        ?>
                    </div>
                    <?php }?>
                </div>
                <?php } ?>

            <?php if ($userinfo != '') { ?>
                <?php TPL::plugin('include/cinput'); ?>
                <?php } else { ?>
                <div style='padding:20px;font-size:28px;color:#ffffff;'>登录后方可评论:<a style='color:#ffffff;''
                    href='index.php?m=account.login'>请登录</a></div>
                <?php } ?>
            <?php TPL::plugin('include/clist'); ?>
            <?php } else { ?>
            <div style='magin:40px;font-size:28px;color:#ffffff;'>本文章不公开，你无权查看．</div>
            <?php }?>

    </div>

    <div id="sidebar">
        <div id="top">
            <div id="avatar"><a href="index.php?m=ta&uid=<?php echo $uid;?>"><img width=128 height=128
                                                                                  src="<?php if (file_exists('avatar/i_upload/' . $uid . '_small.jpg')) {
                                                                                      echo BASE_URL . '/avatar/i_upload/' . $uid . '_small.jpg';
                                                                                  } else {
                                                                                      echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                                                                  }?>"></a></div>
            <div id="description"></div>

            <div id="pages" class="ask_and_submit">


                <div class="clear"></div>
            </div>


            <div><?php
                $m = V('g:m');
                $checkFollow = $db->query('select *  from ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $userinfo['uid'] . ' and guid=' . $guid);

                ?>
                <?php if (($guid != $userinfo['uid']) && $userinfo && ($m == 'ta')) { ?>
                    <div>
                        <a style="margin:4px; padding:4px; border:2px solid #d1d1d1;background:#919191;color:#212121;"
                           href="index.php?m=post.recomadd&guid=<?php  echo $guid;?>">推荐</a>
                        <?php if (!$checkFollow) { ?>
                        <a style="margin:4px; padding:4px; border:2px solid #d1d1d1;background:#919191;color:#212121;"
                           href='index.php?m=ta.follow&uid=<?php  echo $guid;?>'>欣赏他（她）</a>
                        <?php } else { ?>
                        <a style="margin:4px; padding:4px; border:2px solid #d1d1d1;background:#919191;color:#212121;"
                           href="index.php?m=ta.delfollow&uid=<?php  echo $guid;?>">取消欣赏</a>
                        <?php } ?>
                        <div style="height:30px;"></div>
                    </div><?php }?></div>


            <div><?php echo $thinfo[0]['descs'];?></div>


            <div class="heading" id="following">我欣赏的人</div>
            <div class="content" id="following-avatars">
                <?php
                $db = APP :: ADP('db');
                $results = $db->query('select * from  ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $uid . ' limit 12');
                foreach ($results as $key => $value) {
                    ?>
                    <a href="index.php?m=ta&uid=<?php  echo $value['guid'];?>"><img
                            src="<?php if (file_exists('avatar/i_upload/' . $value['guid'] . '_small_2.jpg')) {
                                echo BASE_URL . '/avatar/i_upload/' . $value['guid'] . '_small_2.jpg';
                            } else {
                                echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                            }?>" width=40 height=40></a>
                    <?php }?>
            </div>


            <div id="buttons">

            </div>

        </div>

        <div id="bottom"></div>
        <div id="copyright">© 2011 身旁网</div>
    </div>

    <div class="clear"></div>
</div>
    
    