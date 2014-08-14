<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 input.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$id = V('g:id');
$page = V('g:page');
if (!$page) $page = 1;
$sum = 20;
$total = ($page - 1) * $sum;
$db = APP :: ADP('db');
$tagsrow = $db->query('select * from ' . $db->getTable(T_TAGS) . ' where tarid=' . $id);
$rows = $db->query('select count(tarid) as count from ' . $db->getTable(T_TAGS_CONTENT) . ' where tarid=' . $id . ' order by did desc ');
$allcount = $rows[0]['count'];
/*
         * 'select *,x.did as did ,x.uid as uid,y.uid as likeuid,y.ry as ry from '.$db->getTable(T_TAGS_CONTENT).'  t  left join '.$db->getTable(T_CONTENT).' x  on t.did=x.did left join  '.$db->getTable(T_LIKE).'  y on x.did=y.did and y.uid='.$userinfo['uid'].' left join '.$db->getTable(T_USERS).' z on x.uid=z.uid   where  t.tarid='.$id.' order by x.did desc limit '.$total.','.$sum
         */
$fresults = $db->query('select *,x.did as did ,x.uid as uid,y.uid as likeuid,y.ry as ry from ' . $db->getTable(T_TAGS_CONTENT) . '  t  left join ' . $db->getTable(T_CONTENT) . ' x  on t.did=x.did left join  ' . $db->getTable(T_LIKE) . '  y on x.did=y.did and y.uid=' . $userinfo['uid'] . ' left join ' . $db->getTable(T_USERS) . ' z on x.uid=z.uid   where  t.tarid=' . $id . ' order by x.did desc limit ' . $total . ',' . $sum);
if ($allcount > 0) {
    ?>
<style>
    .clist {
        margin-top: 12px;
    }

    <!--
    body {
        behavior: url(images/iehoverfix.htc);
    }

    .user_photo .photo_img {
        margin-left: -20px;
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
 <div class='clist'>


 <?php
 $fresults = APP::F('content_filter', $fresults);
    foreach ($fresults as $key => $value) {
        ?>
        <div class="wrapper clearfix" id='post_a_<?php echo $value['did']; ?>'>
            <div class="user_photo"><a class="photo_img"
                                       style="background:url('<?php  if (file_exists('avatar/i_upload/' . $value['uid'] . '_small_2.jpg')) {
                                           echo   BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small_2.jpg?id=' . rand(1110, 9900);
                                       } else if (file_exists('avatar/i_upload/' . $value['uid'] . '_small.jpg')) {
                                           echo   BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small.jpg';
                                       } else {
                                           echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                       }?>') no-repeat" href="index.php?m=ta&uid=<?php echo $value['uid'];?>"
                                       title="<?php echo $value['name'];?>"></a></div>

            <div class="c_box">
                <div class="c_b_t"></div>
                <div class="c_b_c clearfix">
                    <div class="c_msg">
                        <div class="c_act"><a class="<?php  if ($value['likeuid'] && ($value['ry'] == 2)) {
                            echo "enjoying";
                        } else if ($value['likeuid'] && ($value['ry'] == 1)) {
                            echo 'enjoyyellow';
                        } else {
                            echo 'enjoy';
                        }?>" href="javascript:submit_like('<?php echo $value['did'];?>')"
                                              id="like_button_<?php echo $value['did'];?>"
                                              title="喜欢"></a><?php  if ($value['uid'] == $userinfo['uid'] || $userinfo['uid'] == 1 || $userinfo['uid'] == 90) { ?>
                            <a href="javascript:delc('<?php echo $value['did']; ?>','<?php echo $value['types']; ?>')"
                               title="删除">删除</a><?php }?><?php  if ($value['types'] == 1 && ($value['uid'] == $userinfo['uid'] || $userinfo['uid'] == 1 || $userinfo['uid'] == 90)) { ?>
                            <a href="index.php?m=post.text&did=<?php echo $value['did'];?>" title="编辑">编辑</a><?php }?><a
                                href="index.php?m=index.recommendbao" title="轻媒体">轻媒体</a><?php if ($key == 0) { ?><a
                                id='updown' href="javascript:updownall(<?php echo $value['did'];?>)"><span
                                id='theupdownall<?php echo $value['did'];?>'>全收</span></a><?php } else { ?><a
                                id='updown' href="javascript:updown(<?php echo $value['did'];?>)"><span
                                id='theupdown<?php echo $value['did'];?>'>收起</span></a><?php }?></div>
                        <span class="user_info"><b><a style='color:#808080'
                                                      href='index.php?m=ta&uid=<?php echo $value['uid'];?>'><?php echo $value['name'];?></a>：</b><?php echo APP::F('format_time', $value['thedate']);?></span>
                    </div>

                    <h2><?php if ($value['title'] && $value['types'] == 4) { ?><img
                            src='<?php echo BASE_URL;?>css/bgimg/hi.gif'></img><?php echo $value['title']; ?><?php } else { ?>

                        <?php echo "<a href=index.php?m=show&id=" . $value['did'] . " ><strong>" . $value['title'] . "</strong></a>";
                    }?></h2>

                    <div class="text" id="text<?php echo  $value['did'];?>"><?php  if ($value['types'] == 2) { ?>
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
                                    echo  'TO <a style=color:#E47200 href=' . BASE_URL . 'index.php?m=ta&uid=' . $tme[$keys]['uid'] . ' >' . $names[0] . '</a>:' . $names[1] . '<p>';
                                } else {
                                    echo $names[0] . ":" . $names[1] . '<p>';
                                }
                            }

                            ?>
                        </div>
                        <?php } else { ?>
                        <?php echo APP::F('img_match', $value['data']); ?>
                        <?php }?></div>
                    <?php if ($value['sign'] != '' && $value['articlenum'] > 10) { ?>
                    <div class="sp_msg"><?php
                        $sign = APP::F('BBCode', $value['sign']);
                        echo $sign;
                        ?></div>
                    <?php }?>
                    <?php $gme = $db->query('select * ,x.gid as gid,y.gname as ygname,z.did as zdid from ' . $db->getTable(T_GROUP_USERS) . ' x left join ' . $db->getTable(T_GROUP_CONFIG) . ' y on x.gid=y.gid left join ' . $db->getTable(T_GROUP_CONTENT) . ' z on z.did=' . $value['did'] . ' and x.gid=z.gid where x.uid=' . $value['uid'] . ' and x.uid=' . $userinfo['uid']);
                    if ($gme) {
                        ?>
                        <dl class="tb">
                            <dt>同步到轻博群：</dt>
                            <?php
                            foreach ($gme as $gkey => $gvalue) {
                                ?>
                                <dd><input name="fol" type="checkbox"
                                           onclick='posttong(<?php echo $value['did'];?>,<?php echo $gvalue['gid'];?>)'
                                           id="aa"    <?php if ($gvalue['zdid']) { ?>checked <?php }?> ></input><a
                                        href="index.php?m=group&gid=<?php echo $gvalue['gid']; ?>"><?php echo  APP::F('cut_str', $gvalue['ygname'], 6);?></a>
                                </dd><?php }?></dl>
                        <?php }?>
                    <div class="p_c"><a class="plun" onclick="javascript:comment(<?php echo $value['did'];?>)"
                                        title="评论">评论<?php if ($value['cnum'] > 0) echo '(' . $value['cnum'] . ')';?></a><a
                            class="czt" onclick="javascript:message(<?php echo $value['did'];?>)" title="传纸条">传纸条</a><a
                            class="zf"
                            onclick="javascript:forward(<?php echo $value['did'];?>,<?php echo $value['forid'];?>)"
                            title="转发">转发</a></div>
                    <div class="fb  clearfix" id="cist_<?php echo $value['did']?>" style="display:none;">

                    </div>
                </div>

                <div class="c_b_b"></div>
                <div class="c_b_arrow"></div>
                <a href="index.php?m=show&id=<?php echo $value['did'];?>" title="<?php echo $value['name'];?>"
                   class="q_link"></a>
            </div>
        </div>
        <?php }
} ?>

