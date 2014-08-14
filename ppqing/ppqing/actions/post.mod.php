<?php
/*************************************************************
 * Created: 2010-4-1
 *
 *index 控制类
 *
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class post_mod
{

    function post_mod()
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
        TPL::display('index');

    }

    //加载text模板
    function text()
    {
        TPL::display('text');
    }

    //加载photo模板
    function photo()
    {
        TPL::display('photo');
    }

    //加载quote模板
    function quote()
    {
        TPL::display('quote');
    }

    //加载link模板
    function link()
    {
        TPL::display('link');
    }

    //加载chat模板
    function chat()
    {
        TPL::display('chat');
    }

//加载音乐模板
    function audio()
    {
        TPL::display('audio');
    }

//加载视频模板
    function video()
    {
        TPL::display('video');
    }

    //推荐博客
    function recommendadd()
    {
        TPL::display('recommendadd');

    }

//推荐博客
    function recommendqunadd()
    {
        TPL::display('recommendqunadd');

    }

    function fristarticle()
    {
        TPL::display('fristarticle');
    }

    //增加推荐博客
    function recomadd()
    {
        $userinfo = USER::get('userinfo');
        $tuid = V('p:tuid');
        $guid = V('g:guid');
        if ($guid) $tuid = $guid;
        if ($tuid && is_numeric($tuid)) {
            $db = APP::ADP('db');
            $row = $db->query('select * from ' . $db->getTable(T_RECOMMEND) . ' where uid=' . $userinfo['uid'] . ' and tuid=' . $tuid);
            if (!$row || ($userinfo['uid'] == 90)) {

                if ($userinfo['uid'] == 90) {
                    $db->query('update ' . $db->getTable(T_USERS) . ' set tui=tui+100 where uid=' . $tuid);
                } else {
                    $db->query('insert into ' . $db->getTable(T_RECOMMEND) . ' (uid,tuid) values(' . $userinfo['uid'] . ',' . $tuid . ')');
                    $db->query('update ' . $db->getTable(T_USERS) . ' set tui=tui+1 where uid=' . $tuid);
                }
                $goUrl = URL('index.recommend');
                //header('Location:index.php?m=index');
                APP::redirect($goUrl, 4);
            }
        }
        $goUrl = URL('index.recommend');
        //header('Location:index.php?m=index');
        APP::redirect($goUrl, 4);

    }

    //增加推荐博客
    function recomqunadd()
    {
        $userinfo = USER::get('userinfo');
        $tuid = V('p:tuid');
        $guid = V('g:guid');
        if ($guid) $tuid = $guid;
        if ($tuid && is_numeric($tuid)) {
            $db = APP::ADP('db');

            if ($userinfo['uid'] == 90) {
                $db->query('update ' . $db->getTable(T_GROUP_CONFIG) . ' set tuinum=tuinum+100 where gid=' . $tuid);
            } else {
                $db->query('update ' . $db->getTable(T_GROUP_CONFIG) . ' set tuinum=tuinum+1 where gid=' . $tuid);
            }
            $goUrl = URL('index.recommendqun');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
        $goUrl = URL('index.recommendqun');
        //header('Location:index.php?m=index');
        APP::redirect($goUrl, 4);

    }

    /* 发表反馈信息 */
    function feedbackadd()
    {

        /* 获取用户信息 */
        $userinfo = USER::get('userinfo');
        /* 反馈标题 */
        $title = V('p:title');
        $title = APP::F('sava', $title);
        /* 反馈的内容 */
        $content = V('p:content');
        $content = APP::F('sava', $content);
        $classID = V('p:classID');

        if ($content) {
            $db = APP :: ADP('db');
            $db->query('insert into ' . $db->getTable(T_FEEDBACK) . ' (uid,title,content,thedate,classID) values(\'' . $userinfo['uid'] . '\',\'' . $title . '\',\'' . $content . '\',\'' . date('Y-m-d H:i:s') . '\',\'' . $classID . '\')');
            $goUrl = URL('index.feedback');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
        else
        {
            $goUrl = URL('index.feedback');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
    }

    function feedbackSupport()
    {
        $id = V('p:id');
        if ($id) {
            $db = APP :: ADP('db');
            $db->query('update ' . $db->getTable(T_FEEDBACK) . ' set support = support +1 where id = ' . $id);
        }

    }


    function feedbackaddAnswer()
    {
        $id = V('p:id');
        $answer = V('p:answer');
        $answer = APP::F('sava', $answer);
        $goUrl = URL('index.feedback');
        if (!empty($answer) && $id) {
            $db = APP :: ADP('db');
            $goUrl = URL('index.feedback');


            $db->query('update ' . $db->getTable(T_FEEDBACK) . ' set answer = "' . $answer . '", reslove = 2 where id = ' . $id);
            $goUrl = URL('index.feedback');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
        else
        {
            $goUrl = URL('index.feedback');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        }


    }


    /* 反馈删除记录 */
    function feedbackDelete()
    {
        $id = V('p:id');
        if ($id) {
            $db = APP :: ADP('db');
            $db->query('delete from ' . $db->getTable(T_FEEDBACK) . ' where id = ' . $id);

        }
        $goUrl = URL('index.feedback');
        //		header('Location:index.php?m=index');
        APP::redirect($goUrl, 4);

    }


    //发布内容
    function textadd()
    {
        $userinfo = USER::get('userinfo');
        $content = V('p:gently_editor');

        $title = V('p:title');
        $sercet = V('p:sercet');
        $tags = V('p:tags');
        if ($tags == '多个标签用空格隔开(写上标签,你们文章将会出现在标签客厅)') $tags = '';
        $did = V('p:did');
        $title = APP::F ( 'sava', $title );
        $content = APP::F('sava', $content);
        $content = APP::F('pictolocal', $content);
        if (empty($title)) {
            $title = APP::F('cut_str', strip_tags($content), '18');
        }
        $db = APP::ADP('db');
        $rowr = $db->query('select * from ' . $db->getTable(T_CONTENT) . ' where did=' . $did);
        if ($content && $title && $did && ($rowr[0]['uid'] == $userinfo['uid'] || $userinfo['uid'] == 1 || $userinfo['uid'] == 90)) {

            $db->query('update  ' . $db->getTable(T_CONTENT) . ' set title=\'' . mysql_escape_string($title) . '\',  data=\'' . mysql_escape_string($content) . '\', sercet=\'' . $sercet . '\'  where did=' . $did);
            CACHE::delete($userinfo ['uid'] . '_1');
            CACHE::delete($userinfo ['uid'] . '_my_1');
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        } else if ($content && $title) {

            $db->query('insert into ' . $db->getTable(T_CONTENT) . ' (title,types,data,thedate,uid,sercet) values(\'' . mysql_escape_string($title) . '\',1,\'' . mysql_escape_string($content) . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ',' . $sercet . ')');
            if ($tags) {
                $insertrow = $db->getInsertId();
                $tagsArr = explode(' ', $tags);

                foreach ($tagsArr as $key => $value) {
                    $tagrow = $db->query('select * from ' . $db->getTable(T_TAGS) . ' where tarname=\'' . $value . '\'');
                    if ($tagrow) {
                        $db->query('update  ' . $db->getTable(T_TAGS) . ' set num=num+1 where tarname=\'' . $value . '\'');

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $tagrow[0]['tarid'] . ',' . $userinfo['uid'] . ')');
                    } else {
                        $db->query('insert into  ' . $db->getTable(T_TAGS) . '(tarname,num) values(\'' . $value . '\',1)');
                        $inserttagid = $db->getInsertId();

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $inserttagid . ',' . $userinfo['uid'] . ')');
                    }
                }

            }
            CACHE::delete($userinfo ['uid'] . '_1');
            CACHE::delete($userinfo ['uid'] . '_my_1');
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {

            USER::set('msg', '发表失败');
            $goUrl = URL('post.text');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
    }

    //发布内容
    function fristtextadd()
    {
        $userinfo = USER::get('userinfo');
        $content = V('p:content');
        $title = V('p:title');
        $title = APP::F ( 'sava', $title );

        $content = APP::F('sava', $content);
        $title = '我的开场白:' . $title;
        if ($content && $title) {
            $db = APP::ADP('db');
            $db->query('insert into ' . $db->getTable(T_CONTENT) . ' (title,types,data,thedate,uid,sercet) values(\'' . mysql_escape_string($title) . '\',1,\'' . mysql_escape_string($content) . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ',0)');


            CACHE::delete($userinfo ['uid'] . '_1');
            CACHE::delete($userinfo ['uid'] . '_my_1');
            //$goUrl = URL ( 'index' );
            //	if(USER::get('spschool')==1)$goUrl = URL ( 'school' );
            //header('Location:index.php?m=index');
            //APP::redirect ( $goUrl, 4 );
            echo '<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				<head>
				<body><b style="color:#273F5E;font-size:28px;padding-left:80px;padding-top:80px;">恭喜你!你的开场白发表成功!请关闭窗口!</b></body></html>';
        } else {
            echo '<html>
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				<head>
				<body><b style="color:#273F5E;font-size:36px;padding-left:80px;padding-top:80px;">开场表发表不成功,<a href=index.php?m=post.fristarticle>请返回<a></b></body></html>';
        }
    }

    //发布图片
    function photoadd()
    {

        $userinfo = USER::get('userinfo');
        $file = $_FILES['Files'];
        $sercet = V('p:sercet');
        $tags = V('p:tags');
        $fileArr = array();
        $inputArr = array();
        foreach ($_POST as $key => $value) {
            if (preg_match('/pimg(.*)+pimg/isU', $key, $matches)) {
                $path = 'var/upload/photo/' . $userinfo['uid'] . '/' . date('Y-m-d') . '/';
                if (!is_dir($path)) {
                    APP::F('mkdirs', $path);
                }
                $valueto = str_replace('uploads/', $path, $value);
                rename($value, $valueto);
                $value2 = str_replace("_small", "", $value);
                $valueto2 = str_replace("_small", "", $valueto);
                rename($value2, $valueto2);
                $fileArr[] = str_replace("_small", "", $valueto);
                $fileAllSmall[] = $valueto;


            }
            if (preg_match('/pinput(.*)+pinput/isU', $key, $matches)) {
                $inputArr[] = APP::F('sava', $value);

            }
        }

        if ($tags == '多个标签用空格隔开(写上标签,你们文章将会出现在标签客厅)') $tags = '';
        $alldata = array($fileArr, $fileAllSmall, $inputArr);
        $serfile = serialize($alldata);
        $content = V('p:gently_editor');
        $content = APP::F('sava', $content);
        $content = strip_tags($content);
        if (!$content) $content = "好图分享";
        if ($content && $fileArr) {
            $db = APP::ADP('db');
            $db->query('insert into ' . $db->getTable(T_CONTENT) . ' (title,types,data,thedate,uid,sercet) values(\'' . mysql_escape_string($content) . '\',2,\'' . $serfile . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ',' . $sercet . ')');
            if ($tags) {
                $insertrow = $db->getInsertId();
                $tagsArr = explode(' ', $tags);

                foreach ($tagsArr as $key => $value) {
                    $tagrow = $db->query('select * from ' . $db->getTable(T_TAGS) . ' where tarname=\'' . $value . '\'');
                    if ($tagrow) {
                        $db->query('update  ' . $db->getTable(T_TAGS) . ' set num=num+1 where tarname=\'' . $value . '\'');

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $tagrow[0]['tarid'] . ',' . $userinfo['uid'] . ')');
                    } else {
                        $db->query('insert into  ' . $db->getTable(T_TAGS) . '(tarname,num) values(\'' . $value . '\',1)');
                        $inserttagid = $db->getInsertId();

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $inserttagid . ',' . $userinfo['uid'] . ')');
                    }
                }

            }
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            //APP::redirect ( $goUrl, 4 );
        } else {
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            //APP::redirect ( $goUrl, 4 );
        }

        APP::redirect($goUrl, 4);

    }

//发布引用
    function quoteadd()
    {
        $userinfo = USER::get('userinfo');
        $content = V('p:gently_editor');
        $title = V('p:title');
        $sercet = V('p:sercet');
        $tags = V('p:tags');
        if ($tags == '多个标签用空格隔开(写上标签,你们文章将会出现在标签客厅)') $tags = '';
        $title = APP::F ( 'sava', $title );
        $content = APP::F('sava', $content);
        if ($content) {
            $db = APP::ADP('db');
            $db->query('insert into ' . $db->getTable(T_CONTENT) . ' (title,types,data,thedate,uid,sercet) values(\'' . mysql_escape_string($title) . '\',3,\'' . mysql_escape_string($content) . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ',' . $sercet . ')');
            if ($tags) {
                $insertrow = $db->getInsertId();
                $tagsArr = explode(' ', $tags);

                foreach ($tagsArr as $key => $value) {
                    $tagrow = $db->query('select * from ' . $db->getTable(T_TAGS) . ' where tarname=\'' . $value . '\'');
                    if ($tagrow) {
                        $db->query('update  ' . $db->getTable(T_TAGS) . ' set num=num+1 where tarname=\'' . $value . '\'');

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $tagrow[0]['tarid'] . ',' . $userinfo['uid'] . ')');
                    } else {
                        $db->query('insert into  ' . $db->getTable(T_TAGS) . '(tarname,num) values(\'' . $value . '\',1)');
                        $inserttagid = $db->getInsertId();

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $inserttagid . ',' . $userinfo['uid'] . ')');
                    }
                }

            }
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            CACHE::delete($userinfo ['uid'] . '_1');
            CACHE::delete($userinfo ['uid'] . '_my_1');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
    }

    //发布链接
    function linkadd()
    {
        $userinfo = USER::get('userinfo');
        $content = V('p:gently_editor');
        $title = V('p:title');
        $title = APP::F ( 'sava', $title );
        $sercet = V('p:sercet');
        $tags = V('p:tags');
        if ($tags == '多个标签用空格隔开(写上标签,你们文章将会出现在标签客厅)') $tags = '';
        $http = substr($title, 0, 7);
        $gethtml = file_get_contents($title);
        preg_match('/<title>(.*)<\/title>/i', $gethtml, $match);
        //print_r($match[1]);
        $str = $match[1];
        //		/print_r(mb_detect_encoding($str));
        if (!APP::F('is_utf8', $str)) {
            $str = mb_convert_encoding($str, "UTF-8", "GBK");
            $http = mb_convert_encoding($http, "UTF-8", "GBK");
        }
        $content = APP::F('sava', $content);
        $title = '<a target=_blank href=' . $title . ' >' . $title . '</a>(' . $str . ')';

        if ($content && $title && ($http == 'http://')) {
            $db = APP::ADP('db');
            $db->query('insert into ' . $db->getTable(T_CONTENT) . ' (title,types,data,thedate,uid,sercet) values(\'' . mysql_escape_string($title) . '\',4,\'' . mysql_escape_string($content) . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ',' . $sercet . ')');
            if ($tags) {
                $insertrow = $db->getInsertId();
                $tagsArr = explode(' ', $tags);

                foreach ($tagsArr as $key => $value) {
                    $tagrow = $db->query('select * from ' . $db->getTable(T_TAGS) . ' where tarname=\'' . $value . '\'');
                    if ($tagrow) {
                        $db->query('update  ' . $db->getTable(T_TAGS) . ' set num=num+1 where tarname=\'' . $value . '\'');

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $tagrow[0]['tarid'] . ',' . $userinfo['uid'] . ')');
                    } else {
                        $db->query('insert into  ' . $db->getTable(T_TAGS) . '(tarname,num) values(\'' . $value . '\',1)');
                        $inserttagid = $db->getInsertId();

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $inserttagid . ',' . $userinfo['uid'] . ')');
                    }
                }

            }
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            CACHE::delete($userinfo ['uid'] . '_1');
            CACHE::delete($userinfo ['uid'] . '_my_1');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
    }

