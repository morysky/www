<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>封禁用户列表 - 用户封禁 - 运营管理--power by 身旁网&拍旁轻博客</title>
    <link href="<?php echo BASE_URL;?>css/admin.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL;?>js/admin_lib.js"></script>
    <script src="<?php echo BASE_URL;?>js/mgr.js"></script>
    <script type="text/javascript">
        function add_user() {
            $('#add_user').show();
            $("input[warntip='#errTip']").val('');
            $('#edit_class').addClass('mask');
        }

        function closeBox() {
            $("#errTip").cssDisplay(false);
            $('#add_user').hide();
            $('#edit_class').removeClass('mask');
        }

        $(function() {
            bindSelectAll('#selectAll', '#recordList > tr > td > input[type=checkbox]');
        });

        function delSelectId(url) {
            var $checkbox = $('#recordList > tr > td > input[type=checkbox]:checked');
            var ids;
            for (var i = 0; i < $checkbox.length; i++) {
                if (ids)
                    ids += ',' + $checkbox.eq(i).val();
                else
                    ids = $checkbox.eq(i).val();
            }
            //alert(url+'&uids='+ids);
            if (ids)
                confirmDel(url + '&ids=' + ids, '您确定要处理这些数据吗？');
            else
                window.href = "#";
        }
    </script>
</head>
<body>
<div class="main-wrap">
    <div class="path"><span class="path-icon"></span>当前位置：运营管理<span> &gt; </span>封禁管理<span> &gt; </span>封禁用户列表</div>
    <div class="set-wrap">
        <h4 class="main-title"><a class="add-new-authenticateuser" href="javascript:add_user();"></a>封禁用户列表</h4>

        <div class="set-area-int">
            <div class="user-list">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table-border special ">
                    <colgroup>
                        <col class="checkbox-tab"/>
                        <col class="serial-number"/>
                        <col class="nikename"/>
                        <col class="loc"/>
                        <col class="s-time"/>
                        <col class="user-name"/>
                        <col class="operate-w6"/>
                    </colgroup>
                    <thead class="td-title-bg">
                    <tr>
                        <td></td>
                        <td>编号</td>
                        <td>昵称</td>
                        <td>微博地址</td>
                        <td>被推荐次数</td>
                        <td>操作者</td>
                        <td>操作</td>
                    </tr>
                    </thead>
                    <tfoot class="tfoot-bg">
                    <tr>
                        <td colspan="7">
                            <div class="pre-next">
                                <?php echo $pager;?>
                            </div>
                            <input name="slectALL" id="selectAll" class="select-all" type="checkbox" value=""/>全选
                            <a class="del-all"
                               href="javascript:delSelectId('<?php echo URL('admin/users.delbanall');?>');">取消所选用户的封禁</a>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody id="recordList">
                    <?php foreach ($list as $value): ?>
                    <tr>
                        <td><input name="1" type="checkbox" value="<?php echo $value['uid'];?>"/></td>
                        <td><?php echo $value['uid'];?></td>
                        <td><?php echo $value['name'];?></td>
                        <td><a href="<?php echo URL('ta', 'uid=' . $value['uid'], 'index.php');?>"
                               target="_blank"><?php echo $value['name'];?></a></td>
                        <td><?php echo $value['tui'];?></td>
                        <td>管理员</td>
                        <td><a class="renzheng-n"
                               href="<?php echo URL('admin/users.ban', 'id=' . $value['uid'] . '&ban=0');?>">取消封禁</a>
                        </td>
                    </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="pop-float win-tips-add fixed-pop" id="add_user" style="display:none">
        <div class="pop-t">
            <div></div>
        </div>
        <div class="pop-m">
            <div class="pop-inner">
                <h4><a class="clos" href="javascript:closeBox();"></a>添加新的认证用户</h4>

                <div class="add-float-content">
                    <form action="<?php echo URL('admin/user_verify.authentication');?>" method="post"
                          name="add-newlink" id="form1">
                        <div class="float-info">
                            <label>
                                <p>请输入新成员的昵称：</p>
                                <input name="nick" class="input-box pop-w7" type="text" value=""
                                       vrel="sz=max:10,m:不能多于10个汉字|ne=m:不能为空" warntip="#errTip"/><span id="errTip"
                                                                                                       class="a-error hidden"></span>
                            </label>
                        </div>
                        <div class="float-button">
                            <span class="float-button-y"><input type="submit" name="确定" value="确定"/></span>
                            <span class="float-button-n"><input type="button" name="取消" value="取消"
                                                                onclick="closeBox();"/></span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="pop-inner-bg"></div>
        </div>
        <div class="pop-b">
            <div></div>
        </div>
    </div>

</div>
<div id="edit_class"></div>
<script type="text/javascript">
    var valid = new Validator({
        form: '#form1'
    });
</script>
</body>
</html>
