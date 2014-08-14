<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 input.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$cid = V('g:id');
$page = V('g:page');
if (!$page) $page = 1;
$sum = 20;
$total = ($page - 1) * $sum;
$db = APP :: ADP('db');
$rows = $db->query('select count(uid) as count from ' . $db->getTable(T_TME) . '  where uid=' . $userinfo['uid']);
$allcount = $rows[0]['count'];
$fresults = $db->query('select x.did as did,x.tid as tid,x.uid as uid, y.data as data, y.thedate as thedate,y.title as title,y.uid as tuid from ' . $db->getTable(T_TME) . '  x left join ' . $db->getTable(T_CONTENT) . '  y on x.did=y.did where x.uid=' . $userinfo['uid'] . ' order by x.tid desc limit ' . $total . ',' . $sum);
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
                <li><a href="index.php?m=post.text" title="文本"><img
                        src="<?php echo BASE_URL;?>css/newimage/images/icon_01.png" alt="文本"/></a></li>
                <li><a href="index.php?m=post.photo" title="图片"><img
                        src="<?php echo BASE_URL;?>css/newimage/images/icon_03.png" alt="图片"/></a></li>
                <li><a href="index.php?m=post.quote" title="引用"><img
                        src="<?php echo BASE_URL;?>css/newimage/images/icon_05.png" alt="引用"/></a></li>
                <li><a href="index.php?m=post.link" title="链接"><img
                        src="<?php echo BASE_URL;?>css/newimage/images/icon_07.png" alt="链接"/></a></li>
                <li><a href="index.php?m=post.chat" title="对话"><img
                        src="<?php echo BASE_URL;?>css/newimage/images/icon_09.png" alt="对话"/></a></li>
                <li><a href="index.php?m=post.audio" title="音乐"><img
                        src="<?php echo BASE_URL;?>css/newimage/images/icon_11.png" alt="音乐"/></a></li>
                <li><a href="index.php?m=post.video" title="视频"><img
                        src="<?php echo BASE_URL;?>css/newimage/images/icon_13.png" alt="视频"/></a></li>
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
        <span style='font-size:18px;font-weight:bold;'>有（<?php echo $allcount;?>）人提到我</span>
    </div>

    <?php
      $fresults = APP::F('content_filter', $fresults);
    foreach ($fresults as $gkey => $fvalue) {
        ?>
        <div class="wrapper postwrap clearfix" id='postother'>
            <div class="user_photo"></div>

            <div class="c_box">
                <div class="c_b_t"></div>
                <div class="c_b_c clearfix">
                    <div style='margin:8px;padding:4px;'>
                        <div style='float:left;width:80px;'><img style='padding:2px;border:1px solid #919191'
                                                                 src='<?php if (file_exists('avatar/i_upload/' . $fvalue['tuid'] . '_small_2.jpg')) {
                                                                     echo BASE_URL . '/avatar/i_upload/' . $fvalue['tuid'] . '_small_2.jpg';
                                                                 } else  if (file_exists('avatar/i_upload/' . $fvalue['tuid'] . '_small.jpg')) {
                                                                     echo BASE_URL . '/avatar/i_upload/' . $fvalue['tuid'] . '_small.jpg';
                                                                 } else {
                                                                     echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                                                 }?>' width='64px'></img></div>
                        <div style='float:right:width:400px;'><a
                                href='index.php?m=ta&uid=<?php echo $fvalue['uid'];?>'><?php echo $fvalue['name'];?></a>    </a>
<span id='tafol<?php echo  $fvalue['uid'];?>'>
<?php echo '<span style="font-size:16px;font-weight:bold;">' . $fvalue['title'] . '</span> <a href=' . BASE_URL . 'index.php?m=show&id=' . $fvalue['did'] . '  title="查看" ><img  style=\'border:0px\' src=\'css/bgimg/look.gif\'></img></a>' ?>
</span>

                            <p>
                            <hr>
                            <p></p>

                            <div style="font-weight:normal;line-height:22px;">
                                    <?php echo '' . strip_tags($fvalue['data']) . ' (' . APP::F('format_time', $fvalue['thedate']) . ')';?></p>
                            </div>
                        </div>
                        <div style="clear:both;"></div>
                    </div>

                </div>

                <div class="c_b_b"></div>


            </div>
        </div>
        <?php }?>

</div>
<?php } ?>
<?php $theurl = "index.php?m=index.tme"; ?>
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

        
      