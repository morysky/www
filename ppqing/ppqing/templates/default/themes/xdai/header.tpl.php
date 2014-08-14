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
<div id='face' style='display:none'>
    <?php TPL::plugin('include/face');?>
</div>
<?php if ($userinfo) { ?>
<div style="ftext-shadow:none;" id="site_notice">
    <div id='right'>
        <a href='<?php if (USER::get('spschool') == 1) {
            echo  'index.php?m=school';
        } else {
            echo 'index.php';
        }?>'>首页</a> | <a href='index.php?m=account.logout'>退出</a> <?php if ($m == 'ta') { ?>| <a
            href='javascript:setface(1)'>换肤</a> | <a href='javascript:location.reload() '>刷新模板</a><?php }?>
    </div>
</div>
<?php } ?>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>/js/face.js"></script>

