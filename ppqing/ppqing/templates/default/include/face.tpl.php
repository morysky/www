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
$uid = $SPuid;
if ($userinfo && (($m == 'ta') || ($m == 'show'))) {
    $base_dir = "css/";
    $fso = opendir($base_dir);
    $themes = array();
    $i = 1;
    while ($flist = readdir($fso)) {

        if (preg_match('/(.*)_skin/i', $flist, $match)) {
            $themes[$i] = $match[1];
            $i++;
        }

    }
    $tplArr = false;
    if (file_exists('usercss/' . $uid . '.tpl')) {
        $tpl = file_get_contents('usercss/' . $uid . '.tpl');
        $tplArr = unserialize($tpl);
    }
    ?>
<div class='facetop' id='facetop2'>
    <div class='facecss' style="float:left;margin-left:4px;text-align:left;padding-left:8px;">
        <b>自定义css</b>

        <p>
            <textarea id='mycss' rows="10" cols="80"><?php if ($tplArr) {
                echo $tplArr['mycss'];
            }?></textarea>
    </div>
    <div class='facecss' style="loat:left;margin-left:20px;padding-left:8px;">
        <div style='padding-left:20px;'>
            <b>颜色设定</b>

            <p>

            <div class='faceitem'>
                全局背景图片url: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor1url'];
            }?>" id="nowColor1url"/> 全局背景: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor1'];
            }?>" id="nowColor1"/> <span style='width:0px;height:0px;border-left:18px solid red'>  </span> <a
                    href="javascript:;" onclick="colorSelect('nowColor1','pageColorViews',event)">点我</a></div>

            <div class='faceitem'>
                body背景图片url: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor2url'];
            }?>" id="nowColor2url"/> body背景: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor2'];
            }?>" id="nowColor2"/> <span style='width:0px;height:0px;border-left:18px solid red'>          </span> <a
                    href="javascript:;" onclick="colorSelect('nowColor2','pageColorViews',event)">点我</a></div>

            <div class='faceitem'>
                container背景图片url: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor3url'];
            }?>" id="nowColor3url"/> container背景: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor3'];
            }?>" id="nowColor3"/> <span style='width:0px;height:0px;border-left:18px solid red'>          </span> <a
                    href="javascript:;" onclick="colorSelect('nowColor3','pageColorViews',event)">点我</a></div>

            <div class='faceitem'>
                content背景图片url: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor4url'];
            }?>" id="nowColor4url"/> content背景: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor4'];
            }?>" id="nowColor4"/> <span style='width:0px;height:0px;border-left:18px solid red'>          </span> <a
                    href="javascript:;" onclick="colorSelect('nowColor4','pageColorViews',event)">点我</a></div>


            <div class='faceitem'>
                left_column背景图片url: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor5url'];
            }?>" id="nowColor5url"/> left_column背景: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor5'];
            }?>" id="nowColor5"/> <span style='width:0px;height:0px;border-left:18px solid red'>          </span> <a
                    href="javascript:;" onclick="colorSelect('nowColor5','pageColorViews',event)">点我</a></div>

            <div class='faceitem'>
                right_column背景图片url: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor6url'];
            }?>" id="nowColor6url"/> right_column背景: <input type="text" value="<?php if ($tplArr) {
                echo $tplArr['nowColor6'];
            }?>" id="nowColor6"/> <span style='width:0px;height:0px;border-left:18px solid red'>          </span> <a
                    href="javascript:;" onclick="colorSelect('nowColor6','pageColorViews',event)">点我</a></div>
        </div>
    </div>
    <div style="height:10px;"></div>
    <button style="margin:10px;width:100px;" onclick="postcss();" id="save_button" class="positive" type="submit">
        <span id="create_post_button_label">确定</span>
    </button>
    <div style="height:10px;"></div>
</div>
<div class='facetop' id='facetop'>
    <?php
    foreach ($themes as $thkey => $thvalue) {
        ?>
        <span class='facespan'><img style="cursor:hand" onclick='setdbface("<?php echo $thvalue;?>")'
                                    src='<?php echo BASE_URL;?>css/<?php echo $thvalue;?>_skin/thumbpic.png'> </span>

        <?php } ?>
</div>
<?php } ?>


