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
    <div class="path"><span class="path-icon"></span>当前位置：功能设置<span> &gt; </span>核心设置</div>
    <div class="set-wrap">
        <form action="" name="form1" method="post" id="this_form">
            <div class="wrap-inner">
                <h4 class="main-title">站点核心设置</h4>

                <div class="set-area-int">
                    <div class="site-info-a">
                        <label for="site-name">
                            <p>网站名称：<span>（网站的title值）</span></p>
                            <input name="site_name" class="input-box site-box-w" vrel="sz=max:50,m:请缩减至十个字内|ne=m:不能为空"
                                   warntip="#nameTip" type="text" value="<?php echo $setting['title']; ?>"/>
                            <span class="a-error hidden" id="nameTip"></span>
                        </label>
                    </div>
                    <div class="site-info-a">
                        <label for="site-name">
                            <p>网站关键词描述：<span>（网站的keywords值）</span></p>
                            <input name="site_keywords" class="input-box site-box-w"
                                   vrel="sz=max:110,m:请缩减至十个字内|ne=m:不能为空" warntip="#nameTip" type="text"
                                   value="<?php echo $setting['Keywords']; ?>"/>
                            <span class="a-error hidden" id="nameTip"></span>
                        </label>
                    </div>
                    <div class="site-info-a">
                        <label for="site-name">
                            <p>网站描述：<span>（网站description值）</span></p>
                            <textarea name="site_description" class="input-box site-box-area" cols="210"
                                      rows="10"><?php echo $setting['Description']; ?></textarea>
                            <span class="a-error hidden" id="nameTip"></span>
                        </label>
                    </div>
                    <div class="site-info-a">
                        <label for="beian-info">
                            <p>网站备案信息代码：<span>（备案信息将显示在页面底部）</span></p>
                            <input name="site_bei" class="input-box site-box-w" vrel="sz=max:30,m:最多30个中文或60个英文字母"
                                   type="text" warntip="#codeErr" value="<?php echo $setting['bei']; ?>"/>
                            <span class="a-error hidden" id="codeErr"></span>
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
