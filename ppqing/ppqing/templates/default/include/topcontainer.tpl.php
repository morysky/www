<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 header.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$m = V('g:m');
?>
<div id='header'>
    <a href='index.php?m=index'><img width="220px" id="logo" alt="shenpang"
                                     src="<?php echo BASE_URL;?>css/logo.gif"></a>

    <div id="nav">
        <a class="nav_item <?php if ($m == '') { ?> active<?php }?>" href="<?php if (USER::get('spschool') == 1) {
            echo  'index.php?m=school';
        } else {
            echo 'index.php';
        }?>">
            <div><b>首页</b></div>

            <div class="nav_item_nipple">
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_1"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_2"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_3"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_4"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_5"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_6"></div>
            </div>
        </a>

        <a class="nav_item <?php if ($m == 'index.tagexplore') { ?> active<?php }?>"
           href="index.php?m=index.tagexplore">
            <div><b>标签客厅</b></div>
            <div class="nav_item_nipple">
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_1"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_2"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_3"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_4"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_5"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_6"></div>
            </div>
        </a>

        <a class="nav_item <?php if ($m == 'index.newblog') { ?> active<?php }?>" href="index.php?m=index.newblog">
            <div><b>新进轻博</b></div>
            <div class="nav_item_nipple">
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_1"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_2"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_3"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_4"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_5"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_6"></div>
            </div>
        </a>
        <a class="nav_item <?php if ($m == 'index.wall') { ?> active<?php }?>" href="index.php?m=index.wall">
            <div><b>发现</b></div>
            <div class="nav_item_nipple">
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_1"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_2"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_3"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_4"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_5"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_6"></div>
            </div>
        </a>
        <a class="nav_item <?php if ($m == 'index.recommend' || $m == 'index.recommendqun') { ?> active<?php }?>"
           href="index.php?m=index.recommend">
            <div><b>推荐轻博</b></div>
            <div class="nav_item_nipple">
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_1"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_2"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_3"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_4"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_5"></div>
                <div class="nav_item_nipple_pixel nav_item_nipple_pixel_6"></div>
            </div>
        </a>

        <a class="nav_item " style='color:#D2AA08' href="index.php?m=index.invate">
            <img src='css/bgimg/invate.jpg'>邀请好友
        </a>

    </div>
</div>
<style>
    #header img {
        border: 0px;
    }
</style>
