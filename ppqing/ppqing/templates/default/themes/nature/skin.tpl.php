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
    <?php TPL::plugin('themes/nature/topcontainer', array('SPuid' => $SPuid));?>
    <div id='content' class='content'>
        <div id='right_column'>
            <?php
            $m = V('g:m');
            $checkFollow = $db->query('select *  from ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $userinfo['uid'] . ' and guid=' . $guid);
            ?>
            <?php if (($guid != $userinfo['uid']) && $userinfo && ($m == 'ta')) { ?>
            <div>
                <a style="margin:4px; padding:4px; border:2px solid #d1d1d1;background:#919191;color:#212121;"
                   href="index.php?m=post.recomadd&guid=<?php  echo $guid;?>">推荐</a>
                <?php if (!$checkFollow) { ?>
                <a style="margin:4px; padding:4px; border:2px solid #d1d1d1;background:#919191;color:#212121;"
                   href='index.php?m=ta.follow&uid=<?php  echo $guid;?>'>欣赏TA</a>
                <?php } else { ?>
                <a style="margin:4px; padding:4px; border:2px solid #d1d1d1;background:#919191;color:#212121;"
                   href="index.php?m=ta.delfollow&uid=<?php  echo $guid;?>">取消欣赏</a>
                <?php } ?>
                <div style="height:30px;"></div>
            </div><?php }?>
            <div class='newavatar'>
                <a href='<?php if (PPREWRITE == 1) {
                    echo BASE_URL, "m.ta?uid=" . $uid;
                } else {
                    echo "index.php?m=ta&uid=" . $uid;
                }?>'><img style="width:expression(this.width > 160 ? '160px' : this.width);max-width:160px;"
                          src='<?php  if (file_exists('avatar/i_upload/' . $uid . '_small_2.jpg')) {
                              echo BASE_URL . '/avatar/i_upload/' . $uid . '_small_2.jpg';
                          } else if (file_exists('avatar/i_upload/' . $uid . '_small.jpg')) {
                              echo BASE_URL . '/avatar/i_upload/' . $uid . '_small.jpg';
                          } else {
                              echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                          }?>'></img></a>
            </div>

            <div class='tadescs'>
                <?php echo $thinfo[0]['descs'];?>
            </div>
            <div style='padding-top:24px;'>
                <?php
                $db = APP :: ADP('db');
                $results = $db->query('select * from  ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $uid . ' limit 12');
                foreach ($results as $key => $value) {
                    ?>
                    <div class='otherimg'>
                        <a href='index.php?m=ta&uid=<?php  echo $value['guid'];?>'><img
                                title=<?php echo $value['gname'];?>  style='width:48px; padding:2px;
                            background:#ffffff;'
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
        <div id='left_column'>

            <?php TPL::plugin('themes/nature/taitems', array('SPuid' => $SPuid));?>
        </div>
        <div class="clear"></div>
    </div>
</div>
