<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>发现--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL_SP;?>css/newimage/css/layout.css" type="text/css" rel="stylesheet"/>
    <link href="<?php echo BASE_URL;?>/css/find/css/reset.css" rel="stylesheet" type="text/css">
    <link href="<?php echo BASE_URL;?>/css/find/css/style.css" rel="stylesheet" type="text/css">
    <script src="<?php echo BASE_URL;?>/css/find/js/jquery.min.js"></script>
</head>
<body class='bodyBg dbPage'>
<?php TPL::plugin('include/header');?>
       <script>
           function reflesh()
           {    $(".row").last().hide();
             $('.row').first().slideDown("slow").before($('.row').last());
           $(".row").first().slideDown("slow");
           }
           setInterval("reflesh()",5000);

       </script>
<div class="discoverWall" style="position: relative;">
    <div class="con" id="discover" style="margin-top: 0px;">

           <?php

        $userinfo = USER::get('userinfo');
        $filter_type = V('g:filter_type');
        $page = V('g:page');
        if (!$page) $page = 1;
        $sum = 50;
        $total = ($page - 1) * $sum;
        $filter = '';
        if ($filter_type) $filter = ' and types=' . $filter_type;
        $db = APP :: ADP('db');
        $friend = $db->query('select * from ' . $db->getTable(T_FOLLOWS) . ' where uid=' . $userinfo['uid']);
        $fall = '(' . $userinfo['uid'];
        foreach ($friend as $key => $value) {
            $fall .= ',' . $value['guid'];
        }
        $fall .= ")";
        $rows = $db->query('select count(uid) as count from ' . $db->getTable(T_CONTENT) . ' ');
        $allcount = $rows[0]['count'];
        $sql = 'select * from ' . $db->getTable(T_CONTENT) . ' order by did desc   limit ' . $total . ',' . $sum;
        if ($results = CACHE::get('newwall')) {
        } else {
            $results = $db->query('select * from ' . $db->getTable(T_CONTENT) . '    where did  in(select SUBSTRING_INDEX(group_concat(did order by did desc),",",1) from  ' . $db->getTable(T_CONTENT) . '   group by uid )   and uid!=102 order by did desc  limit 30');
            CACHE::set('newwall', $results, 300);
        }

        $results = APP::F('content_filter', $results);
          //for($i=0;$i<30;$i+=6){
        ?>

        <div class="row">
            <div class="cell" blogid="9dccb29e320008pm">
                <div class="content"><img width="150" src="http://ww3.sinaimg.cn/small/9dccb29ejw1dopg5ay17rj.jpg"
                                          alt="棉花莎莎"><span class="tag">复古</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="5041e6f0320008jw">
                <div class="content"><img height="150" src="http://ww4.sinaimg.cn/small/5041e6f0jw1docfesqquqj.jpg"
                                          alt="LLL神捕可测的天才"><span class="tag">海贼王</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="71fcebb532000bhh">
                <div class="content"><img width="150" src="http://ww4.sinaimg.cn/small/71fcebb5jw1dokp7bmxpsj.jpg"
                                          alt="设计分享团"><span class="tag">海报</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="890f0aef320009bd">
                <div class="content"><img height="150" src="http://ww3.sinaimg.cn/small/890f0aefjw1dop7r8x4k9j.jpg"
                                          alt="王守洋"><span class="tag">人像</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="8bcaa2df320009qo">
                <div class="content"><img height="150" src="http://ww1.sinaimg.cn/small/8bcaa2dfjw1dom2y2cai3j.jpg"
                                          alt="绪花花Shelley"><span class="tag">咖啡</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="7ef330ff320009rr">
                <div class="content"><img height="150" src="http://ww1.sinaimg.cn/small/7ef330ffjw1dojhzj8176j.jpg"
                                          alt="国家地理摄影"><span class="tag">风景</span></div>
                <div class="cate"></div>
            </div>
        </div>

        <div class="row">
            <div class="cell cellMusic" blogid="4902ce9435000b58">
                <div class="content"><img width="150" src="http://image2.sina.com.cn/music/album/90/59/39146_150150.jpg"
                                          alt="娱溪"><span class="ico_play"></span><span class="tag">摇滚</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="62451f9a3200095m">
                <div class="content"><img height="150" src="http://ww2.sinaimg.cn/small/62451f9ajw1dor07wiy5xj.jpg"
                                          alt="OnceMeryl之豆花妹"><span class="tag">猫</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="6815fea833000ad2">
                <div class="content"><img width="150" src="http://ww2.sinaimg.cn/small/6815fea8jw1doqsqf9halj.jpg"
                                          alt="海上生"><span class="tag">电影</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="842e19e3320009oi">
                <div class="content"><img width="150" src="http://ww3.sinaimg.cn/small/842e19e3jw1dop49cujcqj.jpg"
                                          alt="璐易2屎"><span class="tag">设计</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="965762fc32000b4w">
                <div class="content"><img height="150" src="http://ww3.sinaimg.cn/small/965762fcjw1dor8u70r0nj.jpg"
                                          alt="彼得潘的梦幻岛V"><span class="tag">婚礼</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="474dfe133300048i">
                <div class="content"><img width="150" src="http://ww4.sinaimg.cn/small/474dfe13jw1dlb63c05v0g.gif"
                                          alt="柒北_李燃"><span class="tag">星座</span></div>
                <div class="cate"></div>
            </div>
        </div>

        <div class="row">
            <div class="cell" blogid="90c170b23200083t">
                <div class="content"><img width="150" src="http://ww3.sinaimg.cn/small/90c170b2jw1do32ooxsg0j.jpg"
                                          alt="全球艺术设计"><span class="tag">涂鸦</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="49172bb533000bb1">
                <div class="content"><img width="150"
                                          src="http://m1.img.libdd.com/farm3/112/E42007F5C1C7A77028221D7996EC8270_430_430.jpg"
                                          alt="五月季节-Sky"><span class="tag">时光</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="67423ab232000arg">
                <div class="content"><img height="150" src="http://ww3.sinaimg.cn/small/67423ab2jw1dosm6llyibj.jpg"
                                          alt="Runda"><span class="tag">美图</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="830226c6320008eo">
                <div class="content"><img height="150" src="http://ww4.sinaimg.cn/small/830226c6jw1docdluu1lwj.jpg"
                                          alt="大自然密码"><span class="tag">科学</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="698dc1c8320009rc">
                <div class="content"><img width="150" src="http://ww4.sinaimg.cn/small/698dc1c8jw1dou95i5g3oj.jpg"
                                          alt="LiN-Millions"><span class="tag">蓝色</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell cellMusic" blogid="8601e1cd35000bi0">
                <div class="content"><img width="150" src="http://image2.sina.com.cn/music/album/64/88/46548_150150.jpg"
                                          alt="SY虈冉ALEX"><span class="ico_play"></span><span class="tag">摇滚</span></div>
                <div class="cate"></div>
            </div>
        </div>

        <div class="row">
            <div class="cell" blogid="8754d84132000bs9">
                <div class="content"><img width="150" src="http://ww4.sinaimg.cn/small/8754d841jw1douc3edqkhj.jpg"
                                          alt="短发风"><span class="tag">复古</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="696fb68e320009vc">
                <div class="content"><img width="150" src="http://ww3.sinaimg.cn/small/696fb68ejw1dovy2qfaztj.jpg"
                                          alt="卖布姑娘"><span class="tag">街拍</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell cellMusic" blogid="7f1756b935000adz">
                <div class="content"><img width="150"
                                          src="http://image2.sina.com.cn/music/album/48/78/224904_150150.jpg"
                                          alt="肉多多娃斯基"><span class="ico_play"></span><span class="tag">日本</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="9181c612320005pz">
                <div class="content"><img width="150" src="http://ww1.sinaimg.cn/small/9181c612jw1dngftwcramj.jpg"
                                          alt="棉花糖队长"><span class="tag">日本</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell cellMusic" blogid="839fb5a6350009kx">
                <div class="content"><img width="150" src="http://image2.sina.com.cn/music/album/64/42/66500_150150.jpg"
                                          alt="不知宜修"><span class="ico_play"></span><span class="tag">乐评</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="565467d4320004ht">
                <div class="content"><img width="150" src="http://ww4.sinaimg.cn/small/565467d4jw1dkz6krx4mkj.jpg"
                                          alt="angelulu"><span class="tag">恋物</span></div>
                <div class="cate"></div>
            </div>
        </div>

        <div class="row">
            <div class="cell" blogid="4ac3739232000aap">
                <div class="content"><img width="150" src="http://ww2.sinaimg.cn/small/4ac37392jw1doykqu4md7j.jpg"
                                          alt="美妞儿"><span class="tag">妈咪宝贝</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="74c133a133000b0c">
                <div class="content"><img height="150" src="http://ww4.sinaimg.cn/small/74c133a1jw1dov5jqfm88j.jpg"
                                          alt="KiKi的猫言猫语"><span class="tag">宠物</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="9288ceac330009hb">
                <div class="content"><img height="150" src="http://ww3.sinaimg.cn/small/9288ceacjw1dorm7fgbo3j.jpg"
                                          alt="昕妍昕雨"><span class="tag">爱情</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="70c9d0073200094p">
                <div class="content"><img height="150" src="http://ww2.sinaimg.cn/small/70c9d007jw1dodfy0p7i1g.gif"
                                          alt="_Angus__"><span class="tag">gif</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="8842ed5933000a7h">
                <div class="content"><img height="150"
                                          src="http://fmn.rrimg.com/fmn064/xiaozhan/20120103/1030/x_large_0Kfg_47f500005b51125c.jpg"
                                          alt="琳果果de夏天"><span class="tag">运动</span></div>
                <div class="cate"></div>
            </div>
            <div class="cell" blogid="605d05b1320009hf">
                <div class="content"><img width="150" src="http://ww3.sinaimg.cn/small/605d05b1jw1dox6hjfoxrj.jpg"
                                          alt="平面设计师-GUANWEI"><span class="tag">艺术</span></div>
                <div class="cate"></div>
            </div>
        </div>
         <?php //} ?>


    </div>
