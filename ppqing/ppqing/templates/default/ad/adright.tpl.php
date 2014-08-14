<style>
    .adrightcss {
        font-size: 16px;
        color: #313131;

    }

    .adrightcss li {
        padding-top: 12px;
        padding-left: 12px;
        line-height: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #d1d1d1;
    }

    .current {
        font-weight: bold;
    }
</style>
<?php $m = V('g:m');
?>
<ul class='adrightcss'>
    <li><a href='index.php?m=ad.about' <?php if ($m == 'ad.about') { ?>class="current"<?php }?>>关于身旁网</a></li>
    <li><a href='http://www.shenpang.cc/index.php?m=ad.team' <?php if ($m == 'ad.team') { ?>class="current"<?php }?>>团队风采</a></li>
    <li><a href='http://www.shenpang.cc/index.php?m=ad.job' <?php if ($m == 'ad.job') { ?>class="current"<?php }?>>招贤纳士</a></li>
    <li><a href='http://www.shenpang.cc/index.php?m=ad.home' <?php if ($m == 'ad.home') { ?>class="current"<?php }?>>身旁网的家</a></li>
    <li><a href='http://www.shenpang.cc/index.php?m=ad.link' <?php if ($m == 'ad.link') { ?>class="current"<?php }?>>联系我们</a></li>
    <li><a href='http://www.shenpang.cc/index.php?m=ad.qqqun' <?php if ($m == 'ad.qqqun') { ?>class="current"<?php }?>>身旁兴趣群</a></li>
</ul>