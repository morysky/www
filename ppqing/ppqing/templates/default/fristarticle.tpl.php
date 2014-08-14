<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 text.tpl.php
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


<form name="form1" id="form1" method="post" action="index.php?m=post.fristtextadd">

    <div id='text_post'>

        <?php
        $msg = USER::get('msg');
        if ($msg) echo $msg;
        ?>
        <h3>标题 </h3>

        <div class="text_field_container"><input type="text" value="" name="title" id="post_one"
                                                 class="text_field big wide"></input></div>
        <div style="height:4px;"></div>
        <h3>内容</h3>

        <div style="height:2px;"></div>
        <textarea name="content" id="post_two" style="height:180px;" class="wide"></textarea>

        <div style="width:600px; float:left; padding: 5px 0 5px 30px;" id="left_column">
            <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                    id="save_button" class="positive" type="submit">
                <img alt="" src="http://assets.tumblr.com/images/check.png">
                <span id="create_post_button_label">发布</span>
            </button>

        </div>
    </div>
    </div>
</form>
<style>
    html {
        background: #ffffff;
    }

    body {
        background: #ffffff;
    }

    #text_post {
        padding-top: 30px;
        color: #616161;
        background: #ffffff;
    }

    .wide {
        max-width: 504px;
        min-width: 504px;
        width: 504px;
    }
</style>


</body>
</html>