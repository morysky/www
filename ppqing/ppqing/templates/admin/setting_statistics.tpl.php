<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>站点设置--power by 身旁网&拍旁轻博客</title>
    <link href="<?php echo BASE_URL;?>css/admin.css" rel="stylesheet" type="text/css"/>
    <script type='text/javascript' src='<?php echo BASE_URL;?>js/jquery.min.js'></script>
    <script type='text/javascript' src='<?php echo BASE_URL;?>js/admin_lib.js'></script>
    <script>
        window.onload = function() {
            $('#preview_loading').hide();
        }


        function preview(o) {
            $('#preview_loading').show();
            $('#logo_form').submit();
        }

        function uploadFinished(state, url) {
            $('#logo_form').get(0).reset();

            $('#preview_loading').hide();
            if (state != '200') {
                alert(state);
                return;
            }
            $('#logo_preview').attr('src', url);
            $('#logo').val(url);

        }
    </script>
</head>
<body>
<?php 
$aid = USER::aid();
$db = APP :: ADP('db');
$settings = $db->query('select * from ' . $db->getTable(T_SETTING));
foreach ($settings as $key => $value) {
    $setting[$value['name']] = $value['value'];
}
?>
<div class="main-wrap">
    <div class="path"><span class="path-icon"></span>当前位置：功能设置<span> &gt; </span>网站统计设置</div>
    <div class="set-wrap">
        <form action="" name="form1" method="post" id="this_form">
            <div class="wrap-inner">
                <h4 class="main-title">网站统计设置</h4>

                <div class="set-area-int">

                    <div class="site-info-b">
                        <label for="statistics">
                            <p>网站第三方统计代码：</p>
                            <textarea name="statistics" class="input-box site-box-area" cols="10"
                                      rows="10"><?php echo $setting['statistics']; ?></textarea>
                        </label>
                    </div>
                </div>
            </div>
        </form>
        <div style='clear:both;height:20px'></div>
        <div class="button button-position"><input type="submit" id="submitBtn" name="保存修改" value="保存修改"/></div>
    </div>
</div>
<script type="text/javascript">
    var valid = new Validator({
        form: '#this_form',
        trigger: '#submitBtn'
    });
</script>
</body>
</html>
