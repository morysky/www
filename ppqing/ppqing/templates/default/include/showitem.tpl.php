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

$userinfo = USER::get('userinfo');
$id = V('g:id');
$db = APP :: ADP('db');

$results = $db->query('select x.* ,y.* from ' . $db->getTable(T_CONTENT) . ' x left join ' . $db->getTable(T_USERS) . '  y on  x.uid=y.uid where x.did=' . $id);
if ($results[0]['sercet'] != 1 || ($results[0]['sercet'] == 1 && $results[0]['uid'] == $userinfo['uid'])) {
    foreach ($results as $key => $value) {

        ?>

<li class="post regular not_mine' id=" post_4259474622">

<div class="post_controls">
    <span style='float:left;'><?php echo APP::F('format_time', $value['thedate']);?>  </span><span style='float:right;'>
<a href='index.php?m=show&id=<?php echo $value['did'];?>'>评论<?php if ($value['cnum'] > 0) echo '(' . $value['cnum'] . ')';?></a>
    <?php  if ($value['types'] == 1 && ($value['uid'] == $userinfo['uid'] || $userinfo['uid'] == 1 || $userinfo['uid'] == 90)) { ?>
    | <a href="index.php?m=post.text&did=<?php echo $value['did'];?>">编辑</a>
    <?php }?><?php  if ($value['uid'] == $userinfo['uid'] || $userinfo['uid'] == 1 || $userinfo['uid'] == 90) { ?>
    | <a href='index.php?m=index.del&id=<?php echo $value['did'];?>&type=<?php echo $value['types'];?>'>删除</a>
    <?php }?></span>
</div>
<div class="post_content">
    <?php if ($value['title'] && $value['types'] == 4) { ?><img src='<?php echo BASE_URL;?>css/bgimg/hi.gif'></img>
    <b><?php echo $value['title'];?></b><p><?php } else { ?>

    <?php echo "<b  style='font-size:26px' >" . $value['title'] . "</b><p>";
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
       <div class="so_ie_doesnt_treat_this_as_inline">
           <span class="arrow"></span>

           <a class="post_avatar" id="post_controls_avatar"
              style="background-image:url('<?php if (file_exists('avatar/i_upload/' . $value['uid'] . '_small_2.jpg')) {
                  echo   BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small_2.jpg';
              } else if (file_exists('avatar/i_upload/' . $value['uid'] . '_small.jpg')) {
                  echo   BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small.jpg';
              } else {
                  echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
              }?>')" title="" href="index.php?m=ta&uid=<?php echo $value['uid'];?>">&nbsp;</a>
       </div>
 </li>
<?php } ?>
</ol>
<?php if ($userinfo != '') { ?>
    <?php TPL::plugin('include/cinput'); ?>
    <?php } else { ?>
    <div style='padding:20px;font-size:28px;color:#ffffff;'>登录后方可评论 :<a style='color:#ffffff;''
        href='index.php?m=account.login'>请登录</a></div>
    <?php } ?>
<?php TPL::plugin('include/clist'); ?>
<?php } else { ?>
<div style='magin:40px;font-size:28px;color:#ffffff;'>本文章不公开，你无权查看．</div>
<?php } ?>