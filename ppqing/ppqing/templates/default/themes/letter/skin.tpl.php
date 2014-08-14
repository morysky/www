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


    <div id='wrap'>
        <div class="glow"></div>
        <div id="about">

            <div class="about-top"></div>
            <!-- END .about-top -->
            <div class="about-content">

                <div class='newavatar'>
                    <a href='<?php if (PPREWRITE == 1) {
                        echo BASE_URL, "m.ta?uid=" . $uid;
                    } else {
                        echo "index.php?m=ta&uid=" . $uid;
                    }?>'><img
                            style="width:expression(this.width > 160 ? '160px' : this.width);max-width:160px;border:4px solid #dfdfdf;"
                            src='<?php if (file_exists('avatar/i_upload/' . $guid . '_small.jpg')) {
                                echo BASE_URL . '/avatar/i_upload/' . $guid . '_small.jpg';
                            } else {
                                echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                            }?>'></img></a>
                </div>
                <h2><a href="<?php if ($thinfo[0]['domname']) {
                    echo $thinfo[0]['domname'];
                } else { ?>index.php?m=ta&uid=<?php echo  $thinfo[0]['uid']; ?><?php }?>"
                       class="about-user-name"><?php echo $thinfo[0]['name'];?></a></h2>

                <div id="user-contribute">
                    <?php echo $thinfo[0]['descs'];?>
                </div>
            </div>
            <!-- END .about-content -->
            <div class="about-bottom"></div>
            <!-- END .about-bottom -->
        </div>
        <?php TPL::plugin('themes/letter/taitems', array('SPuid' => $SPuid));?>
    </div>
    <div style='color:#ffffff'>
        我欣赏的轻博客
    </div>
    <div class="othimages">

        <?php
        $db = APP :: ADP('db');
        $results = $db->query('select * from  ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $uid . ' limit 12');
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
    </div>
</div>
