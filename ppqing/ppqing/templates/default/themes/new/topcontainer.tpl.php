<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 header.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/

$uid = $SPuid;
$db = APP :: ADP('db');
$thinfo = $db->query('select * from ' . $db->getTable(T_USERS) . '  where uid=' . $uid);
?>
<div id='header'>
    <a style='font-size: 36px; color:#ffffff;padding:6px; '
       href='index.php?m=ta&uid=<?php echo $uid;?>'><?php echo $thinfo[0]['name'];?></a>
</div>
<style>
    #header img {
        border: 0px;
    }
</style>