//发布对话
    function chatadd()
    {
        $userinfo = USER::get('userinfo');
        $content = V('p:content');
        $sercet = V('p:sercet');
        $tags = V('p:tags');
        if ($tags == '多个标签用空格隔开(写上标签,你们文章将会出现在标签客厅)') $tags = '';
        $content = preg_replace('/[\n]+/', '<p>', $content);
        $contArr = explode('<p>', $content);
        $db = APP::ADP('db');

        $title = V('p:title');
        $title = APP::F('sava', $title);
        $content = APP::F('sava', $content);
        if ($content && $title) {

            $result = $db->query('insert into ' . $db->getTable(T_CONTENT) . ' (title,types,data,thedate,uid,sercet) values(\'' . mysql_escape_string($title) . '\',5,\'' . mysql_escape_string($content) . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ',' . $sercet . ')');
            if ($tags) {
                $insertrow = $db->getInsertId();
                $tagsArr = explode(' ', $tags);

                foreach ($tagsArr as $key => $value) {
                    $tagrow = $db->query('select * from ' . $db->getTable(T_TAGS) . ' where tarname=\'' . $value . '\'');
                    if ($tagrow) {
                        $db->query('update  ' . $db->getTable(T_TAGS) . ' set num=num+1 where tarname=\'' . $value . '\'');

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $tagrow[0]['tarid'] . ',' . $userinfo['uid'] . ')');
                    } else {
                        $db->query('insert into  ' . $db->getTable(T_TAGS) . '(tarname,num) values(\'' . $value . '\',1)');
                        $inserttagid = $db->getInsertId();

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $inserttagid . ',' . $userinfo['uid'] . ')');
                    }
                }

            }
            $insertid = $db->getInsertId();
            foreach ($contArr as $key => $value) {
                $names = explode(':', $value);
                $name = $names[0];
                $row = $db->query('select * from ' . $db->getTable(T_USERS) . ' where name=\'' . $name . '\'');
                if ($row) {
                    //$rows=$db->query('select * from '. $db->getTable ( T_TME) . ' where uid='.$row[0]['uid'].' and did='.$insertid);
                    //if(!$rows){
                    $db->query('insert into ' . $db->getTable(T_TME) . '(uid,did) values(' . $row[0]['uid'] . ',' . $insertid . ')');
                    CACHE::delete($userinfo ['uid'] . '_1');
                    CACHE::delete($userinfo ['uid'] . '_my_1');
                    //}

                }
            }
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
    }