</div>


<div class="hotConBox">
<div class="hd">
    <ul class="titList">
        <li class="hotTags"><strong>热门标签</strong></li>
        <li class="excBlog"><strong>优质Qing</strong></li>
        <li class="editor"><strong>小编</strong></li>
    </ul>
</div>

<div id="hotTagsContainer" class="bd">

<div class="hotConRow firstRow grayRow">
    <div class="tagName">
        <a target="_blank" onclick="xblogLog &amp;&amp; xblogLog('A_0001_01_03_1863107465','1863107465')" title=""
           href="http://qing.weibo.com/tag/婚礼">#婚礼</a>
    </div>
    <ul class="avatarMod excBlogList">
        <li>

            <div aid="2074501384" attentionstate="false" likedtotalnumber="2533"
                 description="收集所有婚礼相关的东西:跟妆、跟拍、跟摄、婚纱、婚庆布置..." username="婚礼素材收集者"
                 headimg="http://tp1.sinaimg.cn/2074501384/50/5604330941/0" cardtype="1" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/2074501384"><img alt="婚礼素材收集者"
                                                                src="http://tp1.sinaimg.cn/2074501384/50/5604330941/0"></a>
            </div>
        </li>
        <li>

            <div aid="1805416131" attentionstate="false" likedtotalnumber="381" description="约片请私信。
