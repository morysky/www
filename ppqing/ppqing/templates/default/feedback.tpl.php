<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
/*************************************************************
 * Created: 2011-8-20
 *
 * 模板 feedback.tpl.php
 *
 * @author loujiajia(loujiajia1@163.com)
 **************************************************************/
$userinfo = USER::get('userinfo');
$SPconfig = unserialize(SPCONFIG);
$userValid = 0;
if ('1' == $userinfo['uid'] || '90' == $userinfo['uid']) {
    $userValid = 1;
}
?>



<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>反馈信息－<?php echo $SPconfig['title'];?>--power by 身旁网&拍旁轻博客</title>
    <meta name="Keywords" content="<?php echo $SPconfig['Keywords'];?>"/>
    <meta name="Description" content="<?php echo $SPconfig['Description'];?>"/>
    <link rel="shortcut icon" href="<?php echo BASE_URL;?>favicon.ico"/>
    <link href="<?php echo BASE_URL;?>css/base.css" rel="stylesheet" type="text/css"/>
    <?php TPL::plugin('include/tophead');?>
</head>
<body>
<?php if (!file_exists('avatar/i_upload/' . $userinfo['uid'] . '_small_2.jpg')) { ?>
<link href="<?php echo BASE_URL;?>css/subModal.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/subModal.js"></script>
<script>
    initPopUp(0);
    showPopWin('index.php?m=setting.fristpic', 700, 400, null);

</script>
    <?php }?>
<?php TPL::plugin('include/header');?>
<div id='container'>
<div style="height:30px;"></div>
<div id='contentre' class='content'>
<div class='contenttop'></div>
<?php

$classArray = array(
    '0' => '全部',
    '1' => '体验建议',
    '2' => '意见投诉',
    '3' => 'bug修正'

);

$isReslove = array(
    '0' => '全部',
    '1' => '未解决',
    '2' => '已解决',
);


/* 查看分类识别 */
$classID = 0;
$classID = V('g:classID');
$classID = ($classID >= 1 && $classID <= 3) ? $classID : 0;


/* 查看解决与否标志 */
$resloveTags = V('g:reslove');
$resloveTags = ($resloveTags >= 1 && $resloveTags <= 2) ? $resloveTags : 0;

/* 添加查询的条件语句 */
$whereQuery = "";
$thisUrl = "index.php?m=index.feedback";
//
//
//if($cid)
//{
//	$userinfo['uid']=$cid;
//}
$page = V('g:page');
if (!$page) $page = 1;
$sum = 10;

$total = ($page - 1) * $sum;


/* 分类标志 */

if ($classID) {
    $whereQuery = " where classID =" . $classID;
    $thisUrl .= "&classID=" . $classID;
}
    /* 标志解决或未解决的问题 */
else if ($resloveTags) {
    $whereQuery .= " where reslove = " . $resloveTags;
    $thisUrl .= "&reslove=" . $resloveTags;
}

$db = APP :: ADP('db');
$rows = $db->query('select count(id) as count from ' . $db->getTable(T_FEEDBACK) . ' x  left join ' . $db->getTable(T_USERS) . ' y on x.uid=y.uid ' . $whereQuery);

//echo 'sssssssssss->select count(id) as count from '.$db->getTable(T_FEEDBACK)." ".$whereQuery;

$allcount = $rows[0]['count'];

$fresults = $db->query('select * from ' . $db->getTable(T_FEEDBACK) . ' x  left join ' . $db->getTable(T_USERS) . ' y on x.uid=y.uid ' . $whereQuery . ' order by x.theDate desc limit ' . $total . ',' . $sum);

