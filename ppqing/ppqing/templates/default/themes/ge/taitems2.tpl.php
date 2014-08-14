<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 items.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$uid = $SPuid;
$guid = $SPuid;
$userinfo = USER::get('userinfo');
$db = APP :: ADP('db');
$thinfo = $db->query('select * from ' . $db->getTable(T_USERS) . '  where uid=' . $uid);
?>
<ol id="posts">
    <li>
        <?php
        $m = V('g:m');
        $checkFollow = $db->query('select *  from ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $userinfo['uid'] . ' and guid=' . $guid);

        ?>

    </li>
    <?php
    $page = V('g:page');
    $filter_type = V('g:filter_type');
    if (!$page) $page = 1;
    $sum = 5;
    $total = ($page - 1) * $sum + 5;
    $userinfo = USER::get('userinfo');
    $uid = $SPuid;
    $db = APP :: ADP('db');
    $addtype = '';
    $linktype = '';
    if ($filter_type) {
        $addtype = ' and types=' . $filter_type;
        $linktype = '&filter_type=' . $filter_type;
    }
    $rows = $db->query('select count(uid) as count from ' . $db->getTable(T_CONTENT) . '  where uid=' . $uid . $addtype . ' and sercet !=1 ');
    $allcount = $rows[0]['count'];
    if ($results = CACHE::get($uid . '_my_' . $page) && false) {
    } else {
        if (!$filter_type) {
            $results = $db->query('select * from ' . $db->getTable(T_CONTENT) . ' where uid=' . $uid . $addtype . ' and (sercet = null or sercet=0)  order by did desc limit ' . $total . ',' . $sum);
        }
        CACHE::set($uid . '_my_' . $page, $results, 17200);
    }
    if ($filter_type) $results = $db->query('select * from ' . $db->getTable(T_CONTENT) . ' where uid=' . $uid . $addtype . ' and sercet=0  order by did desc limit ' . $total . ',' . $sum);
    $results = APP::F('content_filter', $results);
    foreach ($results as $key => $value) {
        ?>

<li class="post regular not_mine' id=" post_4259474622">
<div class='itemtop'>
    <div class="post_controls">
        <span style='float:left;'><?php echo APP::F('format_time', $value['thedate']);?>  </span><span
            style='float:right;'>
<a href='index.php?m=show&id=<?php echo $value['did'];?>'>评论<?php if ($value['cnum'] > 0) echo '(' . $value['cnum'] . ')';?></a>
        <?php  if ($value['uid'] == $userinfo['uid']) { ?>
        | <a href='index.php?m=index.del&id=<?php echo $value['did'];?>&type=<?php echo $value['types'];?>'>删除</a>
        <?php }?></span>
    </div>
</div>
<div class="post_content">
    <?php if ($value['title'] && $value['types'] == 4) { ?><img src='<?php echo BASE_URL;?>css/bgimg/hi.gif'></img>
    <b><?php echo $value['title'];?></b><p><?php
} else   if ($value['title'] && $value['types'] == 7) {
    $parseLink = parse_url($value['title']);
    if (preg_match("/(youku.com|youtube.com|5show.com|ku6.com|sohu.com|mofile.com|sina.com.cn|tudou.com)$/i", $parseLink['host'], $hosts)) {
        $flashinfo = APP::F('getflashvar', $value['title'], $hosts[1]);
        echo $flashinfo['title'] . '<p>';
        ?>

        <object height="460" width="500" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000">
            <param name="wmode" value="transparent">
            <param name="movie" value="<?php echo $flashinfo['flashvar']?>">
            <embed height="460" width="500" type="application/x-shockwave-flash" allowfullscreen="true"
                   wmode="transparent" src="<?php echo $flashinfo['flashvar']?>">
        </object>
        </object><p>
<?php
    } else {
        echo "很抱歉，你的视频无法播放!";
    }
} else {
    ?>

    <?php echo "<b><a href="; ?><?php if (PPREWRITE == 1) {
        echo BASE_URL, "m.show?id=" . $value['did'];
    } else {
        echo "index.php?m=show&id=" . $value['did'];
    } ?><?php echo " >" . $value['title'] . "</a></b><p>";
}?>
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
                        <img src="<?php echo $pvalue;?>" onclick="makebig(<?php echo $value['did']; ?>)"></img>
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
                        <img src="<?php echo $pvalue;?>" onclick="makesmall(<?php echo $value['did']; ?>)"></img>
                        <br></br>
                        <a href="<?php echo $pvalue;?>" class="showoutimg" rel="lightbox"><img src="css/bgimg/look.gif"
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
            echo  '<a style=color:#E47200 href=' . BASE_URL . 'index.php?m=ta&uid=' . $tme[$keys]['uid'] . ' >' . $names[0] . '</a>:' . $names[1] . '<p>';
        }

        ?>
    </div>
    <?php } else if ($value['types'] == 8) {
    echo $value['data']; ?>
    <?php } else {
    echo APP::F('img_match', $value['data']); ?>
    <?php }?>
</div>
   
 </li>
<?php }?>
    <li class="botitem" style='margin-top:30px'>
        <?php
        $db = APP :: ADP('db');
        $results = $db->query('select * from  ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $uid . ' limit 16');
        foreach ($results as $key => $value) {
            ?>
            <div class='otherimg'>
                <a href='index.php?m=ta&uid=<?php  echo $value['guid'];?>'><img
                        title=<?php echo $value['gname'];?>  style='width:48px; padding:2px; background:#ffffff;'
                    src="<?php if (file_exists('avatar/i_upload/' . $value['guid'] . '_small_2.jpg')) {
                        echo BASE_URL . '/avatar/i_upload/' . $value['guid'] . '_small_2.jpg';
                    } else {
                        echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                    }?>"></img></a>

                <p>

            </div>
            <?php }?>
    </li>
</ol>
