<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>评论列表 - 评论管理 - 运营管理--power by 身旁网&拍旁轻博客</title>
    <link href="<?php echo BASE_URL;?>css/admin.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/admin_lib.js"></script>
    <script type="text/javascript">
        <!--
        function MM_jumpMenu(targ, selObj, restore) { //v3.0
            eval(targ + ".location='" + selObj.options[selObj.selectedIndex].value + "'");
            if (restore) selObj.selectedIndex = 0;
        }

        $(function() {
            new Validator({
                form: '#searchUser'
            });
        });

        //-->
    </script>
</head>
<body>
<div class="main-wrap">
    <div class="path"><span class="path-icon"></span>当前位置：运营管理<span> &gt; </span>评论管理<span> &gt; </span>评论列表</div>
    <div class="set-wrap">
        <h4 class="main-title">评论列表</h4>

        <div class="set-area-int">
            <div class="user-list-box1">
                <p class="serch-tips">请输入标题搜索评论，然后选择相应的添加操作</p>

                <div class="serch-user">
                    <form action="<?php echo URL('admin/qingbo.etags');?>" id="searchUser" method="post">
                        <span><strong>搜索包含以下评论内容：</strong></span>
                        <span><input name="keyword" class="input-box box-address-width" type="text"
                                     vrel="sz=max:10,m:请限制在10个中文或20个英文以下。|ne" warntip="#nameTip"/></span>
                        <span class="serch-btn"><input name="" type="submit" value="搜索"/></span>
                        <span class="a-error hidden" id="nameTip"></span>
                    </form>
                </div>
            </div>
            <div class="user-list">
                <p><?php if ($nickname): ?>您的搜索结果如下：<?php else: ?>总计<span><?php echo $count;?></span>
                    个，列表如下：<?php endif;?></p>
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-border">
                    <colgroup>
                        <col class="serial-number"/>
                        <col/>
                        <col class="t-time"/>
                        <col class="common-w1"/>
                        <col class="common-w1"/>
                        <col class="operate-w3"/>
                    </colgroup>
                    <thead class="td-title-bg">
                    <tr>
                        <td>编号</td>
                        <td>评论</td>
                        <td>用户</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tfoot class="tfoot-bg">
                    <tr>
                        <td colspan="6">
                            <div class="pre-next">
                                <!--<form name="form" id="form"><div style="float:left;">
                                        <a class="pre" href="">上一页</a><a class="next" href="">下一页</a></div>
                                        <select name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
                                              <option>1/2</option>
                                              <option>2/2</option>
                                        </select>
                                    </form>-->
                                <?php echo $pager;?>
                            </div>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php if ($list): ?>
                        <?php foreach ($list as $value): ?>
                        <tr>
                            <td><?php echo $value['cid'];?></td>
                            <td><?php echo $value['cdata'];?></td>
                            <td><?php echo $value['uname'];?></td>
                            <td>
                                <a href="<?php  echo URL('show', 'id=' . $value['did'], 'index.php');?>"
                                   class="view-weibo" target="_blank">查看内容</a>
                                <a href="<?php echo URL('admin/qingbo.delcomment', 'id=' . $value['cid'] . '&ban=1');?>"
                                   class="del-icon">删除</a>
                            </td>
                        </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-data">没有搜索到任何记录</td>
                    </tr>
                        <?php endif;?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
</body>
</html>