//发布音乐
    function audioadd()
    {
        $userinfo = USER::get('userinfo');
        $content = V('p:gently_editor');
        $title = V('p:songname');
        $title = APP::F ( 'sava', $title );
        $mname = V('p:mname');
        $songname = V('p:songname');
        $songname = str_replace("+", " ", $songname);
        $sercet = V('p:sercet');
        $tags = V('p:tags');
        if ($tags == '多个标签用空格隔开(写上标签,你们文章将会出现在标签客厅)') $tags = '';
        $content = APP::F('sava', $content);
        $contents = $mname . $content;
        if (!$content) $content = '动听音乐大家听!';
        if ($content && $title) {
            $db = APP::ADP('db');
            $db->query('insert into ' . $db->getTable(T_CONTENT) . ' (title,types,data,thedate,uid,sercet) values(\'' . mysql_escape_string("好音乐大家听：" . $songname) . '\',6,\'' . mysql_escape_string($contents) . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ',' . $sercet . ')');
            if ($tags) {
                $insertrow = $db->getInsertId();
                $tagsArr = explode(' ', $tags);

                foreach ($tagsArr as $key => $value) {
                    $tagrow = $db->query('select * from ' . $db->getTable(T_TAGS) . ' where tarname=\'' . $value . '\'');
                    if ($tagrow) {
                        $db->query('update  ' . $db->getTable(T_TAGS) . ' set num=num+1 where tarname=\'' . $value . '\'');

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $tagrow[0]['tarid'] . ',' . $userinfo['uid'] . ')');
                    } else {
                        $db->query('insert into  ' . $db->getTable(T_TAGS) . '(tarname,num) values(\'' . $value . '\',1)');
                        $inserttagid = $db->getInsertId();

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $inserttagid . ',' . $userinfo['uid'] . ')');
                    }
                }

            }
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
    }