$fresults = APP::F('content_filter', $fresults);
?>
<style>
    .baolist {
        padding: 8px;
        font-size: 16px;
        border: 1px solid #d1d1d1;
        margin: 8px;
        height: 85px;
        width: 800px !important;
        width: 780px;
        background: #fafafa;
    }

    .baolist img {
        padding: 2px;
        border: 0px;
        postion: relative;
    }

    .baoleft {
        width: 100px;
        float: left;

    }

    .baoright {
        width: 600px;
        float: left;
        margin-left: 2px;
        font-size: 13px;
    }

    .baoright .title {
        float: left;
    }

    .baoright .time {
        float: right;
    }

    .baoright .content {
        display: block;
        font-size: 14px;
        color: #999;
        float: left;
        word-wrap: break-word;
        width: 610px;
    }

    .baoright .answer {
        margin-top: 10px;
    }

    .baosupport {
        font-size: 13px;
        float: left;
        margin-left: 10px;
        width: 65px;
        text-align: center;
        font-weight: bolder;

    }

    .feedbackNav {
        margin-top: 8px;
        height: 30px;
        background: #EEEEEE;
        width: 100%;
    }

    .feedbackNav .classSelect {
        width: 65%;
        float: left;
    }

    .feedbackNav .classSelect li {
        font-size: 16px;
        float: left;
        text-align: center;
        width: 120px;
        line-height: 30px;

    }

    .feedbackNav .classSelect li a, .feedbackNav .classSelect li a:visited {
        display: block;
        font-weight: bolder;
    }

    .feedbackNav .classSelect li a:hover {
        color: #F00;
    }

    .feedbackNav .resloveSelect {
        width: 35%;
        float: right;
    }

    .feedbackNav .resloveSelect li {
        font-size: 14px;
        float: left;
        text-align: center;
        width: 90px;
        line-height: 30px;

    }

    .feedbackNav .resloveSelect li a, .feedbackNav .resloveSelect li a:visited {
        display: block;
        color: #666;
    }

    .feedbackNav .resloveSelect li a:hover {
        color: #F00;
    }

    .spfeedback textarea {
        overflow-y: auto;
        padding: 0;
        width: 100px;
        height: 100px;
    }

</style>
<script type="text/javascript">
    //写cookies函数 作者：翟振凯
    function SetCookie(name, value)//两个参数，一个是cookie的名子，一个是值 {
        var Days = 1; //此 cookie 将被保存 30 天
        var exp = new Date();    //new Date("December 31, 9998");
        exp.setTime(exp.getTime() + Days * 24 * 60 * 60 * 1000);
        document.cookie = name + "=" + escape(value) + ";expires=" + exp.toGMTString();
    }

    function getCookie(name)//取cookies函数 {
        var arr = document.cookie.match(new RegExp("(^| )" + name + "=([^;]*)(;|$)"));
        if (arr != null) {
            return unescape(arr[2]);
        }
        return null;

    }

    function delCookie(name)//删除cookie {
        var exp = new Date();
        exp.setTime(exp.getTime() - 1);
        var cval = getCookie(name);
        if (cval != null) document.cookie = name + "=" + cval + ";expires=" + exp.toGMTString();
    }


    function checkForm(form) {

        var contentCount = 1;
        if (getCookie("shenpang_feedBack_Content")) {
            contentCount = parseInt(getCookie("shenpang_feedBack_Content")) + 1;

        }
//=============================
        if (contentCount > 3) {
            alert("当日只允许三次编辑意见。" + contentCount);
            return;
        }

        SetCookie("shenpang_feedBack_Content", contentCount);
        var title = form.elements['title'].value;
        if (title.length > 50 || title.length < 1) {
            alert("请正确输入标题，输入标题不能超过25字！");
            return;
        }
        var content = form.elements['content'].value;
        if (content.length > 400 || content.length < 1 || content == "请填写反馈信息") {
            alert("请正确输入内容，输入内容不能超过200字！");
            return;
        }
        var classID = form.elements['classID'].value;
        if (classID > 3 || classID < 0) {
            alert("输入分类有误！");
            return;
        }
        form.action = "index.php?m=post.feedbackadd";
        form.submit();


    }


    function feedbackSupport(id) {
        var voteCount = 1;
        if (getCookie("shenpang_feedBack_voted")) {
            voteCount = parseInt(getCookie("shenpang_feedBack_voted")) + 1;
        }
//------------------------------
        if (voteCount > 5) {
            alert("当日只允许您五次投票，请勿太频繁操作。");
            return;
        }

        $.ajax({
            type: "POST",
            url: "index.php?m=post.feedbackSupport",
            data: 'id=' + id,
            success: function(msg) {
                var count = document.getElementById('support_' + id).innerHTML;
                document.getElementById('support_' + id).innerHTML = parseInt(count) + 1;


            }
        });
        SetCookie("shenpang_feedBack_voted", voteCount);
        alert("感谢您第" + voteCount + "的投票");


    }


    function feedbackDelete(id, title) {
        if (confirm("确实要删除【" + title + "】的反馈信息？")) {
            $.ajax({
                type: "POST",
                url: "index.php?m=post.feedbackDelete",
                data: 'id=' + id,
                success: function(msg) {


                }

            });
            alert("成功删除！请刷新当前页面");

            location.reload();

        }
    }


    function checkAnswer(form) {

        var content = form.elements['answer'].value;

        if (content.length > 400 || content.length < 1) {
            alert("请正确输入答复内容，输入内容不能超过200字！");
            return;
        }

        form.action = "index.php?m=post.feedbackaddAnswer";

        form.submit();


    }


