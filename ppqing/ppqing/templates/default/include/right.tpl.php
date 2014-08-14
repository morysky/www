<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 right.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$types = V('g:filter_type');
$db = APP :: ADP('db');
$Tcount = $db->query('select count(uid) as count from ' . $db->getTable(T_CONTENT) . ' where uid=' . $userinfo['uid']);
$count = $Tcount[0]['count'];
$db->query('update  ' . $db->getTable(T_USERS) . ' set articlenum=' . $count . ' where uid=' . $userinfo['uid']);

$Fcount = $db->query('select count(uid) as count from ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $userinfo['uid']);
$followcount = $Fcount[0]['count'];
$gcount = $db->query('select count(uid) as count from ' . $db->getTable(T_FOLLOWS) . ' where guid=' . $userinfo['uid']);
$fanscount = $gcount[0]['count'];
$Tcount = $db->query('select count(uid) as count from ' . $db->getTable(T_MESSAGE) . ' where touid=' . $userinfo['uid']);
$Tmecount = $Tcount[0]['count'];
$rowinfo = $db->query('select *  from ' . $db->getTable(T_USERS) . ' where uid=' . $userinfo['uid']);
$unread = $db->query('select * from ' . $db->getTable(T_UNREAD) . ' where uid=' . $userinfo['uid']);
$school = $db->query('select * from ' . $db->getTable(T_SCHOOL) . ' where uid=' . $userinfo['uid']);
$m = V('g:m');

?>
<div class="sider">
    <a href='http://www.shenpang.cc'><h2 class="sqrz">申请入住校园部</h2></a>

    <div class="sider_t"></div>
    <div class="sider_c">
        <form action="get" class="search" action="index.php">
            <input type='hidden' name='m' value='index.search'></input>
            <input type="text" name="s" class="search_input_text"/><input type="submit" class="search_btn" value=""/>
        </form>
        <ul class="userstats clearfix">

            <div id='unreads' class='unreads'>

            </div>
        </ul>
        <ul class="sider_nav">
            <li class="sn_01"><a href="<?php if ($rowinfo[0]['domname']) {
                echo BASE_URL . $rowinfo[0]['domname'];
            } else {
                echo BASE_URL; ?>index.php?m=ta&uid=<?php echo $userinfo['uid']; ?><?php }?>"
                                 title="<?php echo $userinfo['name'];?>"><strong
                    style="color:#4495c4"><?php echo APP::F('cut_str', $userinfo['name'], 8);?></strong></a></li>
            <li class="<?php if ($m == 'index.follow') {
                echo 'snbg';
            } else {
                echo 'sn_03';
            }?>"><a href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index.follow<?php } else { ?>index.php?m=index.follow<?php }?>" title="欣赏的人">欣
                赏<?php if ($followcount) {
                    echo "(" . $followcount . ")";
                }?></a></li>
            <li class="<?php if ($m == 'index.fans') {
                echo 'snbg';
            } else {
                echo 'sn_04';
            }?>"><a href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index.fans<?php } else { ?>index.php?m=index.fans<?php }?>" title="跟班">跟
                班<?php if ($fanscount) {
                    echo "(" . $fanscount . ")";
                }?></a></li>
            <li class="<?php if ($m == 'index.comments') {
                echo 'snbg';
            } else {
                echo 'sn_05';
            }?>"><a href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index.comments<?php } else { ?>index.php?m=index.comments<?php }?>" title="评论">评
                论</a></li>
            <li class="<?php if ($m == 'index.messages') {
                echo 'snbg';
            } else {
                echo 'sn_06';
            }?>"><a href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index.messages<?php } else { ?>index.php?m=index.messages<?php }?>"
                    title="私信">私信<?php if ($Tmecount) {
                echo "(" . $Tmecount . ")";
            }?></a></li>
            <li class="sn_07"><a href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.setting<?php } else { ?>index.php?m=setting<?php }?>" title="帐号设置">帐号设置</a></li>
        </ul>

        <ul class="sider_sub_nav clearfix">
            <span style="font-size:16px;color:#014A66;padding-left:20px;">按分类查看：</span>
            <br> </br>
            <li class="ssn_01"><a class="<?php if ($types == 1) echo 'active';?>" href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index?filter_type=1<?php } else { ?>index.php?m=index&filter_type=1<?php }?>"
                                  title="文本">文本</a></li>
            <li class="ssn_02"><a class="<?php if ($types == 2) echo 'active';?>" href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index?filter_type=2<?php } else { ?>index.php?m=index&filter_type=2<?php }?>"
                                  title="图片">图片</a></li>
            <li class="ssn_03"><a class="<?php if ($types == 3) echo 'active';?>" href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index?filter_type=3<?php } else { ?>index.php?m=index&filter_type=3<?php }?>"
                                  title="引用">引用</a></li>
            <li class="ssn_04"><a class="<?php if ($types == 4) echo 'active';?>" href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index?filter_type=4<?php } else { ?>index.php?m=index&filter_type=4<?php }?>"
                                  title="链接">链接</a></li>
            <li class="ssn_05"><a class="<?php if ($types == 5) echo 'active';?>" href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index?filter_type=5<?php } else { ?>index.php?m=index&filter_type=5<?php }?>"
                                  title="对话">对话</a></li>
            <li class="ssn_06"><a class="<?php if ($types == 6) echo 'active';?>" href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index?filter_type=6<?php } else { ?>index.php?m=index&filter_type=6<?php }?>"
                                  title="音乐">音乐</a></li>
            <li class="ssn_07"><a class="<?php if ($types == 7) echo 'active';?>" href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.index?filter_type=7<?php } else { ?>index.php?m=index&filter_type=7<?php }?>"
                                  title="视频">视频</a></li>
        </ul>
    </div>
    <div class="sider_b"></div>
