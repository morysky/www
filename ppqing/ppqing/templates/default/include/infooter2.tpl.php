<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板footer.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$SPconfig = unserialize(SPCONFIG);
?>
<!-- 底部开始 -->
<div class="footer">
    让我的身旁有个你！&nbsp;&nbsp;&nbsp;版权所有：<a href='http://www.shenpang.cc'>身旁网</a> &nbsp;&nbsp;&nbsp;开发支持：<a href='http://www.paipang.com'>拍旁网</a>&nbsp;&nbsp;&nbsp;备案号：粤ICP备08128591号-2   <a href='admin.php?m=admin/admin.login'>后台管理</a><?php echo $SPconfig['statistics'];?> </div>

</div>

<SCRIPT type=text/javascript>
    // test auto-ready logic - call corner before DOM is ready
    var divcss = {display:"none"};
    $('.spbigpic').css(divcss);
    $('div.content').corner("top CC:#d1d4d5");
    $(function() {
        if (!+[1,]) {
            $('a.photo_img').each(function() {
                $(this).corner();
            });


        }
    });

    function makebig(did) {
        var divcss = {display:"none"};
        $('#spsmallpic_' + did).css(divcss);
        var divcss = {display:"block"};

        $('#spbigpic_' + did).css(divcss);
        //$('#spbigpic_'+did).html($('#spbigpic_'+did).html());


    }
    function makesmall(did) {
        var divcss = {display:"none"};
        $('#spbigpic_' + did).css(divcss);
        var divcss = {display:"block"};
        $('#spsmallpic_' + did).css(divcss);


    }
</SCRIPT>
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo BASE_URL_SP;?>css/newimage/js/DD_belatedPNG.js"></script>
<script type="text/javascript">
    DD_belatedPNG.fix('.new,.user_photo,.c_b_t,.c_b_c,.c_b_b,.c_b_arrow,.libottom,.pages span,.pages a,.sider_t,.sider_c,.sider_b,.sider h2,.serivce_list li,#help,#goto_top');
</script>
<![endif]-->
