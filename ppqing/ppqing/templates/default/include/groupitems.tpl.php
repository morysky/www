<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 items.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
?>
<ol id="posts">

    <?php
    $page = V('g:page');
    if (!$page) $page = 1;
    $sum = 20;
    $total = ($page - 1) * $sum;
    $userinfo = USER::get('userinfo');

    $uid = $SPuid;
    $db = APP :: ADP('db');
    $rows = $db->query('select count(uid) as count from ' . $db->getTable(T_CONTENT) . '  where uid=' . $uid . ' and (sercet = null or sercet=0) ');
    $allcount = $rows[0]['count'];
    if ($results = CACHE::get($uid . '_my_' . $page) && false) {
    } else {
        $results = $db->query('select * from ' . $db->getTable(T_CONTENT) . '  x  left join ' . $db->getTable(T_USERS) . ' z on x.uid=z.uid where  x.uid=' . $uid . ' and sercet=0 order by x.did desc limit ' . $total . ',' . $sum);
        CACHE::set($uid . '_my_' . $page, $results, 17200);
    }
    $results = APP::F('content_filter', $results);
    if (!file_exists('avatar/i_upload/' . $uid . '_small_2.jpg') && file_exists('avatar/i_upload/' . $uid . '_small.jpg')) {
        $image = APP::N('MakeMiniature');
        $image->setParam('avatar/i_upload/' . $uid . '_small.jpg', 'avatar/i_upload/' . $uid . '_small_2.jpg');
        $image->createNewImg($image->im, 64, 64, false);
    }
    foreach ($results as $key => $value) {
        ?>

<li class="post regular not_mine' id=" post_4259474622">
<div class="post_controls">
    <span style='float:left;'><a
            href='index.php?m=ta&uid=<?php echo $value['uid'];?>'><?php echo $value['name'];?></a>：<?php echo APP::F('format_time', $value['thedate']);?>  </span><span
        style='float:right;'>
<a href='index.php?m=show&id=<?php echo $value['did'];?>'>评论<?php if ($value['cnum'] > 0) echo '(' . $value['cnum'] . ')';?></a>
    <?php  if ($value['uid'] == $userinfo['uid']) { ?>
    | <a href='index.php?m=index.del&id=<?php echo $value['did'];?>&type=<?php echo $value['types'];?>'>删除</a>
    <?php }?></span>
</div>
<div class="post_content">
    <?php if ($value['title'] && $value['types'] == 4) { ?><img src='<?php echo BASE_URL;?>css/bgimg/hi.gif'></img>
    <b><?php echo $value['title'];?></b><p><?php } else { ?>

    <?php echo "<b><a href=index.php?m=show&id=" . $value['did'] . " >" . $value['title'] . "</a></b><p>";
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
</div>
       <div class="so_ie_doesnt_treat_this_as_inline">
           <span class="arrow"></span>

           <a class="post_avatar" id="post_controls_avatar"
              style="background-image:url('<?php if (file_exists('avatar/i_upload/' . $value['uid'] . '_small_2.jpg')) {
                  echo BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small_2.jpg?id=' . rand(1110, 9900);
              } else if (file_exists('avatar/i_upload/' . $value['uid'] . '_small.jpg')) {
                  echo BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small.jpg';
              } else {
                  echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
              }?>')" title="" href="index.php?m=ta&uid=<?php echo $value['uid'];?>">&nbsp;</a>
       </div>

 </li>
<?php }?>
</ol>
<div class="page">
<?php

    $theurl = "index.php?m=ta&uid=" . $uid . '&page';

    $pages = APP::N('pages', 20, $allcount, $page, $theurl); // 创建对象
    $pages->setShowPageNum(10);     // 设置显示的页数
    $pages->setCurrentIndexPage(5);   // 设置当前页在分页栏中的位置
    $pages->setFirstPageText('首页');   // 设置链接第一页显示的文字
    $pages->setLastPageText('尾页');    //  设置链接最后一页显示的文字
    $pages->setPrePageText('上一页');   //   设置链接上一页显示的文字
    $pages->setNextPageText('下一页');  //    设置链接下一页显示的文字
    $pages->setPageCss('pagea');        //设置各分页码css样式的class名称
    $pages->setCurrentPageCss('pageacur');   // 设置当前页码css样式的class名称
//$pages->setPageStyle('pagea');      设置各分页码的样式，即style属性
//$pages->setCurrentPageStyle($style);  设置当前页码的样式，即style属性
    $pages->setLinkSymbol('=');       // 设置地址链接中页码与变量的连接符，如page=2中的“=”
    $pages->isShowFirstAndLast(true); //   设置是否显示第一页与最后一页的链接
    echo  $pages->generatePages();

    ?>
</div>
