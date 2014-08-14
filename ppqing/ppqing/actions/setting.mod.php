<?php
/*************************************************************
 * Created: 2010-4-1
 *
 *index 控制类
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class setting_mod
{

    function setting_mod()
    {
    }

    /**
     * 首页
     *
     *
     */
    function default_action()
    {
        //echo 'select  *  from '.$db->getTable(T_GROUP_USER).'  limit 10 ';
        //print_r($groupUser);
        //$data=APP::N('array2xml',$groupUser);
        //echo $data->getXml();


        TPL::display('setting_base');

    }

    function text()
    {
        TPL::display('text');
    }

    function setpic()
    {
        TPL::display('setting_pic');
    }

    function fristpic()
    {

        TPL::display('setting_fristpic');
    }

    function setschool()
    {
        TPL::display('setting_school');
    }

    //轻博群管理　
    function setgroupadmin()
    {
        TPL::display('setting_groupadmin');
    }

    //轻博群管理　
    function setgroup()
    {
        TPL::display('setting_group');
    }

    //个性化域名
    function domname()
    {
        TPL::display('setting_domname');
    }

    //修改密码
    function password()
    {
        TPL::display('setting_password');
    }

    //发布内容
    function add()
    {
        $userinfo = USER::get('userinfo');
        $content = V('p:content');
        $content = APP::F('sava', $content);
        if ($content) {
            $db = APP::ADP('db');
            $db->query('insert into ' . $db->getTable(T_CONTENT) . ' (data,thedate,uid) values(\'' . $content . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ')');
            USER::set('msg', '修改成功');
            $goUrl = URL('index');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            $goUrl = URL('index');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        }
    }

    //基本资料修改
    function baseadd()
    {
        $userinfo = USER::get('userinfo');
        $name = V('p:name');
        $name = APP::F('content_filter', $name);
        $content = V('p:descs');
        $content = APP::F('content_filter', $content);
        $fenlei = V('p:fenlei');
        $content = APP::F('sava', $content);
        $sign = V('p:sign');
        $sign = strip_tags($sign);
        if (V('p:fol')) {
            $fol = V('p:fol');
        } else {
            $fol = 0;
        }
        if (V('p:com')) {
            $com = V('p:com');
        } else {
            $com = 0;
        }
        if (V('p:msg')) {
            $msg = V('p:msg');
        } else {
            $msg = 0;
        }
        if ($content || $name) {
            $db = APP::ADP('db');
            $db->query('update ' . $db->getTable(T_USERS) . ' set name=\'' . $name . '\',descs=\'' . $content . '\',sign=\'' . $sign . '\',foltip=\'' . $fol . '\',comtip=\'' . $com . '\',msgtip=\'' . $msg . '\',fenlei=\'' . $fenlei . '\'  where uid=' . $userinfo ['uid']);
            $goUrl = URL('setting');
            USER::set('msg', '修改成功');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            $goUrl = URL('setting');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        }

    }

    //校园部基本资料
    function schooladd()
    {
        $userinfo = USER::get('userinfo');
        $name = V('p:name');
        $descs = V('p:descs');
        $sex = V('p:sex');
        $school = V('p:school');
        $grade = V('p:grade');
        $xueli = V('p:xueli');
        $profession = V('p:profession');
        $descs = APP::F('sava', $descs);
        if ($name && $descs && $sex && $school && $grade) {
            $db = APP::ADP('db');
            $row = $db->query('select * from ' . $db->getTable(T_SCHOOL) . '  where uid=' . $userinfo ['uid']);
            if (file_exists('avatar/i_upload/' . $userinfo ['uid'] . '_small.jpg')) {
                if (!$row) {
                    $db->query('insert into  ' . $db->getTable(T_SCHOOL) . '(uid,realname,sex,school,grade,xueli,profession,desc_school)values(' . $userinfo ['uid'] . ',\'' . $name . '\',\'' . $sex . '\',\'' . $school . '\',\'' . $grade . '\',\'' . $xueli . '\',\'' . $profession . '\',\'' . $descs . '\')');
                } else {
                    $db->query('update ' . $db->getTable(T_SCHOOL) . ' set realname=\'' . $name . '\',sex=\'' . $sex . '\',school=\'' . $school . '\',desc_school=\'' . $descs . '\' ,grade=\'' . $grade . '\' ,xueli=\'' . $xueli . '\' ,profession=\'' . $profession . '\'   where uid=' . $userinfo ['uid']);
                }
                USER::set('msg', '申请成功');
                $goUrl = URL('setting.setschool');

                //header('Location:index.php?m=index');
                APP::redirect($goUrl, 4);

            } else {
                USER::set('msg', '先上传头像');
                $goUrl = URL('setting.setpic');

                //header('Location:index.php?m=index');
                APP::redirect($goUrl, 4);
            }

        } else {
            $goUrl = URL('setting.setschool');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        }

    }

    //轻博群创建
    function groupadd()
    {
        $userinfo = USER::get('userinfo');
        $name = V('p:name');
        $gid = V('p:gid');
        $descs = V('p:descs');
        $open = V('p:open');
        $types = V('p:types');
        $face = V('p:face');
        $gidimg = V('f:gidimg');
        $img = APP::N('upload');
        $db = APP::ADP('db');

        if ($name && $descs) {

            $row = $db->query('select count(*) as count from ' . $db->getTable(T_GROUP_CONFIG) . '  where uid=' . $userinfo ['uid']);
            if ($row [0] ['count'] < 4) {
                if ($gid) {
                    $db->query('update ' . $db->getTable(T_GROUP_CONFIG) . ' set gname=\'' . $name . '\',open=\'' . $open . '\',face=\'' . $face . '\',descs=\'' . $descs . '\',types=\'' . $types . '\',maxnum=500   where gid=' . $gid . ' and uid=' . $userinfo ['uid']);

                } else {
                    $db->query('insert into  ' . $db->getTable(T_GROUP_CONFIG) . '(uid,gname,open,face,descs,types,maxnum)values(' . $userinfo ['uid'] . ',\'' . $name . '\',\'' . $open . '\',\'' . $face . '\',\'' . $descs . '\',\'' . $types . '\',500)');
                    $insertid = $db->getInsertId();
                }
                $file = $img->do_upload('gidimg');
                if ($gid) {
                    $img->make_thumb('var/upload/pic/' . $file, 'var/upload/group/' . $gid . '.jpg', 140, 140);
                } else {
                    $img->make_thumb('var/upload/pic/' . $file, 'var/upload/group/' . $insertid . '.jpg', 140, 140);
                }
                unlink('var/upload/pic/' . $file);
            }

            $goUrl = URL('setting.setgroupadmin');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        } else {
            $goUrl = URL('setting.setgroupadmin');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        }

    }

    //个性化域名
    function domnameadd()
    {
        $userinfo = USER::get('userinfo');
        $name = V('p:name');
        $name = str_replace(array('-', '#', '<', '[', '{', '>', ']', '}'), array('', '', '', '', '', '', '', ''), $name);
        $name = APP::F('cut_str', $name, 12);
        if ($name && !is_numeric($name)) {
            $db = APP::ADP('db');
            $row = $db->query('select * from ' . $db->getTable(T_USERS) . '  where domname=\'' . $name . '\'');
            if (!$row)
                $db->query('update ' . $db->getTable(T_USERS) . ' set domname=\'' . $name . '\' where uid=' . $userinfo ['uid']);
            USER::set('msg', '修改成功');
            $goUrl = URL('setting.domname');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            $goUrl = URL('setting.domname');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        }

    }

    //修改密码
    function passwordadd()
    {
        $userinfo = USER::get('userinfo');
        $oldpassword = V('p:oldpassword');
        $password = V('p:password');
        $repassword = V('p:repassword');

        if ($oldpassword && ($password == $repassword)) {
            $db = APP::ADP('db');
            $row = $db->query('select * from ' . $db->getTable(T_USERS) . '  where uid=' . $userinfo ['uid'] . ' and password=\'' . md5($oldpassword) . '\'');
            if ($row)
                $db->query('update ' . $db->getTable(T_USERS) . ' set password=\'' . md5($password) . '\' where uid=' . $userinfo ['uid']);
            $goUrl = URL('setting.password');
            USER::set('msg', '修改密码成功');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            USER::set('msg', '修改密码失败');
            $goUrl = URL('setting.password');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        }

    }

}

?>