</div>
<div class="sider rightad">
    <!--
   <a target=_blank href="index.php?m=index.tags&id=563"><img src="ad/img/zq.jpg" width="252px"></img></a>
    -->
</div>
<div class="sider">
    <h2 class="wxs">我欣赏的人</h2>

    <div class="sider_t"></div>
    <div class="sider_c clearfix">
        <ul class="uesr_list">
            <?php
            $db = APP :: ADP('db');
            $results = $db->query('select * from  ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $userinfo['uid'] . '  order by fid desc limit 12');
            foreach ($results as $key => $value) {
                ?>
                <li><a href="index.php?m=ta&uid=<?php  echo $value['guid'];?>"
                       title="<?php echo $value['gname'];?>"><img
                        src="<?php if (file_exists('avatar/i_upload/' . $value['guid'] . '_small_2.jpg')) {
                            echo BASE_URL . '/avatar/i_upload/' . $value['guid'] . '_small_2.jpg';
                        } else {
                            echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                        }?>" alt="dfdf"/></a></li>
                <?php }?>
        </ul>
    </div>
    <div class="sider_b"></div>
</div>
<!-- 服务列表 -->
<ul class="serivce_list clearfix">
    <li class="sl_01"><a href="mailto:admin@shenpang.cc" title="df">给我们提建议</a></li>
    <li class="sl_02"><a href="index.php?m=ad.job" title="df">招贤纳士，虚位以待</a></li>
    <li class="sl_03"><a href="#" title="df">合作ＱＱ:236376268</a></li>
    <li class="sl_04"><a href="http://www.shenpang.cc/phone/android/shenpang.apk" title="df">身旁网android 1.0 网站版</a></li>
</ul>
<style>
    <!--
        /**********************************提示********************************/
    .userstats {
        font-size: 14px;
        line-height: 24px;
        margin-bottom: 5px;
    }

    .userstats li.selected a {
        border: 0 none;
        color: #3B440F;
        height: 34px;
        line-height: 34px;
    }

    .userstats li.selected {
        background: url("css/bgimg/tip.gif") no-repeat;
    }

    .userstats li {
        height: 34px;
        line-height: 34px;

        width: 185px;
    }

    .userstats a {
        color: #C4CDD6;
    }

    .rightad {
        padding-bottom: 20px;
    }

    -->
</style>
<script>
    function unshow() {
        $.ajax({
            type: "POST",
            url: "index.php?m=index.unreads",
            success: function(msg) {

                $('#unreads').html(msg);
            }
        });
    }
    setInterval("unshow()", 3000);
</script>