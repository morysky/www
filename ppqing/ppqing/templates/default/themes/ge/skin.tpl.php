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


<div id='container'>
    <?php TPL::plugin('themes/ge/topcontainer', array('SPuid' => $SPuid));?>
    <div id='content' class='content'>
        <div id='right_column'>
            <?php TPL::plugin('themes/ge/taitems2', array('SPuid' => $SPuid));?>
        </div>
        <div id='left_column'>

            <?php TPL::plugin('themes/ge/taitems', array('SPuid' => $SPuid));?>
        </div>
        <div class="clear"></div>
    </div>
</div>
