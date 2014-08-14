<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 setright.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$Tm = V('g:m');
?>
<link href="<?php echo BASE_URL;?>css/edit.css" rel="stylesheet" type="text/css"/>
<div style="padding-top:0; padding-left:0; color:#313131;font-size:18px;" class="dashboard_nav_items">
    <div class='setitem'><a <?php if ($Tm == 'setting') {
        echo 'class=astyle';
    }?> href='<?php if (PPREWRITE == 1) {
        echo BASE_URL; ?>m.setting<?php } else { ?>index.php?m=setting<?php }?>'>个人资料修改</a></div>
    <div class='setitem'><a <?php if ($Tm == 'setting.setpic') {
        echo 'class=astyle';
    }?>  href='<?php if (PPREWRITE == 1) {
        echo BASE_URL; ?>m.setting.setpic<?php } else { ?>index.php?m=setting.setpic<?php }?>'>修改头像</a></div>
    <div class='setitem'><a <?php if ($Tm == 'setting.domname') {
        echo 'class=astyle';
    }?>  href='<?php if (PPREWRITE == 1) {
        echo BASE_URL; ?>m.setting.domname<?php } else { ?>index.php?m=setting.domname<?php }?>'>个性化域名</a></div>
    <div class='setitem'><a <?php if ($Tm == 'setting.password') {
        echo 'class=astyle';
    }?>  href='<?php if (PPREWRITE == 1) {
        echo BASE_URL; ?>m.setting.password<?php } else { ?>index.php?m=setting.password<?php }?>'>修改密码</a></div>
    <div class='setitem'><a <?php if ($Tm == 'setting.setgroupadmin') {
        echo 'class=astyle';
    }?>  href='<?php if (PPREWRITE == 1) {
        echo BASE_URL; ?>m.setting.setgroupadmin<?php } else { ?>index.php?m=setting.setgroupadmin<?php }?>'>轻博群管理</a>
    </div>
    <div class='setitem'><a <?php if ($Tm == 'setting.setschool') {
        echo 'class=astyle';
    }?>  href='<?php if (PPREWRITE == 1) {
        echo BASE_URL; ?>m.setting.setschool<?php } else { ?>index.php?m=setting.setschool<?php }?>'>校园部申请</a></div>
</div>
<style>
    .astyle {
        color: #A97912;
        font-weight: bold;
    }

    .setitem {
        margin-top: 18px;
    }
</style>
    
  