</script>
<div class="tag-tabs-holder hot-tag-selected clearfix">
    <h2 class="discovery-title clearfix">
        <a href="#" class="current">欢迎在此提出您的反馈意见.
        </a>
    </h2>
    <br></br>
</div>
<div class="tags-holder clearfix">
    <div class="tags-list-holder">
        <div class='spfeedback'>
            <form action="#" name="feedbackForm" method="post" onsubmit="checkForm(this)">
                <label for="title">标题:</label>
                <input width="200px" id="title" name="title" type="text" size=50 class="text_field big wide"/>
                <br></br>
                <textarea cols="20" name="content" onfocus="javascript:if(this.value == '请填写反馈信息')this.value = '';"
                          onblur="javascript:if(this.value.length == 0)this.value='请填写反馈信息';" class="wide"
                          style="padding:0px;margin:0px;width:600px;"/>请填写反馈信息</textarea>
                <br>
                <label>
                    <input type="radio" id="classID" name="classID" value="1" checked="checked"/>
                    体验建议
                </label>
                <label>
                    <input type="radio" id="classID" name="classID" value="2"/>
                    意见投诉
                </label>
                <label>
                    <input type="radio" id="classID" name="classID" value="3"/>
                    修成BUG
                </label>

                <input type="submit" class="posfeed" name="提交" value="反馈">
                <input type="reset" class="posfeed" name="重置" value="重置">
            </form>
        </div>
    </div>
</div>
<div class="feedbackNav">
    <ul class="classSelect">
<?php
    foreach ($classArray as $key => $value)
{
    echo '<li><a href="index.php?m=index.feedback&classID=' . $key . '">' . $value . '</a></li>';
}
    ?>
    </ul>

    <ul class="resloveSelect">
<?php
    foreach ($isReslove as $key => $value)
{
    echo '<li><a href="index.php?m=index.feedback&reslove=' . $key . '">' . $value . '</a></li>';
}
    ?>
    </ul>
