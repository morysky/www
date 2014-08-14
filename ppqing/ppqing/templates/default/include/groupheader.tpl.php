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

<script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>/js/face.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>/js/color.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.lightbox-0.5.js"></script>
<?php if (!$userinfo || $userinfo == '') { ?>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/back.js"></script>   <?php } ?>
<script type="text/javascript" src="<?php echo BASE_URL;?>ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/css/jquery.lightbox-0.5.css" media="screen"/>


<script>
    function postcss() {
        var nowColor1url = $('#nowColor1url').val();
        var nowColor2url = $('#nowColor2url').val();
        var nowColor3url = $('#nowColor3url').val();
        var nowColor4url = $('#nowColor4url').val();
        var nowColor5url = $('#nowColor5url').val();
        var nowColor6url = $('#nowColor6url').val();

        var nowColor1 = $('#nowColor1').val();
        var nowColor2 = $('#nowColor2').val();
        var nowColor3 = $('#nowColor3').val();
        var nowColor4 = $('#nowColor4').val();
        var nowColor5 = $('#nowColor5').val();
        var nowColor6 = $('#nowColor6').val();
        var mycss = $('#mycss').val();

        $.ajax({
            type: "POST",
            url: "index.php?m=index.postcss",
            data: 'nowColor1url=' + nowColor1url + '&nowColor2url=' + nowColor2url + '&nowColor3url=' + nowColor3url + '&nowColor4url=' + nowColor4url + '&nowColor5url=' + nowColor5url + '&nowColor6url=' + nowColor6url + '&nowColor1=' + nowColor1 + '&nowColor2=' + nowColor2 + '&nowColor3=' + nowColor3 + '&nowColor4=' + nowColor4 + '&nowColor5=' + nowColor5 + '&nowColor6=' + nowColor6 + '&mycss=' + mycss,
            success: function(msg) {
                alert(msg);
            }
        });

    }
</script>
