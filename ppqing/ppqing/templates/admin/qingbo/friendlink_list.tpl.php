<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>关键字过滤 - 微博管理 - 运营管理--power by 身旁网&拍旁轻博客</title>
    <link href="<?php echo BASE_URL;?>css/admin.css" rel="stylesheet" type="text/css"/>
    <script src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL;?>js/mgr.js"></script>
    <script>
        $(function() {
            bindSelectAll('#selectAll', '#recordList > tr > td > input[type=checkbox]');
        });

        function delSelectedConfirm() {
            var v = getSelectedValues('#recordList > tr > td > input[type=checkbox]');
            if (!v) {
                alert('最少选中其中一项');
                return;
            }
            var url = '<?php echo URL('admin/friendlink.delall', 'ids=', 'admin.php');?>' + v;
            confirmDel(url, '确认要恢复所有选中的微博吗?');
        }
    </script>
</head>
<body>
<div class="main-wrap">
    <div class="path"><span class="path-icon"></span>当前位置：运营管理<span> &gt; </span>轻博管理<span> &gt; </span>友情链接</div>
    <div class="set-wrap">
        <h4 class="main-title">友情链接列表</h4>

        <div class="set-area-int">
            <div class="user-list-box1">
                <p class="serch-tips"><a href="<?php echo URL('admin/friendlink.add', '', 'admin.php');?>">添加友情链接</a>。
                </p>

                <form method="post" action="<?php echo URL('admin/friendlink.flist');?>">
                    <div class="serch-user">
                        <span><strong>搜索网站名：</strong></span>
                        <input name="keyword" class="input-box box-address-width" type="text"
                               value="<?php echo htmlspecialchars(V('r:keyword'));?>"/>
                        <span class="serch-btn"><input type="submit" value="搜索"/></span>
                    </div>
                </form>
            </div>
            <div class="user-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-border">
                    <colgroup>
                        <col class="checkbox-tab"/>
                        <col class="serial-number"/>
                        <col/>
                        <col class="t-time"/>
                        <col class="keyword-w1"/>
                        <col class="operate-w7"/>
                    </colgroup>
                    <thead class="td-title-bg">
                    <tr>
                        <td></td>
                        <td>编号</td>
                        <td>网站名</td>
                        <td>类型</td>
                        <td>图标</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tfoot class="tfoot-bg">
                    <tr>
                        <td colspan="6">
                            <div class="pre-next">
                                <?php if (isset($list) && is_array($list) && !empty($list)) { ?>
                                <?php echo $pager; ?>
                                <?php }?>
                            </div>
                            <input class="select-all" name="slectALL" id="selectAll" type="checkbox" value=""/>全选
                            <a href="javascript:delSelectedConfirm()">删除所选链接</a>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody id="recordList">
                    <?php if (isset($list) && is_array($list) && !empty($list)) {
                        foreach ($list as $key => $row) { ?>
                        <tr>
                            <td><input name="1" type="checkbox" value="<?php echo $row['fid'];?>"/></td>
                            <td><?php echo $offset + $key + 1;?></td>
                            <td><?php echo htmlspecialchars($row['name']);?></td>
                            <td><?php echo htmlspecialchars($row['types']);?></td>
                            <td><?php if ($row['logo']) {
                                echo "<img width=88 height=28 src=" . $row['logo'] . "></img>";
                            }?></td>
                            <td><a class="del-icon" title="删除"
                                   href="javascript:confirmDel('<?php echo URL('admin/friendlink.del', 'id=' . $row['fid'], 'admin.php');?>','确认要删除该关键字吗?')">删除</a>
                            </td>
                        </tr>
                            <?php }
                    } else { ?>
                    <tr>
                        <td colspan=6 class="no-data">尚没有添加任何关键字</td>
                    </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
