<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
/*************************************************************
 * Created: 2010-4-1
 *
 * 模板 header.tpl.php
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
$userinfo = USER::get('userinfo');
$m = V('g:m');
?>
<style>

    #main-navigation {
        position: absolute;
        top: 2px;
        left: 30px;
    }

    #main-navigation ul {
        margin: 0 0;
    }

    #main-navigation ul li {
        float: left;
        padding-right: 20px;
        display: inline;
    }

    #main-navigation a {
        color: #fff;
        border: none;
        text-decoration: none;
    }

    #hint {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 5px 5px 5px 5px;
        color: #F3F3F3;
        font-size: 11px;
        line-height: 14px;
        padding: 5px;
        position: absolute;
        right: 10px;
        text-align: right;
        top: 40px;
        white-space: nowrap;
        width: 100px;
    }
</style>



<iframe width="630" scrolling="no" height="26" allowTransparency="true" frameborder="0" id="diandian_controls"
        style="position: fixed; _position: absolute; z-index: 65535; top: 5px; right: 5px; border: 0px none; background-color: transparent; overflow: hidden;"
        src="<?php echo BASE_URL;?>index.php?m=ta.tarighttop&guid=<?php echo $SPuid;?>&tname=<?php echo $tname;?>"></iframe>
<?php if ($userinfo && empty($tname) && ($userinfo['uid'] != $SPuid)) { ?>
<div id="main-navigation">
    <ul>
        <!--私信-->
        <li><a href="#" class="modalInput" id="<?php echo $SPuid;?>:::<?php echo $userinfo['uname'];?>:::0"
               rel="#prompt">私信</a></li>
        <!--投稿-->
    </ul>
</div>
<div class="container">

    <div id="backtotop">
    </div>
</div>

<?php } ?>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>/js/face.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>/js/color.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.lightbox-0.5.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL;?>js/jquery.corner.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>/css/jquery.lightbox-0.5.css" media="screen"/>
<script type="text/javascript" charset="utf-8" src="<?php echo BASE_URL;?>ppeditor/editor_config.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo BASE_URL;?>ppeditor/editor_ui_all.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL;?>ppeditor/themes/default/ueditor.css"/>


<script>
    function postcss() {
        var nowColor1url = $('#nowColor1url').val();
        var nowColor2url = $('#nowColor2url').val();
        var nowColor3url = $('#nowColor3url').val();
        var nowColor4url = $('#nowColor4url').val();
        var nowColor5url = $('#nowColor5url').val();
        var nowColor6url = $('#nowColor6url').val();

        var nowColor1 = $('#nowColor1').val();
        var nowColor2 = $('#nowColor2').val();
        var nowColor3 = $('#nowColor3').val();
        var nowColor4 = $('#nowColor4').val();
        var nowColor5 = $('#nowColor5').val();
        var nowColor6 = $('#nowColor6').val();
        var mycss = $('#mycss').val();

        $.ajax({
            type: "POST",
            url: "index.php?m=index.postcss",
            data: 'nowColor1url=' + nowColor1url + '&nowColor2url=' + nowColor2url + '&nowColor3url=' + nowColor3url + '&nowColor4url=' + nowColor4url + '&nowColor5url=' + nowColor5url + '&nowColor6url=' + nowColor6url + '&nowColor1=' + nowColor1 + '&nowColor2=' + nowColor2 + '&nowColor3=' + nowColor3 + '&nowColor4=' + nowColor4 + '&nowColor5=' + nowColor5 + '&nowColor6=' + nowColor6 + '&mycss=' + mycss,
            success: function(msg) {
                alert(msg);
            }
        });

    }
</script>
<!-- user input dialog -->
<div class="modal" id="prompt" style="top: 95.9px; left: 768px; position: fixed; display: none; z-index: 0; ">
    <h2>私信窗口</h2>

    <p>

    </p>

    <!-- input form. you can press enter too -->
    <form>
        <textarea name="content" id='tcont' rows="6" cols="40"
                  style="width:340px;padding:0;margin:0;border:1px solid gray;overflow:hidden"></textarea>

        <div style="padding-top:15px;">
            <button type="submit" class='btnsp'> 发送</button>
            <button type="button" class="close btnsp"> 取消</button>
        </div>
    </form>
    <br>

</div>
<script>

    // What is $(document).ready ? See: http://flowplayer.org/tools/documentation/basics.html#document_ready
    $(document).ready(function() {
        var gid = 0;
        var guser = 0;
        var gkey = 0;
        var triggers = $(".modalInput").overlay({
            // some mask tweaks suitable for modal dialogs
            mask: {
                color: '#888888',
                loadSpeed: 200,
                opacity: 0.4
            },

            closeOnClick: false
        });
        $(".modalInput").click(function(e) {
            gid = $(this).attr('id').split(":::")[0];
            guser = $(this).attr('id').split(":::")[1];
            gkey = $(this).attr('id').split(":::")[2];
        });

        var buttons = $("#yesno button").click(function(e) {

            // get user input
            var yes = buttons.index(this) === 0;

            // do something with the answer
            triggers.eq(0).html("You clicked " + (yes ? "yes" : "no"));
        });


        $("#prompt form").submit(function(e) {

            // close the overlay
            triggers.eq(gkey).overlay().close();

            // get user input

            var input = $("input", this).val();
            var textarea = $("textarea", this).val();
            var id = gid;

            var com = textarea;

            if (com) {
                $.ajax({
                    type: "POST",
                    url: "index.php?m=index.messageadd2",
                    data: "id=" + id + '&com=' + com,
                    success: function(msg) {
                        if (msg != 'sucesss') {
                            alert(msg);
                        }
                    }
                });
            }

            //alert(guser);
            // do something with the answer
            //triggers.eq(1).html(input);

            // do not submit the form
            return e.preventDefault();
        });

    });
</script>
<div id="exposeMask"
     style="position: absolute; top: 0px; left: 0px; width: 1920px; height: 959px; z-index: 9998; background-color: rgb(235, 236, 255); display: none; opacity: 0.9; "></div>

