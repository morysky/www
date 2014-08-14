<!DOCTYPE html>
<!-- saved from url=(0047)http://www.diandian.com/n/common/toolbar/169368 -->
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<div id="control_panel" style="position:absolute; right:0; top:0; z-index:9999;">
    <script>
        window.isPosting = false;
        function doPost(op) {
            if (isPosting) {
                return;
            }
            isPosting = true;
// 这里可以考虑一下遮盖
            document.getElementById("op").value = op;
            document.getElementById("commonForm").submit();
        }
        function delPost(feedId) {
            if (!confirm("是否要删除这篇文章?")) {
                return;
            }
            doPost('del');
        }
    </script>
    <form id="commonForm" method="post" action="./未命名_files/169368.htm" style="display:none" target="_self">
        <input id="op" type="hidden" name="op">
        <input type="hidden" name="blogId" value="169368">
        <input type="hidden" name="formKey" value="a12e4bc9964135c70fceeb0eb355ec2e"></form>
    <!-- 回首页 -->
    <a href="http://www.diandian.com/" target="_top"
       style="margin-left:5px;display:block;float:right;width:80px;height:26px;background:url(&#39;http://static.libdd.com/img/theme/common/nav-icons.png?ver=5.png&#39;) no-repeat -286px 0;_background-image:url(&#39;http://static.libdd.com/img/theme/common/nav-icons-ie6.png?ver=5.png&#39;);"></a><!-- 关注 -->
    <!-- 自定义 -->
    <a target="_top" href="http://www.diandian.com/customize/shenpang"
       style="margin-left:5px;display:block;float:right;width:65px;height:26px;background:url(&#39;http://static.libdd.com/img/theme/common/nav-icons.png?ver=5.png&#39;) no-repeat 0 0;_background-image:url(&#39;http://static.libdd.com/img/theme/common/nav-icons-ie6.png?ver=5.png&#39;);"></a><!-- 转载 -->
    <!-- 是否收藏过 --><!-- 编辑和删除 --><!-- 推荐 -->
    <a target="_top" href="http://www.diandian.com/explore/hot/recommend/shenpang.diandian.com"
       style="margin-left:5px;display:block;float:right;width:51px;height:26px;background:url(&#39;http://static.libdd.com/img/theme/common/nav-icons.png?ver=5.png&#39;) no-repeat -511px 0;_background-image:url(&#39;http://static.libdd.com/img/theme/common/nav-icons-ie6.png?ver=5.png&#39;);"></a>
</div>


</body>
</html>