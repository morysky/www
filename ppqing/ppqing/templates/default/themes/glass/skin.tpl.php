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
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo BASE_URL;?>/js/DD_belatedPNG.js"></script>


<script type="text/javascript">
    DD_belatedPNG.fix('.cool_top,.cool_center,.article_date,.article_top,.article_center,.article_btm,.tw_logo,img,.return_index,.cool_icon,.page_num a,.page_num a:hover,.page_num span.current,.page_num span.disabled,.cool_footer,.footer_con,.search_k,.search_btn,.comment,.mail_link,.footer_c');
</script>
<![endif]-->
<div class="cool_main">
    <div class="cool_top"></div>
    <div class="cool_center">
        <div class="cool_l">

            <?php
            $page = V('g:page');
            $filter_type = V('g:filter_type');
            if (!$page) $page = 1;
            $sum = 20;
            $total = ($page - 1) * $sum;
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
                <div class="cool_article">

                    <div class="article_date">
                        <h1><?php if ($value['types'] == 1 || $value['types'] == 8 || $value['types'] == 9) { ?>
                            文<?php } else if ($value['types'] == 2) { ?>图<?php } else if ($value['types'] == 3) { ?>
                            话<?php } else if ($value['types'] == 4) { ?>链<?php } else if ($value['types'] == 5) { ?>
                            聊<?php } else if ($value['types'] == 6) { ?>音<?php } else { ?>影<?php }?>
                        </h1>
                        <h6>^-^</h6>

                        <div style="margin-top:15px;text-align:center;">

                        </div>
                    </div>
                    <div class="article_con">
                        <div class="article_top"></div>
                        <div class="article_center">
                            <div class="title">
                                <h2>  <?php echo "<a title=" . $value['title'] . " href=";?><?php if (PPREWRITE == 1) {
                                    echo BASE_URL, "m.show?id=" . $value['did'];
                                } else {
                                    echo "index.php?m=show&id=" . $value['did'];
                                } ?><?php echo ">" . APP::F('cut_str', $value['title'], 12) . "</a>";?></h2></div>
                            <div class="titleBar"><span class="where">时间:<a
                                    href=index.php?m=show&id=<?php echo $value['did'];?>><?php echo APP::F('format_time', $value['thedate']);?></a></span><span
                                    class="author"></span>评论<?php if ($value['cnum'] > 0) echo '(' . $value['cnum'] . ')';?>
                            </div>
                            <div class="POST content_txt">


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
                                                    <a href="<?php echo $pvalue;?>" class="showoutimg"
                                                       rel="lightbox"><img src="css/bgimg/look.gif" style="border:0px"></a>  <?php echo $images_str[$pkey];?>
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
                            <div class="content_more"><a href="index.php?m=show&id=<?php echo $value['did'];?>"
                                                         title="Sputtr：信息聚合搜索引擎" target="_blank"><img
                                    src="<?php echo BASE_URL;?>css/glass_skin/bgimg/more.gif" width="52"
                                    height="22"></a></div>
                        </div>
                        <div class="article_btm"></div>
                    </div>
                    <div class="yuanchuang_ico"><img src="<?php echo BASE_URL;?>css/glass_skin/bgimg/yuanchuang.png"
                                                     width="74" height="76"></div>
                </div>

                <?php }?>
            <div class="page">
<?php

    $theurl = "index.php?m=ta&uid=" . $uid . $linktype . '&page';

    $pages = APP::N('pages', 20, $allcount, $page, $theurl); // 创建对象
    $pages->setShowPageNum(5);     // 设置显示的页数
    $pages->setCurrentIndexPage(3);   // 设置当前页在分页栏中的位置
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
        </div>
        <div class="cool_r">
            <div class="tw_logo"><a href='<?php if (PPREWRITE == 1) {
                echo BASE_URL, "m.ta?uid=" . $uid;
            } else {
                echo "index.php?m=ta&uid=" . $uid;
            }?>'><img
                    style="width:expression(this.width > 160 ? '160px' : this.width);max-width:160px;border:3px solid #ffffff;"
                    src='<?php  if (file_exists('avatar/i_upload/' . $uid . '_small_2.jpg')) {
                        echo BASE_URL . '/avatar/i_upload/' . $uid . '_small_2.jpg';
                    } else if (file_exists('avatar/i_upload/' . $uid . '_small.jpg')) {
                        echo BASE_URL . '/avatar/i_upload/' . $uid . '_small.jpg';
                    } else {
                        echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                    }?>'></img></a></div>
            <div class="cool_logo">
                <?php if ($thinfo[0]['descs']) {
                echo  $thinfo[0]['descs'];
            }?>
            </div>

            <div class="cool_icon">
                <a style="font-size:28px;color:#ffffff;margin-top:-16px;"
                   href="index.php?m=ta&uid=<?php echo $uid;?>"><?php echo $thinfo[0]['name'];?></a>
            </div>


            <!-- 热门关键字 -->

            <div>
            </div>


            <!-- 最新评论 -->
        </div>
    </div>
</div>
<div class="cool_footer">
    <div class="footer_con">


        <!-- 圆桌讨论 -->
    </div>

</div>
</div>

        

	
	
		

		
		
		

