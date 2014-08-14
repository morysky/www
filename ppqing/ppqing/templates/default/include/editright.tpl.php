<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 editright.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$mtags = V('g:mtags');
?>

<div class='advanced_option'>
    <select name='sercet' style='width: 200px;'>
        <option value='0'   <?php if ($thinfo) {
            if ($thinfo[0]['sercet'] != 1) echo 'selected';
        }?>>公开
        </option>
        <option value='1'  <?php if ($thinfo) {
            if ($thinfo[0]['sercet'] != 0) echo 'selected';
        }?>>私有
        </option>
    </select>
    <script>

    </script>
</div>
<div class="advanced_option" id="set_tags">
    <p>

    <div id='tagsdiv'>
        <div id='tagsshow'>
            <u id='post-tag-list' class='clearfix'>

            </u>
        </div>
        <input name="tagsinput" id="tagsinput" style="overflow-y:hidden" class=""　onBlur="if(this.value==''){this.value='在此填写标签,空格确定...';this.style.color='#ccc';}else{this.style.color='#333';};"
        style="COLOR: #ccc" onFocus="this.style.color='#333';if(value=='在此填写标签,空格确定...') {value=''}"
        value='在此填写标签,空格确定...'></input>

        <input name='tags' id='tags' value="<?php echo $mtags;?>" type='hidden'></input>
    </div>
</div>

<script>

    $(function() {


        $('#tagsinput').bind("keyup",
                function(event) {
                    var value1 = $('#tagsinput').val();
                    value = $.trim(value1);
                    if (event.keyCode == 32 && value.length > 1 && value1 != value) {
                        $('#post-tag-list').append('<li tag="' + value + '"><span>' + value + '</span><a href="#" class="delete-tag-btn" title="删除">x</a></li>')
                        $('.delete-tag-btn:last').click(function() {
                            var delvalue = $(this).parent().attr('tag');
                            $(this).parent().remove();
                            var newvar = $('#tags').val().replace(delvalue, "");
                            $('#tags').val(newvar);
                        });
                        $('#tags').val($('#tags').val() + " " + value);
                        var value = $('#tagsinput').val('');
                    }
                }).bind('blur', function() {
                    var value = $('#tagsinput').val();
                    value = $.trim(value);
                    if (value.length > 1) {
                        $('#post-tag-list').append('<li tag="' + value + '"><span>' + value + '</span><a href="#" class="delete-tag-btn" title="删除">x</a></li>')
                        $('.delete-tag-btn:last').click(function() {
                            var delvalue = $(this).parent().attr('tag');
                            $(this).parent().remove();
                            var newvar = $('#tags').val().replace(delvalue, "");
                            $('#tags').val(newvar);
                        });
                        $('#tags').val($('#tags').val() + " " + value);
                        var value = $('#tagsinput').val('');
                    }
                });
    })


</script>
    
  