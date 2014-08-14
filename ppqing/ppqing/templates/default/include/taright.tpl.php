<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 taright.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$guid = $SPuid;
$m = V('g:m');
$db = APP :: ADP('db');
$Tcount = $db->query('select count(uid) as count from ' . $db->getTable(T_CONTENT) . ' where uid=' . $guid);
$count = $Tcount[0]['count'];
$Fcount = $db->query('select count(uid) as count from ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $guid);
$followcount = $Fcount[0]['count'];
$checkFollow = $db->query('select * from ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $userinfo['uid'] . ' and guid=' . $guid);
$thinfo = $db->query('select * from ' . $db->getTable(T_USERS) . '  where uid=' . $guid);
$rowinfo = $db->query('select *  from ' . $db->getTable(T_USERS) . ' where uid=' . $guid);
?>

<div class='newavatar'>
    <a href='index.php?m=ta&uid=<?php echo $guid;?>'><img width='140px' style=' padding:3px; border:1px solid #A1A1A1;'
                                                          src='<?php if (file_exists('avatar/i_upload/' . $guid . '_small_2.jpg')) {
                                                              echo BASE_URL . '/avatar/i_upload/' . $guid . '_small_2.jpg?id=' . rand(1110, 9900);
                                                          } else {
                                                              echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                                                          }?>'></img></a>
</div>
<div class='tadescs'>
    <b style='color:#666666;font-size:18px'>我叫: <?php echo $thinfo[0]['name'];?></b>
</div>
<div class='tadescs'>
    <?php echo $thinfo[0]['descs'];?>
</div>
<div style="padding-top:0; padding-left:0;" class="dashboard_nav_item">
    <ul class="dashboard_subpages">
        <!-- URL -->
        <li><a href="<?php if ($rowinfo[0]['domname']) {
            echo $rowinfo[0]['domname'];
        } else { ?>index.php?m=ta&uid=<?php echo $guid; ?><?php }?>"><span
                class="icon dashboard_controls_open"></span><?php echo $thinfo[0]['name'];?>的轻博客</a></li>

        <!-- Posts -->
        <li><a class="" href="index.php?m=ta&uid=<?php echo $guid;?>"><span
                class="icon dashboard_controls_posts"></span>文章 <?php if ($count) {
            echo "(" . $count . ")";
        }?></a>
        </li>

        <!-- Followers -->

        <!-- Members -->

        <!-- Messages -->


        <!-- Drafts -->
        <li><a class="" href="index.php?m=ta.tafollow&id=<?php echo $guid;?>"><span
                class="icon dashboard_controls_drafts"></span>我欣赏的人<?php if ($followcount) {
            echo "(" . $followcount . ")";
        }?></a></li>

        <!-- Transcoding video -->


    </ul>
</div>
<div style="padding-top:0; padding-left:0;" class="dashboard_nav_item2">
    <div style="height:10px;"></div>
    <b style='padding-top:18px;padding-bottom:18px'>欣赏的人</b>

    <p>

    <div style="height:10px;"></div>
    <?php 
    $db = APP :: ADP('db');
    $results = $db->query('select * from  ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $guid . ' limit 15');
    foreach ($results as $key => $value) {
        ?>
        <div style="width:54px;float:left;margin:2px;">
            <a href='index.php?m=ta&uid=<?php  echo $value['guid'];?>'><img title=<?php echo $value['gname'];?>  style='width:48px;
                background:#ffffff;border:2px solid #ffffff;'
                src="<?php if (file_exists('avatar/i_upload/' . $value['guid'] . '_small_2.jpg')) {
                    echo BASE_URL . '/avatar/i_upload/' . $value['guid'] . '_small_2.jpg';
                } else {
                    echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                }?>"></img></a>

            <p>
        </div>
        <?php }?>
</div>