</div>
   <script>
   var ids;
   var uid;
   var delid;
   function delc(id, types) {
       delid = id;
       if (confirm('确定要删除本贴')) {
           $.ajax({
               type: "GET",
               url: "index.php?m=index.del",
               data: "id=" + id + '&type=' + types,
               success: function(msg) {
                   var divcss = {display:"none"};
                   $('#post_a_' + delid).css(divcss);
               }
           });

       }
   }
   function posttong(did, gid) {
       $.ajax({
           type: "POST",
           url: "index.php?m=group.postdid",
           data: "gid=" + gid + '&did=' + did,
           success: function(msg) {

           }
       });

   }
   function tshow(id, tid) {
       if (id == 1) {
           var divcss = {display:"inline-block"};
           $('#permalink_' + tid).css(divcss);
       } else {
           var divcss = {display:"none"};
           $('#permalink_' + tid).css(divcss);
       }
   }

   function submit_like(id) {
       ids = id;
       $.ajax({
           type: "POST",
           url: "index.php?m=index.like",
           data: "id=" + id,
           success: function(msg) {

               if (msg == 'delike') {
                   $('#like_button_' + ids).removeClass('enjoyyellow');
                   $('#like_button_' + ids).addClass('enjoy');
                   // var divcss = {display:"none"};
                   //	$('#post_a_'+ids).css(divcss);
               } else if (msg == 'like') {
                   $('#like_button_' + ids).removeClass('enjoy');
                   $('#like_button_' + ids).addClass('enjoying');

               } else {
                   $('#like_button_' + ids).removeClass('enjoying');
                   $('#like_button_' + ids).addClass('enjoyyellow');
                   //var divcss = {display:"none"};
                   //$('#post_a_'+ids).css(divcss);
               }
           }
       });

   }
   var lastaction = '';
   var lastnum = 1;
   var lastnum2 = 1;
   var lastnum3 = 1;
   function comment(id) {
       ids = id;

       if ($('#cist_' + id).css('display') == 'block') {
           var divcss = {display:"none"};
           $('#cist_' + id).css(divcss);

       }
       if (lastaction == 'comment' && lastnum != 2) {
           lastnum = 2;
       } else {
           if ((lastaction != 'comment') || (lastnum == 2)) {
               lastaction = 'comment';
               lastnum = 1;

               $.ajax({
                   type: "POST",
                   url: "index.php?m=index.showcomment",
                   data: "id=" + id,
                   success: function(msg) {
                       var thetop = '<p><input type="text" id=\'textareas_' + ids + '\' class="fb_input_text" /><input type="button" onclick=\'postcomment(' + ids + ')\' class="fb_btn" value="发&nbsp;&nbsp;布" /></p>';
                       $('#cist_' + ids).html(thetop + msg)
                       var divcss = {display:"block",height:"auto"};
                       $('#cist_' + id).css(divcss);

                   }
               });
           }
       }
   }
   function forward(id, forid) {
       ids = id;
       if ($('#cist_' + id).css('display') == 'block') {
           var divcss = {display:"none"};
           $('#cist_' + id).css(divcss);
       }
       if (forid != 0) {
           id = forid;
       }
       if (lastaction == 'forward' && lastnum2 != 2) {
           lastnum2 = 2;
       } else {
           if (lastaction != 'forward' || (lastnum2 == 2)) {
               lastaction = 'forward';
               lastnum2 = 1;
               $.ajax({
                   type: "POST",
                   url: "index.php?m=index.showforward",
                   data: "id=" + id,
                   success: function(msg) {
                       var thetop = '<p><input type="text" id=\'textareas_' + ids + '\' class="fb_input_text" /><input type="button" onclick=\'postforward(' + ids + ',' + forid + ')\' class="fb_btn" value="转&nbsp;&nbsp;发" /></p>';
                       $('#cist_' + ids).html(thetop + msg)
                       var divcss = {display:"block",height:"auto"};
                       $('#cist_' + ids).css(divcss);

                   }
               });
           }
       }

   }
   function message(id) {
       ids = id;
       if ($('#cist_' + id).css('display') == 'block') {
           var divcss = {display:"none"};
           $('#cist_' + id).css(divcss);
       }
       if (lastaction == 'message' && lastnum3 != 2) {
           lastnum3 = 2;
       } else {
           if (lastaction != 'message' || (lastnum3 == 2)) {
               lastaction = 'message';
               lastnum3 = 1;
               $.ajax({
                   type: "POST",
                   url: "index.php?m=index.showmessage",
                   data: "id=" + id,
                   success: function(msg) {

                       var thetop = '<p><input type="text" id=\'textareas_' + ids + '\' class="fb_input_text" /><input type="button" onclick=\'postmessage(' + ids + ')\' class="fb_btn" value="留&nbsp;&nbsp;言" /></p>';
                       $('#cist_' + ids).html(thetop + msg)
                       var divcss = {display:"block",height:"auto"};
                       $('#cist_' + id).css(divcss);
                   }
               });
           }

       }
   }
   function postcomment(id) {
       ids = id
       var com = $('#textareas_' + id).val();
       if (com) {
           $.ajax({
               type: "POST",
               url: "index.php?m=index.showcommentadd",
               data: "id=" + id + '&com=' + com,
               success: function(msg) {
                   var divcss = {display:"none"};
                   $('#cist_' + id).css(divcss);
                   var thetop = '<p><input type="text" id=\'textareas_' + ids + '\' class="fb_input_text" /><input type="button" onclick=\'postcomment(' + ids + ')\' class="fb_btn" value="发&nbsp;&nbsp;布" /></p>';
                   $('#cist_' + ids).html(thetop + msg)
                   var divcss = {display:"block",height:"auto"};
                   $('#cist_' + id).css(divcss);
               }
           });
       }
   }

   function postmessage(id) {
       ids = id
       var com = $('#textareas_' + id).val();
       if (com) {
           $.ajax({
               type: "POST",
               url: "index.php?m=index.showmessageadd",
               data: "id=" + id + '&com=' + com,
               success: function(msg) {
                   var divcss = {display:"none"};
                   var thetop = '<p><input type="text" id=\'textareas_' + ids + '\' class="fb_input_text" /><input type="button" onclick=\'postmessage(' + ids + ')\' class="fb_btn" value="留&nbsp;&nbsp;言" /></p>';
                   $('#cist_' + ids).html(thetop + msg)
                   var divcss = {display:"block"};
                   $('#cist_' + id).css(divcss);
               }
           });
       }
   }

   function postforward(id, forid) {
       ids = id
       var com = $('#textareas_' + id).val();
       if (com) {
           if (forid != 0) {
               id = forid;
           }
           $.ajax({
               type: "POST",
               url: "index.php?m=index.showforwardadd",
               data: "id=" + id + '&com=' + com,
               success: function(msg) {
                   location.reload();
               }
           });
       }
   }

   function updown(id) {
       if ($('#text' + id).css('display') != 'none') {
           var divcss = {display:"none"};
           $('#text' + id).css(divcss);
           $('#theupdown' + id).html("展开");
       } else {
           var divcss = {display:"block"};
           $('#text' + id).css(divcss);
           $('#theupdown' + id).html("收起");
       }
   }

   function updownall(id) {
       if ($('#text' + id).css('display') != 'none') {
           $('#theupdownall' + id).html("全展");
       } else {
           $('#theupdownall' + id).html("全收");
       }
   <?php foreach ($upall as $key => $value) { ?>
       updown(<?php echo $value['did'];?>);
       <?php }?>
   }
   </script>
<?php $theurl = "index.php?m=index.tags&id=" . $id;
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



        
      