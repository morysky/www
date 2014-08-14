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
    <link href="<?php echo BASE_URL;?>css/edit.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.js"></script>
    <style type="text/css">
        <!--
        body, td, th {
            font-family: Arial, Helvetica, sans-serif;
            color: #999999;
        }

        input[type="checkbox"] {
            height: 12px;
            line-height: 12px;
        }

        -->
    </style>
    <script type="text/javascript" language="javascript">
        <!--
        function getCookie(name){
          var arr=document.cookie.match(new RegExp("(^| )"+name+"=([^;]*)(;|$)"));
          if(arr!=null && arr!=false) return decodeURIComponent(arr[2]);
          return false;
        }
        window.onload=function(){
          var screenshotsImg=getCookie('162100screenshotsImgSmall');
          var screenshotsSrc=screenshotsImg!=false?screenshotsImg:'./i_upload/default.gif'
          if(document.getElementById('screenshotsShow')!=null){
            document.getElementById('screenshotsShow').innerHTML='<img src="'+screenshotsSrc+'" />';
          }
        }
        -->
    </script>
</head>
<body>
<?php 
$userinfo = USER::get('userinfo');
setcookie('sppicavater', $userinfo['uid']);

?>


<div id='text_post' class='text_post'>
    <center>
        <table width="100%" border="0" cellspacing="20" cellpadding="0">
            <tr>
                <td width="50%" align="right">
                    <iframe src="<?php echo BASE_URL;?>/avatar/start.html?id=Math.random()" width="322" height="277"
                            frameborder="0" scrolling="no"></iframe>
                </td>
                <td width="50%" align="left">
                    <div class="fgman" style='font-size:14px;color:#616161;'>


                    </div>
                </td>
            </tr>
        </table>
    </center>
</div>
<style>
    .fgman br {
        line-height: 4px;
        height: 4px;
        font-size: 4px;
    }

    .fgman span {
        float: left;
        padding-top: 2px;
        margin-left: 4px;
        width: 86px;

    }

    .fgman img {
        width: 58px;
        border: 2px solid #bfbfbf;
        padding: 1px;
    }

    html {
        background: #ffffff;
    }

    body {
        background: #ffffff;
    }

    .text_post {
        font-size: 11px;
        background: #ffffff;
    }
</style>

<script>
    function tafollow(uid) {
        $.ajax({
            type: "POST",
            url: "index.php?m=ta.ajaxfollow",
            data: "uid=" + uid,
            success: function(msg) {
                $('#tafol' + uid).html('<a style="margin:4px; color:#313131;"  href="javascript:tadelfollow(' + uid + ')">取消欣赏</a>');
            }
        });

    }

    function tadelfollow(uid) {
        if ($('#gpic' + uid).attr("checked")) {
            $.ajax({
                type: "POST",
                url: "index.php?m=ta.ajaxfollow",
                data: "uid=" + uid,
                success: function(msg) {
                    //  $('#tafol'+uid).html('<a style="margin:4px; color:#313131;"  href="javascript:tadelfollow('+uid+')">取消欣赏</a>');
                }
            });
        } else {

            $.ajax({
                type: "POST",
                url: "index.php?m=ta.ajaxdelfollow",
                data: "uid=" + uid,
                success: function(msg) {
                    //alert('sdf');
                    //$('#tafol'+uid).html('<a style="margin:4px; color:#313131;"  href="javascript:tafollow('+uid+')">欣赏他（她）</a>');
                }
            });
        }


    }
</script>
</body>
</html>