视觉收集者，咖啡师傅，
红酒酒鬼，不入流..." username="摄影师Sure" headimg="http://tp4.sinaimg.cn/1805416131/50/1294782555/1" cardtype="1" isempty="false"
                 class="img" hasattachevent="true">
                <a href="http://qing.weibo.com/1805416131"><img alt="摄影师Sure"
                                                                src="http://tp4.sinaimg.cn/1805416131/50/1294782555/1"></a>
            </div>
        </li>
        <li>

            <div aid="1624481013" attentionstate="false" likedtotalnumber="16" description="摄影师木可良
若有需要 请联系我
主页：htt..." username="木可良" headimg="http://tp2.sinaimg.cn/1624481013/50/5624977465/1" cardtype="1" isempty="false"
                 class="img" hasattachevent="true">
                <a href="http://qing.weibo.com/1624481013"><img alt="木可良"
                                                                src="http://tp2.sinaimg.cn/1624481013/50/5624977465/1"></a>
            </div>
        </li>
        <li>

            <div aid="1918916835" attentionstate="false" likedtotalnumber="4"
                 description="天津米兰婚纱摄影成立于2007年，是一家专业、专精、专注..." username="天津米兰婚纱摄影馆"
                 headimg="http://tp4.sinaimg.cn/1918916835/50/5599533336/0" cardtype="1" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/1918916835"><img alt="天津米兰婚纱摄影馆"
                                                                src="http://tp4.sinaimg.cn/1918916835/50/5599533336/0"></a>
            </div>
        </li>
        <li>

            <div aid="1963838533" attentionstate="false" likedtotalnumber="15"
                 description="【上海唯一视觉】；上海我要我爱婚纱摄影有限公司；婚纱摄影..." username="上海唯一视觉婚纱摄影工作室"
                 headimg="http://tp2.sinaimg.cn/1963838533/50/1297489874/1" cardtype="1" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/1963838533"><img alt="上海唯一视觉婚纱摄影工作室"
                                                                src="http://tp2.sinaimg.cn/1963838533/50/1297489874/1"></a>
            </div>
        </li>
        <li>

            <div aid="2624435080" attentionstate="false" likedtotalnumber="97" description="时尚婚纱，总有你喜欢的" username="婚纱殿堂"
                 headimg="http://tp1.sinaimg.cn/2624435080/50/5624322489/0" cardtype="1" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/2624435080"><img alt="婚纱殿堂"
                                                                src="http://tp1.sinaimg.cn/2624435080/50/5624322489/0"></a>
            </div>
        </li>

    </ul>
    <ul class="avatarMod editorList">
        <li>
            <div ischiefeditor="true" aid="2624435080" attentionstate="false" description="时尚婚纱，总有你喜欢的" username="婚纱殿堂"
                 headimg="http://tp1.sinaimg.cn/2624435080/50/5624322489/0" cardtype="2" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/2624435080"><img alt="婚纱殿堂"
                                                                src="http://tp1.sinaimg.cn/2624435080/50/5624322489/0">
                    <span class="iconStar"></span> </a>
            </div>
        </li>
        <li>
            <div ischiefeditor="false" aid="2447164602" attentionstate="false"
                 description="国外最新室内设计，软装配饰资源，独一无二！更多资源请关注..." username="小克爱家居"
                 headimg="http://tp3.sinaimg.cn/2447164602/50/5621486106/0" cardtype="2" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/2447164602"><img alt="小克爱家居"
                                                                src="http://tp3.sinaimg.cn/2447164602/50/5621486106/0">
                </a>
            </div>
        </li>
        <li>
            <div ischiefeditor="false" aid="2074501384" attentionstate="false"
                 description="收集所有婚礼相关的东西:跟妆、跟拍、跟摄、婚纱、婚庆布置..." username="婚礼素材收集者"
                 headimg="http://tp1.sinaimg.cn/2074501384/50/5604330941/0" cardtype="2" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/2074501384"><img alt="婚礼素材收集者"
                                                                src="http://tp1.sinaimg.cn/2074501384/50/5604330941/0">
                </a>
            </div>
        </li>
    </ul>
