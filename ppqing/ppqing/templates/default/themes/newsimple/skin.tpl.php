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
        <a href="index.php?m=ta&uid=<?php echo $uid;?>">

            <?php echo $thinfo[0]['name'];?>
        </a>
    </div>

    <div id="content">


        <?php TPL::plugin('themes/newsimple/taitems', array('SPuid' => $SPuid));?>


    </div>

    <div id="sidebar">
        <div id="top">
            <div id="avatar"><a href="<?php if (PPREWRITE == 1) {
                echo BASE_URL, "m.ta?uid=" . $uid;
            } else {
                echo "index.php?m=ta&uid=" . $uid;
            }?>"><img width=128 height=128 src="<?php if (file_exists('avatar/i_upload/' . $uid . '_small.jpg')) {
                echo BASE_URL . '/avatar/i_upload/' . $uid . '_small.jpg';
            } else {
                echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
            }?>"></a></div>
            <div id="description"></div>

            <div id="pages" class="ask_and_submit">


                <div class="clear"></div>
            </div>


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
    
    
