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
    <style type="text/css">
        <!--
        body, td, th {
            font-family: Arial, Helvetica, sans-serif;
            color: #999999;
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
            document.getElementById('screenshotsShow').innerHTML='<img src="'+screenshotsSrc+'?id='+Math.random()+'" />';
          }
        }
        -->
    </script>
    <?php TPL::plugin('include/tophead');?>
</head>
<body>

<?php TPL::plugin('include/header');?>
<?php 
$userinfo = USER::get('userinfo');

?>
<div id='container'>
    <img id="content_top" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_top_edit_form.png?alpha">

    <div id='content' class='content'>
        <div id='right_column'>
            <?php TPL::plugin('include/setright');?>
        </div>
        <div id='left_column'>
            <div id='text_post'>
                <b style="color:#313131;font-size:16px;">修改头像</b>


                <center>
                    <p>&nbsp;</p>

                    <p>&nbsp;</p>
                    <table style='background:#e1e1e1; border:6px solid #d1d1d1;' width="100%" border="0"
                           cellspacing="20" cellpadding="0">
                        <tr>
                            <td width="50%" align="right">
                                <iframe src="<?php echo BASE_URL;?>avatar/start.html" width="322" height="277"
                                        frameborder="0" scrolling="no"></iframe>
                            </td>
                            <td width="50%" align="left">
                                原头像：<p>
                                <img style=" margin:10px; padding:2px;border:1px solid #616161"
                                     src="<?php echo BASE_URL;?>/avatar/i_upload/<?php  echo $userinfo['uid']; ?>_small.jpg?id="<?php echo rand(1110, 9900);?>></img>

                            </td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <img id="content_bottom" alt="" src="<?php echo BASE_URL;?>css/bgimg/content_bottom_edit_form.png?alpha">
</div>

<?php TPL::plugin('include/infooter2');?>
</body>
</html>