</div>
<div class="hotConRow">
    <div class="tagName">
        <a target="_blank" onclick="xblogLog &amp;&amp; xblogLog('A_0001_01_03_1863107465','1863107465')" title=""
           href="http://qing.weibo.com/tag/建筑">#建筑</a>
    </div>
    <ul class="avatarMod excBlogList">
        <li>

            <div aid="2151641792" attentionstate="false" likedtotalnumber="1441"
                 description="设计点亮空间精彩！----- 建筑，景观，室内，家居设计..." username="设计无极"
                 headimg="http://tp1.sinaimg.cn/2151641792/50/5603569333/1" cardtype="1" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/2151641792"><img alt="设计无极"
                                                                src="http://tp1.sinaimg.cn/2151641792/50/5603569333/1"></a>
            </div>
        </li>
        <li>

            <div aid="1785774732" attentionstate="false" likedtotalnumber="35" description="何以解忧 唯有实况" username="独逸洛登"
                 headimg="http://tp1.sinaimg.cn/1785774732/50/5619010788/1" cardtype="1" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/1785774732"><img alt="独逸洛登"
                                                                src="http://tp1.sinaimg.cn/1785774732/50/5619010788/1"></a>
            </div>
        </li>
        <li>

            <div aid="1774298261" attentionstate="false" likedtotalnumber="59" description="追求设计和美学关系的极致。"
                 username="空间美学设计机构" headimg="http://tp2.sinaimg.cn/1774298261/50/5618931568/1" cardtype="1"
                 isempty="false" class="img" hasattachevent="true">
                <a href="http://qing.weibo.com/1774298261"><img alt="空间美学设计机构"
                                                                src="http://tp2.sinaimg.cn/1774298261/50/5618931568/1"></a>
            </div>
        </li>
        <li>

            <div aid="1893913410" attentionstate="false" likedtotalnumber="223" description="善未易明，理未易察" username="小开童鞋"
                 headimg="http://tp3.sinaimg.cn/1893913410/50/5613961456/1" cardtype="1" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/1893913410"><img alt="小开童鞋"
                                                                src="http://tp3.sinaimg.cn/1893913410/50/5613961456/1"></a>
            </div>
        </li>
        <li>

            <div isempty="true" class="img"></div>
        </li>
        <li>

            <div isempty="true" class="img"></div>
        </li>

    </ul>
    <ul class="avatarMod editorList">
        <li>
            <div ischiefeditor="true" aid="1595391220" attentionstate="false" description="【嘿秀❤HiShow】
