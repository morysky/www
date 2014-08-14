<?php 
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 index.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$SPconfig = unserialize(SPCONFIG);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL;?>css/base.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div class='headerL'><img src="<?php echo BASE_URL;?>css/logo.gif"></img><b
        style="color:#ffffff;margin-bottom:6px;font-size:38px">简单实用的轻微博社区</b></div>
<div class='mainL'>
    <div class='showlogin'>
        <div style='padding:20px;padding-left:100px;'>
            <form method='post'>

                <?php if ($data) { ?>
                <b style="color:3B5269;font-size:18px;float:left;width:265px;text-align:left;padding-top:6px;"><?php echo $data;?></b><p>
<a style="color:3B5269;font-size:18px;float:left;width:265px;text-align:left;padding-top:6px;"
   href="index.php?m=account.login">返回登录</a>
                <?php } else { ?>

                <?php }?>
            </form>
        </div>
    </div>
</div>
<div class='footerL'></div>
</body>
</html>