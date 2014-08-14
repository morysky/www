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
$userinfo = USER::get('userinfo');
$SPconfig = unserialize(SPCONFIG);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>身旁网认证－<?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL;?>css/base.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.tools.min.js"></script>

    <link href="<?php echo BASE_URL;?>css/standalone.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL;?>css/tabs-mouseover.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo BASE_URL;?>css/newimage/css/base.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo BASE_URL;?>css/newimage/css/layout.css" type="text/css" rel="stylesheet"/>
    <style>
        .tag-recommend-tips {
            font-size: 16px;
        }

        h3 {
            font-size: 18px;
            font-weight: bold;
        }

        .description {
            font-size: 14px;
        }

        .description p {
            line-height: 24px;
        }
    </style>
</head>
<body>

<?php TPL::plugin('include/header');?>
<div id='container'>
    <div id='contentre' class='content'>
        <div class='contenttop'></div>

        <div class="tag-tabs-holder hot-tag-selected clearfix">
            <h2 class="discovery-title clearfix">
                <a href="index.php?m=index.verify" class="current">身旁网认证</a>(近期推出...)</h2>
        </div>
        <div class="tag-recommend-tips">身旁网认证,让身旁的每一个你都那么的真实!</div>
        <div class="verifycon">


            <!-- tabs -->
            <div id="products">
                <img src="<?php echo BASE_URL;?>css/bgimg/v1.png" alt="Free version" class="current">
                <img src="<?php echo BASE_URL;?>css/bgimg/v2.png" alt="Commercial version" class="">
                <img src="<?php echo BASE_URL;?>css/bgimg/v3.png" alt="Multidomain version" class="">
            </div>

            <!-- panes -->
            <div class="description" id="free" style="display: block; ">
                <div class="arrow">&nbsp;</div>

                <h3>身旁联盟认证</h3>

                <p>-----------------------------------------------------</p>

                <p>
                    <strong>身旁联盟是什么</strong>：
                    身旁联盟，由上进，有追求，有理想，勇于挑战，不怕输的草根，学生，创业者组成。身旁联盟的目的，就是让有追求的学生，草根，创业者，能得到这个社会的支持与认同，而形成一个强大的新生团体组织。
                    身旁网相信，年轻人是未来的希望，我们更加看重的是未来，看重的是潜力。希望身旁网的联盟，能帮助更广大的草根，学生，创业者，找到他们的团队，找到他们的方向，与理想，得到更多社会的认同与支持。
                </p>

                <p>-----------------------------------------------------</p>

                <p>
                    <strong>加入身旁联盟有什么样的条件</strong>：

                <p>1.有自己的项目，或作品，或网站。 （项目，作品，网站，必须积极向上）

                <p>2.有自己独特的想法与见解。（可以通过身旁轻博客，各类博客）

                <p>3.有好的人缘，受人喜爱。（有个性，擅长表达，有广大的号召力）

                <p>4.有自己过人的一技之长。（如体育，音乐，书法，电子竞技等）

                </p>

                <p>
                    <strong>注：为什么没见过一个有联盟认证的呢？（告诉你一个小秘密，联盟认证是潜水的，只有通过三种认证的一种后，才能看到的）</strong>
                </p>
            </div>

            <div class="description" id="commercial" style="display: none; ">
                <div class="arrow"></div>

                <h3>个人认证标准说明</h3>

                <p>
                    <strong>娱乐类</strong>

                <p>

                    演员：曾出演过知名影视作品的演员影星

                <p>

                    歌手：发行过个人专辑、或签约唱片公司的职业歌手

                <p>

                    导演：执导过多部知名影视作品

                <p>

                    编剧制片：在众多知名影视作品中参与主创的编剧、制片、制片人

                <p>

                    娱乐高管：知名唱片公司、影视发行公司和知名演出公司总经理以上级别的管理人员

                <p>

                    <strong>时尚类</strong>

                <p>

                    模特：一线时尚杂志专属模特；知名模特公司签约模特；知名广告作品模特；车展厂商车模

                <p>

                    化妆造型：一线艺人专属造型师、知名造型机构和化妆品公司专职化妆师

                <p>

                    美容/服饰：卫视电视栏目签约美容嘉宾、知名美容专栏作家；一线服装品牌专属服装/珠宝设计师

                <p>

                    <strong>生活类</strong>

                <p>

                    医生：三级以上医院医师；二级医院的主任医师、专家、院长等

                <p>

                    健康、养生专家：电视栏目知名养生专家，或出版过著名养生类书籍

                <p>

                    心理情感专家：国家二级心理咨询师资格以上

                <p>

                    美食：著名美食专栏作家、全国著名餐饮类公司的高层

                <p>

                    <strong>体育类</strong>

                <p>

                    运动员：省级青年队及主力队运动员；国家一级运动员；职业体育俱乐部正式队员

                <p>

                    教练员：省青年队以上的主教练（可参照运动员认证标准）

                <p>

                    裁判：国家一级裁判，国际裁判

                <p>

                    体育产业人士：知名体育产业公司总经理以上

                <p>

                    <strong>财经类</strong>

                <p>

                    商界名人：世界500强公司，中国500强公司，上市企业的高层管理人员

                <p>

                    经济学人：知名公众经济学家、财经专栏作家、财经研究机构学者、高校经济学教授

                <p>

                    投资：知名投资公司合伙人、创始人

                <p>

                    注册会计师：具有注册会计师等级证书的在职会计师

                <p>

                    股票、基金、外汇、期货：具有相关执业资格的分析师、研究员，以及证券、基金外汇公司部门总监以上

                <p>

                    <strong>IT科技类</strong>

                <p>

                    互联网高管：知名互联网公司总高管人员

                <p>

                    通信：全国性电信公司部门总监、总经理及各地分公司总经理

                <p>

                    站长：国内网站alexa排名前1万以内的网站站长

                <p>

                    VC：知名IT、互联网类公司的主要风险投资人

                <p>

                    家电数码：知名家电、数码生产销售企业总监以上级别的管理人员

                <p>

                    <strong>传媒类</strong>

                <p>

                    报纸、杂志、电视台、电台的正式编辑、记者、编导，主任，总编辑等

                <p>

                    <strong>政府类</strong>

                <p>

                    国家公务员；民警、交警，法官等警法人员，铁路列车长等

                <p>

                    <strong>校园类</strong>

                <p>

                    所有国家正规大专及以上院校的讲师，教授，院长，校长。省重点中学高级教师，特级教师，系主任，校长等

                <p>

                    <strong>军事航空类</strong>

                <p>

                    军事：知名时事专家，武器技术专家，媒体签约军事评论员等

                <p>

                    航空：航空公司高管，飞机机长，乘务长，明星空姐等

                <p>

                    <strong>文学出版类</strong>

                <p>

                    出版人：出版社或出版公司主任及以上级人员（包含总监以及大部经理）；有资深出版经历的知名策划人和出版人员

                <p>

                    作家：拥有知名出版作品的原创作家

                <p>

                    <strong>人文艺术类</strong>

                <p>

                    全职相声演员，小品演员，职业魔术师，知名画家，职业舞蹈演员等

                <p>

                    <strong>育儿类</strong>

                <p>

                    母婴行业公司的高管，媒体签约婴幼专家，早教专家；幼儿园园长；全国知名儿童、妇女专科医院的全职医生等

                <p>
                </p>
            </div>

            <div class="description" id="multidomain" style="display: none; ">
                <div class="arrow"></div>

                <h3>机构认证</h3>

                <p>
                    <strong>政府官方认证：</strong>

                <p>
                    公安机关、司法、交通、旅游、医院、卫生、市政、工商等政府机构官方帐号认证。

                <p>
                    <strong>媒体官方认证：</strong>

                <p>
                    报纸、杂志、电台、电视台官方帐号、栏目官方微博等帐号认证。

                <p>
                    <strong>企业官方认证：</strong>

                <p>
                    有营业执照和公章的盈利型各类企业、公司等官方帐号均可申请企业认证。

                <p>
                    <strong>网站官方认证：</strong>

                <p>
                    有独立域名和合法资质的网站官方账号认证。认证要求：微博昵称与头像体现网站名称与LOGO，企业等官网和微博网站不在认证范围内。

                <p>
                    <strong>校园官方认证：</strong>

                <p>
                    校园官方、团委、院系、社团、校友会等官方帐号认证。

                <p>
                    <strong>机构/团体官方认证：</strong>

                <p>
                    图书馆、博物馆、美术馆、粉丝团体、体育俱乐部、车友俱乐部、影视话剧等官方帐号认证。

                <p>
                </p>
            </div>


            <!-- activate tabs with JavaScript -->
            <script>
                $(function() {

                    $("#products").tabs("div.description", {event:'mouseover'});
                });
            </script>


            <div class="clear"></div>
        </div>
    </div>
    <div style="height:30px;"></div>
    <div class="footer">
        生命要用心涂鸦！每个人都是艺术家！&nbsp;&nbsp;&nbsp;版权所有：身旁网&nbsp;&nbsp;&nbsp;备案号：粤ICP备08128591号-2 <?php echo $SPconfig['statistics'];?></div>
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
</div>
</body>
</html>