<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 header.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$m = V('g:m');

?>



<!-- 头部开始 -->
<div class="header">
    <div class="contentdiv">
        <a href='<?php if (PPREWRITE == 1) {
            echo BASE_URL; ?>m.index<?php } else { ?>index.php<?php }?>'><h1 class="logo">身旁网</h1></a>

        <div class="header_R">
            <p class="user_msg"><a class="esc" href="<?php if (PPREWRITE == 1) {
                echo BASE_URL; ?>m.account.logout<?php } else { ?>index.php?m=account.logout<?php }?>" title="退出">退出</a>
                <a style='color:#ffffff' href="<?php if (PPREWRITE == 1) {
                    echo BASE_URL; ?>m.ad.about<?php } else { ?>index.php?m=ad.about<?php }?>">关于</a> <a
                        class="yq_friend" href="<?php if (PPREWRITE == 1) {
                    echo BASE_URL; ?>m.index.invate<?php } else { ?>index.php?m=index.invate<?php }?>"
                        title="邀请好友">邀请好友</a></p>
            <!-- 主导航 -->
            <ul class="main_nav">
                <li  <?php if ($m == '' || $m == 'index') { ?> class="current"<?php }?>><a
                        href="<?php if (PPREWRITE == 1) {
                            echo BASE_URL; ?>m.index<?php } else { ?>index.php?m=index<?php }?>" title="首页">首&nbsp;&nbsp;&nbsp;页</a>
                </li>
                <li <?php if ($m == 'index.tagexplore') { ?>class="current"<?php }?>><a
                        href="<?php if (PPREWRITE == 1) {
                            echo BASE_URL; ?>m.index.tagexplore<?php } else { ?>index.php?m=index.tagexplore<?php }?>"
                        title="标签客厅">标签客厅</a></li>
                <li <?php if ($m == 'index.newblog') { ?>class="current"<?php }?>><a href="<?php if (PPREWRITE == 1) {
                    echo BASE_URL; ?>m.index.newblog<?php } else { ?>index.php?m=index.newblog<?php }?>" title="新进轻博">新进轻博</a>
                </li>
                <li <?php if ($m == 'index.wall') { ?> class="current"<?php }?>><a target=blank
                                                                                   href="<?php if (PPREWRITE == 1) {
                                                                                       echo BASE_URL; ?>m.index.wall<?php } else { ?>index.php?m=index.wall<?php }?>"
                                                                                   title="图片墙">图片墙</a></li>
                <li <?php if ($m == 'index.recommend' || $m == 'index.recommendqun') { ?>class="current"<?php }?>><a
                        href="<?php if (PPREWRITE == 1) {
                            echo BASE_URL; ?>m.index.recommend<?php } else { ?>index.php?m=index.recommend<?php }?>"
                        title="推荐轻应用">推荐轻应用<span class="new">new</span></a></li>
            </ul>
        </div>
    </div>
</div>



