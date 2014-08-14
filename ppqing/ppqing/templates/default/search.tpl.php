<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
    <link href="<?php echo BASE_URL;?>css/show.css" rel="stylesheet" type="text/css"/>
    <?php TPL::plugin('include/tophead');?>
</head>
<body>
<?php TPL::plugin('include/header');?>
<div id='container'>
    <div id='content' class='content'>
        <div id='right_column'>
            <?php TPL::plugin('include/right');?>
        </div>
        <div id='left_column'>
            <div class='searchlist'>
                <span>搜索:</span></span><span id='s1'><a style='color:#A67610'
                                                        href='javascript:searchshow(1)'>用户</a></span><span id='s2'><a
                    href='javascript:searchshow(2)'>标签</a></span><span id='s3'><a href='javascript:searchshow(3)'>内容</a></span>
            </div>
            <?php TPL::plugin('include/searchlist');?>
        </div>
        <div class="clear"></div>
    </div>
</div>

<script>
    function searchshow(id) {
        if (id == 1) {
            var divcssl = {color:"#A67610"};
            var divcssr = {color:"#244565"};
            var divcss1 = {display:""};
            var divcss2 = {display:"none"};
            $('#s3 a').css(divcssr);
            $('#s2 a').css(divcssr);
            $('#s1 a').css(divcssl);
            $('#searchlist_1').css(divcss1);
            $('#searchlist_2').css(divcss2);
            $('#searchlist_3').css(divcss2);
        } else if (id == 2) {
            var divcssl = {color:"#A67610"};
            var divcssr = {color:"#244565"};
            var divcss1 = {display:""};
            var divcss2 = {display:"none"};
            $('#s3 a').css(divcssr);
            $('#s2 a').css(divcssl);
            $('#s1 a').css(divcssr);
            $('#searchlist_1').css(divcss2);
            $('#searchlist_2').css(divcss1);
            $('#searchlist_3').css(divcss2);
        } else {
            var divcssl = {color:"#A67610"};
            var divcssr = {color:"#244565"};
            var divcss1 = {display:""};
            var divcss2 = {display:"none"};
            $('#s3 a').css(divcssl);
            $('#s2 a').css(divcssr);
            $('#s1 a').css(divcssr);
            $('#searchlist_1').css(divcss2);
            $('#searchlist_2').css(divcss2);
            $('#searchlist_3').css(divcss1);
        }

    }
</script>
<?php TPL::plugin('include/infooter2');?>
</body>
</html>