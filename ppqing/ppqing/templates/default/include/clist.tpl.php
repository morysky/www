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
$rows = $db->query('select count(uid) as count from ' . $db->getTable(T_COMMENTS) . '  where did=' . $cid);
$allcount = $rows[0]['count'];
$cresults = $db->query('select * ,x.uid as uid,z.name as zname  from ' . $db->getTable(T_COMMENTS) . ' x left join ' . $db->getTable(T_USERS) . ' z on x.reuid=z.uid  where x.did=' . $cid . ' order by x.cid desc limit ' . $total . ',' . $sum);
$cresults = APP::F('content_filter', $cresults);
if ($allcount > 0) {
    ?>
<div class='clist'>
    <span style='padding-left:40px;color:#373737;'>有（<?php echo $allcount;?>）人来评论过</span>
    <ol id='cposts'>
        <?php   foreach ($cresults as $ckey => $cvalue) { ?>
        <li>
            <img src='<?php if (file_exists('avatar/i_upload/' . $cvalue['uid'] . '_small.jpg')) {
                echo BASE_URL . '/avatar/i_upload/' . $cvalue['uid'] . '_small.jpg';
            } else {
                echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
            }?>' width='24px'></img>
            <?php echo '<a  style=color:#AB810F href=' . BASE_URL . 'index.php?m=ta&uid=' . $cvalue['uid'] . '>' . $cvalue['uname'] . '</a>:' . ($cvalue['zname']
                ? '(回复:<a href=index.php?m=ta&uid=' . $cvalue['reuid'] . '>' . $cvalue['zname'] . '</a>)'
                : '') . '' . $cvalue['cdata'] . '--(' . APP::F('format_time', $cvalue['cdate']) . ')   <a href=' . BASE_URL . 'index.php?m=show&id=' . $cvalue['did'] . '&reuid=' . $cvalue['uid'] . '>' . "<img  style='border:0px' src='css/bgimg/replay.gif'></img>" . '</a>';?><?php if ($userinfo['uid'] == $cvalue['uid']) {
            echo '  <a href=' . BASE_URL . 'index.php?m=post.cdel&cid=' . $cid . '&id=' . $cvalue['cid'] . '>' . "<img  style='border:0px' src='css/bgimg/del.gif'></img>" . '</a>';
        }?>
        </li>
        <?php }?>
    </ol>

</div>
<?php } ?>
<?php $theurl = "index.php?m=show&id=" . $cid; ?>
<div class="page"><?php if ($allcount > $sum) {
    if ($page == 1) { ?><span class='pagea'><a
            href="<?php echo  $theurl . "&page=" . ($page + 1);?>">下一页</a></span><?php } else if (($page * $sum) > $allcount) { ?>
        <span class='pagea'><a href="<?php echo  $theurl . "&page=1";?>">首页</a></span> |<span class='pagea'><a
                href="<?php echo  $theurl . "&page=" . ($page - 1);?>">上一页</a></span><?php } else { ?><span
            class='pagea'><a href="<?php echo  $theurl . "&page=1";?>">首页</a></span> |<span class='pagea'><a
            href="<?php echo  $theurl . "&page=" . ($page - 1);?>">上一页</a></span> |<span class='pagea'> <a
            href="<?php echo  $theurl . "&page=" . ($page + 1);?>">下一页</a></span><?php }
}?></div>

        
      