//发布视频
    function videoadd()
    {
        $userinfo = USER::get('userinfo');
        $content = V('p:gently_editor');
        $title = V('p:title');
        $title = APP::F ( 'sava', $title );
        $sercet = V('p:sercet');
        $tags = V('p:tags');
        if ($tags == '多个标签用空格隔开(写上标签,你们文章将会出现在标签客厅)') $tags = '';
        $pic = '';
        $comtents = '';
        $content = APP::F('sava', $content);
        $parseLink = parse_url($title);
        if (preg_match("/(youku.com|youtube.com|5show.com|ku6.com|sohu.com|mofile.com|sina.com.cn|tudou.com)$/i", $parseLink['host'], $hosts)) {
            $flashinfo = APP::F('getflashvar', $title, $hosts[1]);
            $tl = $flashinfo['title'];
            $comtents = '<object height="460" width="500" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"><param name="wmode" value="transparent"><param name="movie" value="' . $flashinfo['flashvar'] . '"><embed height="460" width="500" type="application/x-shockwave-flash" allowfullscreen="true" wmode="transparent" src="' . $flashinfo['flashvar'] . '"></object><P>' . $content;
            $pic = $flashinfo['img'];
        }

        if ($comtents && $tl) {
            $db = APP::ADP('db');
            $db->query('insert into ' . $db->getTable(T_CONTENT) . ' (title,img,types,data,thedate,uid,sercet) values(\'' . mysql_escape_string($tl) . '\',\'' . mysql_escape_string($pic) . '\',7,\'' . mysql_escape_string($comtents) . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ',' . $sercet . ')');
            if ($tags) {
                $insertrow = $db->getInsertId();
                $tagsArr = explode(' ', $tags);

                foreach ($tagsArr as $key => $value) {
                    $tagrow = $db->query('select * from ' . $db->getTable(T_TAGS) . ' where tarname=\'' . $value . '\'');
                    if ($tagrow) {
                        $db->query('update  ' . $db->getTable(T_TAGS) . ' set num=num+1 where tarname=\'' . $value . '\'');

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $tagrow[0]['tarid'] . ',' . $userinfo['uid'] . ')');
                    } else {
                        $db->query('insert into  ' . $db->getTable(T_TAGS) . '(tarname,num) values(\'' . $value . '\',1)');
                        $inserttagid = $db->getInsertId();

                        $db->query('replace into ' . $db->getTable(T_TAGS_CONTENT) . '(did,tarid,uid)values(' . $insertrow . ',' . $inserttagid . ',' . $userinfo['uid'] . ')');
                    }
                }

            }
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            CACHE::delete($userinfo ['uid'] . '_1');
            CACHE::delete($userinfo ['uid'] . '_my_1');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            $goUrl = URL('index');
            if (USER::get('spschool') == 1) $goUrl = URL('school');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }
    }

    //发表评论
    function comment()
    {

        $userinfo = USER::get('userinfo');
        $did = V('p:did');
        $reuid = V('p:reuid');
        $content = V('p:gently_editor');
        $content = APP::F('savacom', $content);
        if ($content) {
            $db = APP::ADP('db');
            $db->query('insert into ' . $db->getTable(T_COMMENTS) . ' (did,cdata,cdate,uid,uname,reuid) values(' . $did . ',\'' . mysql_escape_string($content) . '\',\'' . date('Y-m-d H:i:s') . '\',' . $userinfo ['uid'] . ',\'' . $userinfo ['name'] . '\',\'' . $reuid . '\')');
            $unuid = $db->query('select * from ' . $db->getTable(T_CONTENT) . '  where  did=' . $did);
            $ginfo = $db->query('select * from ' . $db->getTable(T_USERS) . ' where uid=' . $unuid[0]['uid']);
            if ($ginfo[0]['comtip'] == 1 && $unuid[0]['uid'] != $userinfo['uid']) {
                APP::F('postmailtip', $ginfo[0]['mail'], '评论提示：' . $userinfo['name'] . '评论了你的文章', '<p>你的朋友(<a href=' . BASE_URL . 'index.php?m=ta&uid=' . $userinfo['uid'] . '>' . $userinfo['name'] . '</a>) 评论了你的文章 <<' . ($unuid[0]['types'] == 2
                        ? $unuid[0]['data']
                        : $unuid[0]['title']) . '>>  请点链接:<a href=' . BASE_URL . 'index.php>进入</a>(温馨提示：可进入控制面板关闭提示）', '新评论');
            }
            $db->query('update ' . $db->getTable(T_CONTENT) . ' set cnum=cnum+1 where did=' . $did);
            $un = $db->query('select * from ' . $db->getTable(T_UNREAD) . '  where uid=' . $unuid[0]['uid']);
            if ($un) {
                if ($unuid[0]['uid'] != $userinfo['uid']) $db->query('update ' . $db->getTable(T_UNREAD) . ' set uncomment=uncomment+1 where uid=' . $unuid[0]['uid']);
                if ($reuid && $reuid != $userinfo['uid']) $db->query('update ' . $db->getTable(T_UNREAD) . ' set uncomment=uncomment+1 where uid=' . $reuid);
            } else {
                if ($unuid[0]['uid'] != $userinfo['uid']) $db->query('insert into ' . $db->getTable(T_UNREAD) . ' (uid,uncomment) values(' . $unuid[0]['uid'] . ',1 )');
                if ($reuid && $reuid != $userinfo['uid']) $db->query('insert into ' . $db->getTable(T_UNREAD) . ' (uid,uncomment) values(' . $reuid . ',1 )');
            }
            $goUrl = URL('show&id=' . $did);
            CACHE::delete($userinfo ['uid'] . '_1');
            CACHE::delete($userinfo ['uid'] . '_my_1');
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        } else {
            $goUrl = URL('show&id=' . $did);
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
        }

    }

    //删除评论
//发表评论
    function cdel()
    {

        $userinfo = USER::get('userinfo');
        $id = V('g:id');
        $cid = V('g:cid');
        $db = APP::ADP('db');
        $row = $db->query('select * from ' . $db->getTable(T_COMMENTS) . ' where cid=' . $id . ' and uid=' . $userinfo ['uid']);
        if ($row) {
            $db->query('delete from ' . $db->getTable(T_COMMENTS) . ' where cid=' . $id);
            CACHE::delete($userinfo ['uid'] . '_1');
            CACHE::delete($userinfo ['uid'] . '_my_1');
            $goUrl = URL('show&id=' . $cid);
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);
            //echo 'sucess';
        } else {
            $goUrl = URL('show&id=' . $cid);
            //header('Location:index.php?m=index');
            APP::redirect($goUrl, 4);

        }

    }


}

?>