设计就是把苦B的生活Hold住..." username="CielHitomi_石二" headimg="http://tp1.sinaimg.cn/1595391220/50/5624535829/1" cardtype="2"
                 isempty="false" class="img" hasattachevent="true">
                <a href="http://qing.weibo.com/1595391220"><img alt="CielHitomi_石二"
                                                                src="http://tp1.sinaimg.cn/1595391220/50/5624535829/1">
                    <span class="iconStar"></span> </a>
            </div>
        </li>
        <li>
            <div ischiefeditor="false" aid="1423592893" attentionstate="false"
                 description="爱旅游，更爱爱摄影；爱时尚更爱设计，行走天下是我的理想，..." username="吴吉明"
                 headimg="http://tp2.sinaimg.cn/1423592893/50/1279878554/1" cardtype="2" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/1423592893"><img alt="吴吉明"
                                                                src="http://tp2.sinaimg.cn/1423592893/50/1279878554/1">
                </a>
            </div>
        </li>
        <li>
            <div ischiefeditor="false" aid="1920018064" attentionstate="false" description="" username="xiao-三儿"
                 headimg="http://tp1.sinaimg.cn/1920018064/50/5613751928/1" cardtype="2" isempty="false" class="img"
                 hasattachevent="true">
                <a href="http://qing.weibo.com/1920018064"><img alt="xiao-三儿"
                                                                src="http://tp1.sinaimg.cn/1920018064/50/5613751928/1">
                </a>
            </div>
        </li>
    </ul>
</div>
</div>
<div class="loading" style="display: none;" id="loading"><p>正在加载，请稍后......</p></div>

</div>
<script>

</script>
</body>
</html>