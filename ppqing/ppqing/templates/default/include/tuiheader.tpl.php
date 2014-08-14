<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 tuiheader.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
?>
<div class="inner">
    <ul id="secnav">
        <li><a href="<?php if (PPREWRITE == 1) {
            echo BASE_URL; ?>m/index.recommend<?php } else { ?>index.php?m=index.recommend<?php }?>">轻博客推荐<br>
            <span>优秀的轻博客</span></a></li>
    </ul>
</div>


