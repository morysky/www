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


<style type="text/css">
    .cufon-canvas {
        margin-left: -260px !important;
    }

    div.CONTENT ul.POSTS li div.META ul li {
        background: url('<?php echo BASE_URL;?>css/xdai_skin/bgimg/bubble.png') no-repeat !important;
        _filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src = "<?php echo BASE_URL;?>css/xdai_skin/bgimg/bubble.png");
        background: none;
        height: 68px;
        width: 68px;
        display: block;
        margin: 5px 0 0 0;
    }

    div.CONTENT {
        margin-bottom: -20px;
    }
</style>







<div class="NAVIGATION">

    <div class="SPACING">


        <div class="SEARCH">

        </div>
    </div>
</div>

<div class="CONTENT">

    <div class="TITLE">

        <a href="<?php if (PPREWRITE == 1) {
            echo BASE_URL, "m.ta?uid=" . $uid;
        } else {
            echo "index.php?m=ta&uid=" . $uid;
        }?>">
            <h1 id="title">
                <cufon style="width: 239px; height: 70px;" alt="Untitled" class="cufon cufon-canvas">
                    <canvas style="width: 260px; height: 73px; top: 0px; left: -3px;" height="73" width="260"></canvas>
                    <cufontext><?php echo $thinfo[0]['name'];?></cufontext>
                </cufon>
            </h1>
        </a>

        <div class="THINGY"></div>

        <h2><?php if ($thinfo[0]['descs']) {
            echo  $thinfo[0]['descs'];
        }?></h2>

    </div>


    <ul class="POSTS">


        <li style="margin-top: 30px;" class="BREAK_ALT"></li>

        <?php
        $userinfo = USER::get('userinfo');
        $id = V('g:id');
        $db = APP :: ADP('db');

        $results = $db->query('select x.* ,y.* from ' . $db->getTable(T_CONTENT) . ' x left join ' . $db->getTable(T_USERS) . '  y on  x.uid=y.uid where x.did=' . $id);
        if ($results[0]['sercet'] != 1 || ($results[0]['sercet'] == 1 && $results[0]['uid'] == $userinfo['uid'])) {
            foreach ($results as $key => $value) {
                ?>
                <li style="padding-top: 0px;" class="POST QUOTE">
                    <div class="ENTRY" style="">

                        <div class="TITLE">


                            <?php echo "<a title=" . $value['title'] . " href=";?><?php if (PPREWRITE == 1) {
                            echo BASE_URL, "m.show?id=" . $value['did'];
                        } else {
                            echo "index.php?m=show&id=" . $value['did'];
                        } ?><?php echo " >" . APP::F('cut_str', $value['title'], 12) . "</a>";?>


                            <div class="POSTED">
                                <div class="LEFT"></div>
                                <div class="MID">


                                    <a href=index.php?m=show&id=<?php echo $value['did'];?>><?php echo APP::F('format_time', $value['thedate']);?></a>


                                </div>
                                <div class="RIGHT"></div>
                            </div>


                        </div>

                        <div class="POST">


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
                            <?php
                        } else if ($value['types'] == 8) {
                            echo $value['data'];
                        } else {
                            ?>
                            <?php echo APP::F('img_match', $value['data']); ?>
                            <?php }?>


                        </div>

                        <div class="META">

                            <ul class="">

                                <li>
                                    <a href="index.php?m=ta&uid=<?php echo $uid;?>&filter_type=<?php echo $value['types'];?>">
                                        <div class="
										<?php if ($value['types'] == 1 || $value['types'] == 8 || $value['types'] == 9) { ?>TEXT<?php } else if ($value['types'] == 2) { ?>PHOTO<?php } else if ($value['types'] == 3) { ?>QUOTE<?php } else if ($value['types'] == 4) { ?>LINK<?php } else if ($value['types'] == 5) { ?>CHAT<?php } else if ($value['types'] == 6) { ?>AUDIO<?php } else { ?>VIDEO<?php }?>
										"></div>
                                    </a>
                                </li>


                            </ul>

                        </div>

                    </div>

                </li>


                <?php if (count($results) != ($key + 1)) { ?>
                    <li class="BREAK"></li>
                    <?php } ?>
                <?php } ?>
            <li style="padding-top: 0px;" class="POST QUOTE">
                <?php if ($userinfo != '') { ?>
                <?php TPL::plugin('include/cinput'); ?>
                <?php } else { ?>
                <div class='nowlogin'>登录后方可评论:<a class='plogin' href='index.php?m=account.login'>请登录</a></div>
                <?php }?>
                <?php TPL::plugin('include/clist');?>
            </li>
            <?php } else { ?>
            <div style='magin:40px;font-size:28px;color:#ffffff;'>本文章不公开，你无权查看．</div>
            <?php }?>


    </ul>

</div>

</div>

</li>






</ul>

<div class="SIGNATURE">
</div>

</div>

<div class="FOOTER">


    copy by 身旁网


</div>


	
	
		

		
		
		