</div>
<?php if (1) { ?>
<div class="users-holder clearfix">
    <?php
     foreach ($fresults as $key => $value) {
    ?>



    <div class='baolist'>
        <div class='baoleft'>
            <a target=_blank href=index.php?m=ta&uid=<?php echo $value['uid'];?>><img
                    src=<?php  if (file_exists('avatar/i_upload/' . $value['uid'] . '_small_2.jpg')) {
                    echo   BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small_2.jpg?id=' . rand(1110, 9900);
                } else if (file_exists('avatar/i_upload/' . $value['uid'] . '_small.jpg')) {
                    echo   BASE_URL . '/avatar/i_upload/' . $value['uid'] . '_small.jpg';
                } else {
                    echo  BASE_URL . 'css/bgimg/default_avatar_64.gif';
                }?>></img></a>

        </div>
        <div class='baoright'>
    <span class="title">
      标题:<?php echo APP::F('cut_str', $value['title'], 26); echo"----<b>[" . $classArray[$value['classID']] . "]</b>";?>
    </span>
    <span class="time">
      时间:<?php echo APP::F('format_time', $value['thedate']);?>
    </span>

            <div class="content">
                <?php echo APP::F('cut_str', strip_tags($value['content']), 200);?>
            </div>
            <div class="clear"></div>
            <div class="answer">
                <?php
                    if (1 == $value['reslove']) {
                echo  '<span style="color:#F00">[未解决]身旁网：感谢您的留言，我们会尽快解决！</span>';
            }
            else if (2 == $value['reslove']) {
                echo '<span style="color:#3C9">[已解决]身旁网：' . APP::F('cut_str', strip_tags($value['answer']), 200) . '</span>';
            }

                ?>
            </div>
        </div>
        <div class="baosupport">
            <a style="cursor:pointer" onclick="javascritp:feedbackSupport(<?php echo $value['id']; ?>);"><img
                    src="<?php echo BASE_URL?>images/support.jpg"></a>

            <p>顶(<span id="support_<?php echo $value['id']; ?>"><?php echo $value['support'];?></span>)</p>
        </div>

    </div>
                <?php
                    if ($userValid) {
        ?>
        <div class="clear"></div>
        <div style=" margin-bottom:24px;">
            <?php
             $answerContent = "请填写对【" . $value['title'] . "】的答复";
            if (2 == $value['reslove'] && !empty($value['answer'])) {
                $answerContent = $value['answer'];
            }

            ?>
            <form action="#" name="feedbackAnswerForm" method="post" onsubmit="checkAnswer(this)">
                <textarea cols="159" rows="3" name="answer"
                          onfocus="javascript:if(this.value == '<?php echo "请填写对【" . $value['title'] . "】的答复";?>')this.value = '';"
                          onblur="javascript:if(this.value.length == 0)this.value='<?php echo "请填写对【" . $value['title'] . "】的答复" ?>';"/><?php echo $answerContent; ?></textarea>
                <br/>
                <input type="hidden" name="id" value="<?php echo $value['id']; ?>">

                <input type="submit" name="提交" value="<?php if (2 == $value['reslove']) echo"修改"; else echo "答复" ?>"/>
                <input type="reset" name="重置"/>
                <input type="button" name="删除该反馈" value="删除该反馈信息"
                       onclick="feedbackDelete(<?php echo $value['id']; ?>,'<?php echo $value['title'] ?>')"/>
            </form>
        </div>
            <?php

    }


}
    ?>

    <div class="users-col users-col-3"></div>
</div>
    <?php }?>

<div class="pages">
<?php


    $theurl = $thisUrl . '&page';
    //$theurl="index.php?m=index.feedback".$addtype.'&page';
    $pages = APP::N('pages', $sum, $allcount, $page, $theurl); // 创建对象
    $pages->setShowPageNum(5);     // 设置显示的页数
    $pages->setCurrentIndexPage(3);   // 设置当前页在分页栏中的位置
    $pages->setFirstPageText('<<');   // 设置链接第一页显示的文字
    $pages->setLastPageText('>>');    //  设置链接最后一页显示的文字
    $pages->setPrePageText('<');   //   设置链接上一页显示的文字
    $pages->setNextPageText('>');  //    设置链接下一页显示的文字
    $pages->setPageCss('pagea');        //设置各分页码css样式的class名称
    $pages->setCurrentPageCss('pageacur');   // 设置当前页码css样式的class名称
    //$pages->setPageStyle('pagea');      设置各分页码的样式，即style属性
    //$pages->setCurrentPageStyle($style);  设置当前页码的样式，即style属性
    $pages->setLinkSymbol('=');       // 设置地址链接中页码与变量的连接符，如page=2中的“=”
    $pages->isShowFirstAndLast(true); //   设置是否显示第一页与最后一页的链接
    echo  $pages->generatePages();

    ?>
</div>

<div class="clear"></div>
</div>
</div>
<div style="height:30px;"></div>
<?php TPL::plugin('include/infooter2');?>
</body>
</html>