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
<style type="text/css">


</style>

<div style='display:none;color:#616161'>
    备案号：<?php echo $SPconfig['bei'];?>
    <?php echo $SPconfig['statistics'];?>
</div>

<script type="text/javascript">
    var pkBaseURL = (("https:" == document.location.protocol) ? "https://tong.paipang.com/" : "http://tong.paipang.com/");
    document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
    try {
        var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 1);
        piwikTracker.trackPageView();
        piwikTracker.enableLinkTracking();
    } catch(err) {
    }
</script>
<noscript><p><img src="http://tong.paipang.com/piwik.php?idsite=1" style="border:0" alt=""/></p></noscript>

<script type="text/javascript">
    var divcss = {display:"none"};
    $('.spbigpic').css(divcss);
    $('div.content').corner("top CC:#d1d4d5");
    $(function() {
        if (!+[1,]) {
            $('li.post').each(function() {
                $(this).corner("CC:#EAECEC");
            });
            $('a.post_avatar').each(function() {
                $(this).corner("CC:#EAECEC");
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
    $(function() {
        $('a[rel=lightbox]').lightBox();
    });
</script>
