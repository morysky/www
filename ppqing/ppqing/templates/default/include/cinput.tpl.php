<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 input.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$did = V('g:id');
$reuid = V('g:reuid');
if ($reuid) {
    $db = APP :: ADP('db');
    $rerows = $db->query('select * from ' . $db->getTable(T_USERS) . ' where uid=' . $reuid);
}
?>

<div class="commentBox">
    <b class='getreply'><?php if ($reuid) { ?>
        给好友(<?php echo  '<a style="color:#ffffff" href=index.php?m=ta&uid=' . $rerows[0]['uid'] . ' >' . $rerows[0]['name'] . '</a>'; ?>
        )回复<?php } else { ?>评论：(留下点什么)<?php }?></b>

    <p>

    <form id="miniblog_publish" action="index.php?m=post.comment" method="post">

        <textarea name="gently_editor" id="post_two" style="height:40px;" class="wide"
                  style='overflow-y:hidden'></textarea>

        <div style="height:2px;"></div>
        <input type='hidden' name='did' value=<?php echo $did;?>></input>
        <?php if ($reuid) { ?><input type='hidden' name='reuid' value=<?php echo $reuid;?>></input><?php }?>
        <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                id="save_button" class="positive" type="submit">
            <img alt="" src="http://assets.tumblr.com/images/check.png">
            <span id="create_post_button_label">评论</span>
        </button>
        <button style="margin:10px;width:100px;" onclick="this.blur(); is_preview = false; return true;"
                id="save_button" class="positive" type="reset">
            <img alt="" src="http://assets.tumblr.com/images/check.png">
            <span id="create_post_button_label">重置</span>
        </button>
    </form>
</div>
        
      