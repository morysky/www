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
    让我的身旁有个你！&nbsp;&nbsp;&nbsp;版权所有：<a href='http://www.shenpang.cc' target=_blank>身旁网</a>&nbsp;&nbsp;&nbsp;开发支持：<a href='http://www.paipang.com'>拍旁网</a>&nbsp;&nbsp;&nbsp;备案号：粤ICP备08128591号-2    <a href='admin.php?m=admin/admin.login'>后台管理</a><?php echo $SPconfig['statistics'];?></div>

</div>

<SCRIPT type=text/javascript>
    // test auto-ready logic - call corner before DOM is ready
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

<script>
    function re() {
        var a = document.getElementById('ff');
        a.className = 'enjoy';
        a.onmousedown = function() {
            this.className = 'enjoying'
        }
    }
    window.onload = re;
</script>
<script src="<?php echo BASE_URL;?>css/newimage/js/hidden_block.js" type="text/javascript"></script>
<script language=JAVAscript>

    <!--
    // ------ 定义全局变量
    var theNewsNum;
    var theAddNum;
    var totalNum;
    var CurrentPosion = 0;
    var theCurrentNews;
    var theCurrentLength;
    var theNewsText;
    var theTargetLink;
    var theCharacterTimeout;
    var theNewsTimeout;
    var theBrowserVersion;
    var theWidgetOne;
    var theWidgetTwo;
    var theSpaceFiller;
    var theLeadString;
    var theNewsState;
    function startTicker() {
// ------ 设置初始数值
        theCharacterTimeout = 50;//字符间隔时间
        theNewsTimeout = 2000;//新闻间隔时间
        theWidgetOne = "_";//新闻前面下标符1
        theWidgetTwo = "-";//新闻前面下标符
        theNewsState = 1;
        //theNewsNum        = document.body.children.incoming.children.NewsNum.innerText;//新闻总条数
        theNewsNum = $("#incoming #AllNews").children().length;//新闻总条数

        theAddNum = $("#incoming #AddNews").children().length;//补充条数

        totalNum = theNewsNum + theAddNum;
        theCurrentNews = 0;
        theCurrentLength = 0;
        theLeadString = " ";
        theSpaceFiller = " ";
        runTheTicker();
    }
    // --- 基础函数
    function runTheTicker() {
        if (theNewsState == 1) {
            // alert(CurrentPosion);

            if (CurrentPosion < theNewsNum) {

                setupNextNews();
//          /alert(theNewsNum);

            }
            else {

                setupAddNews();
            }
            CurrentPosion++;
            if (CurrentPosion >= totalNum || CurrentPosion >= 5) CurrentPosion = 0;  //最多条数不超过5条
        }

        if (theCurrentLength != theNewsText.length) {
            drawNews();
        }
        else {
            closeOutNews();
        }
    }
    // --- 跳转下一条新闻
    function setupNextNews() {
        theNewsState = 0;


        theCurrentNews = theCurrentNews % theNewsNum;
        //alert(theCurrentNews);
        //theNewsText = $("#AllNews #"+theCurrentNews+" #Summary").text();

        theNewsText = $("#AllNews #" + theCurrentNews + " #Summary" + theCurrentNews).text();

        // alert(theNewsText);
        //   theTargetLink = document.getElementById("AllNews").children[theCurrentNews].children.NewsLink.innerText;
        theTargetLink = $("#AllNews #" + theCurrentNews + " #NewsLink" + theCurrentNews).text();

        theCurrentLength = 0;
        $("#hottext").attr("href", theTargetLink);

        theCurrentNews++;
    }
    function setupAddNews() {
        theNewsState = 0;


        theCurrentNews = theCurrentNews % theAddNum;

        //theNewsText = document.getElementById("incoming").children.AddNews.children[theCurrentNews].children.Summary.innerText;
        theNewsText = $("#incoming #AllNews #" + theCurrentNews + " #Summary" + theCurrentNews).text();
        // alert(theNewsText.length);
        //  theTargetLink = document.getElementById("incoming").children.AddNews.children[theCurrentNews].children.NewsLink.innerText;        
        theTargetLink = $("#incoming #AllNews #" + theCurrentNews + " #NewsLink" + theCurrentNews).text();
        theCurrentLength = 0;
        $("#hottext").attr("href", theTargetLink);

        theCurrentNews++;
    }
    // --- 滚动新闻
    function drawNews() {

        var myWidget;
        if ((theCurrentLength % 2) == 1) {
            myWidget = theWidgetOne;
        }
        else {
            myWidget = theWidgetTwo;
        }
        $('#hottext').html(theLeadString + theNewsText.substring(0, theCurrentLength) + myWidget + theSpaceFiller);
        theCurrentLength++;
        setTimeout("runTheTicker()", theCharacterTimeout);
    }
    // --- 结束新闻循环
    function closeOutNews() {
        $("#hottext").html(theLeadString + theNewsText + theSpaceFiller);
        theNewsState = 1;
        setTimeout("runTheTicker()", theNewsTimeout);
    }
    //window.onload=
    //-->
</script>
<script type="text/javascript">
    (function() {
        var SP = function(o) {
            return document.getElementById(o);
        }, isIE6;

        if ('\v' == 'v') { //ie6
            isIE6 = true;
        } else {
            isIE6 = false;
        }

        window.onload = function() {
            startTicker();
            var gotoTopEl = SP("goto_top"),
                    gotoTopElHeight = gotoTopEl.offsetHeight;
            window.onscroll = function() {
                setGotoTop();
            }

            if (!isIE6) {
                gotoTopEl.style.position = 'fixed';
            } else {
                gotoTopEl.style.position = 'absolute';
            }

            var setGotoTop = function(doc) {

                doc = doc || document;
                var scrollTop = Math.max(doc.documentElement.scrollTop, doc.body.scrollTop);

                if (scrollTop) {
                    gotoTopEl.style.display = 'block';
                    if (isIE6 && doc.compatMode) {
                        var clientHeight = doc.compatMode == 'CSS1Compat' ? doc.documentElement.clientHeight : doc.body.clientHeight;
                        gotoTopEl.style.top = (scrollTop + clientHeight - gotoTopElHeight) + 'px';
                    }
                } else {
                    gotoTopEl.style.display = 'none';
                }
            };

            setGotoTop();
        }

    })();
</script>
<div id="goto_top"><a href="#" title="回到顶部"></a></div>
<div id="help"><a href="index.php?m=index.feedback" title="意见反馈" target=_blank>意见反馈</a></div>
<script type="text/javascript">
    var divcss = {display:"none"};
    $('.spbigpic').css(divcss);
    $(function() {
        $('a[rel=lightbox]').lightBox();
    });
</script>
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo BASE_URL_SP;?>css/newimage/js/DD_belatedPNG.js"></script>
<script type="text/javascript">
    DD_belatedPNG.fix('.new,.user_photo,.c_b_t,.c_b_c,.c_b_b,.c_b_arrow,.libottom,.pages span,.pages a,.sider_t,.sider_c,.sider_b,.sider h2,.serivce_list li,#help,#goto_top');
</script>
<![endif]-->
<style>
        /*图片缩小*/
    .text img {
        max-width: 500px;
        height: auto;
        width: expression(this.width > 500 ? "500px" : this.width);

    }
</style>
