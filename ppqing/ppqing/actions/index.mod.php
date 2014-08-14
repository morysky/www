<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *index 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class index_mod {
	
	function index_mod() {
	}
	
	/**
	 * 首页
	 *
	 *
	 */
	function default_action() {
		//echo 'select  *  from '.$db->getTable(T_GROUP_USER).'  limit 10 ';
		//print_r($groupUser);
		//$data=APP::N('array2xml',$groupUser);
		//echo $data->getXml();
		

		USER::set ( 'spschool', '0' );
		$msg = USER::set ( 'msg', '' );
		
		TPL::display ( 'index' );
	
	}
	
	function out() {
		echo APP::F ( 'cut_str', 'wesadfsdrawegaseawdvsdfserawe', '10' );
	}
	
	//发布内容
	function add() {
		$userinfo = USER::get ( 'userinfo' );
		$content = V ( 'p:gently_editor' );
		$content = APP::F ( 'sava', $content );
		if ($content) {
			$db = APP::ADP ( 'db' );
			$db->query ( 'insert into ' . $db->getTable ( T_CONTENT ) . ' (data,thedate,uid) values(\'' . $content . '\',\'' . date ( 'Y-m-d H:i:s' ) . '\',' . $userinfo ['uid'] . ')' );
			$goUrl = URL ( 'index' );
			if (USER::get ( 'spschool' ) == 1)
				$goUrl = URL ( 'school' );
				//header('Location:index.php?m=index');
			APP::redirect ( $goUrl, 4 );
		} else {
			$goUrl = URL ( 'index' );
			if (USER::get ( 'spschool' ) == 1)
				$goUrl = URL ( 'school' );
				//header('Location:index.php?m=index');
			APP::redirect ( $goUrl, 4 );
		}
	}
	
	//得到更多的内容
	function getMore() {
		
		$userinfo = USER::get ( 'userinfo' );
		$did = V ( 'g:id' );
		$type = V ( 'g:type' );
		$db = APP::ADP ( 'db' );
		$row = $db->query ( 'select * from ' . $db->getTable ( T_CONTENT ) . ' where did=' . $did );
		$row = APP::F ( 'content_filter', $row );
		if ($type == 1) {
			$row [0] ['data'] .= '<br><a style="color:#014A66" href="javascript:readlittle(' . $did . ')">返回缩略阅读</a>';
			$data = APP::F ( 'img_match', $row [0] ['data'] );
		} else {
			$data = APP::F ( 'img_match', APP::F ( 'make_text', $row [0] ['data'], $row [0] ['did'], 1 ) );
		}
		return $data;
	}
	
	//删除内容
	function del() {
		$userinfo = USER::get ( 'userinfo' );
		$did = V ( 'g:id' );
		$type = V ( 'g:type' );
		$db = APP::ADP ( 'db' );
		if ($userinfo ['uid'] == 1 || $userinfo ['uid'] == 90) {
			$row = $db->query ( 'select * from ' . $db->getTable ( T_CONTENT ) . ' where did=' . $did );
		} else {
			$row = $db->query ( 'select * from ' . $db->getTable ( T_CONTENT ) . ' where did=' . $did . ' and uid=' . $userinfo ['uid'] );
		}
		
		if ($type == 2) {
			$imagestr = $row [0] ['data'];
			$imageArr = unserialize ( $imagestr );
			foreach ( $imageArr as $key => $value ) {
				if (is_array ( $value )) {
					foreach ( $value as $pkey => $pvalue ) {
						if (file_exists ( $pvalue )) {
							unlink ( $pvalue );
						}
					}
				
				} else {
					if (file_exists ( $value )) {
						unlink ( $value );
					}
				}
			}
		} else if ($type == 1) {
			$imagestr = $row [0] ['data'];
			APP::F ( 'deltolocal', $imagestr );
		}
		
		if ($row) {
			$db->query ( 'delete from ' . $db->getTable ( T_CONTENT ) . ' where did=' . $did );
			$db->query ( 'delete from ' . $db->getTable ( T_TAGS_CONTENT ) . ' where did=' . $did );
			$goUrl = URL ( 'index' );
			if (USER::get ( 'spschool' ) == 1)
				$goUrl = URL ( 'school' );
			CACHE::delete ( $userinfo ['uid'] . '_1' );
			CACHE::delete ( $userinfo ['uid'] . '_my_1' );
			//header('Location:index.php?m=index');
			APP::redirect ( $goUrl, 4 );
			//echo 'sucess';
		} else {
			CACHE::delete ( $userinfo ['uid'] . '_1' );
			CACHE::delete ( $userinfo ['uid'] . '_my_1' );
			$goUrl = URL ( 'index' );
			if (USER::get ( 'spschool' ) == 1)
				$goUrl = URL ( 'school' );
				//header('Location:index.php?m=index');
			APP::redirect ( $goUrl, 4 );
		
		}
	}
	
	//标签客厅
	function tagexplore() {
		TPL::display ( 'tagexplore' );
	
	}
	//标签
	function tags() {
		TPL::display ( 'tags' );
	}
	
	//新进博客
	function newblog() {
		TPL::display ( 'newblog' );
	}
	
	//推荐
	function recommend() {
		TPL::display ( 'recommend' );
	}
	
	//关注
	function follow() {
		TPL::display ( 'follow' );
	
	}
	
	//wall
	function wall() {
		TPL::display ( 'newwall' );
	
	}
	
	//帮助页面
	function help() {
		TPL::display ( 'help' );
	}
	
	//友情链接
	function friendlink() {
		TPL::display ( 'friendlink' );
	}
	
	//自定义模板
	function postcss() {
		$userinfo = USER::get ( 'userinfo' );
		
		$tplcss ['nowColor1'] = V ( 'p:nowColor1' );
		$tplcss ['nowColor2'] = V ( 'p:nowColor2' );
		$tplcss ['nowColor3'] = V ( 'p:nowColor3' );
		$tplcss ['nowColor4'] = V ( 'p:nowColor4' );
		
		$tplcss ['mycss'] = V ( 'p:mycss' );
		
		$tpl = serialize ( $tplcss );
		if (file_put_contents ( 'usercss/' . $userinfo ['uid'] . '.tpl', $tpl )) {
			echo '模板已经保存,请刷新模板';
		} else {
			echo '模板写入失败';
		}
	
	}
	
	//删除自定义
	function delcss() {
		$userinfo = USER::get ( 'userinfo' );
		if (file_exists ( 'usercss/' . $userinfo ['uid'] . '.tpl' )) {
			unlink ( 'usercss/' . $userinfo ['uid'] . '.tpl' );
		}
	
	}
	//跟班
	function fans() {
		$userinfo = USER::get ( 'userinfo' );
		$db = APP::ADP ( 'db' );
		$rowuser = $db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . ' where  uid=' . $userinfo ['uid'] );
		if ($rowuser) {
			$db->query ( 'update  ' . $db->getTable ( T_UNREAD ) . ' set unfans=0 where  uid=' . $userinfo ['uid'] );
		}
		TPL::display ( 'fans' );
	
	}
	
	//反馈页面
	function feedback() {
		TPL::display ( 'feedback' );
	}
	
	//评论
	function comments() {
		$userinfo = USER::get ( 'userinfo' );
		$db = APP::ADP ( 'db' );
		$rowuser = $db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . ' where  uid=' . $userinfo ['uid'] );
		if ($rowuser) {
			$db->query ( 'update  ' . $db->getTable ( T_UNREAD ) . ' set uncomment=0 where  uid=' . $userinfo ['uid'] );
		}
		TPL::display ( 'comments' );
	
	}
	//留言
	function messages() {
		$userinfo = USER::get ( 'userinfo' );
		$db = APP::ADP ( 'db' );
		$rowuser = $db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . ' where  uid=' . $userinfo ['uid'] );
		if ($rowuser) {
			$db->query ( 'update  ' . $db->getTable ( T_UNREAD ) . ' set unmsg=0 where  uid=' . $userinfo ['uid'] );
		}
		TPL::display ( 'messages' );
	
	}
	
	//喜欢
	function like() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$db = APP::ADP ( 'db' );
		$rowuser = $db->query ( 'select * from ' . $db->getTable ( T_LIKE ) . ' where  uid=' . $userinfo ['uid'] . ' and did=' . $id );
		if ($rowuser && ($rowuser [0] ['ry'] == 1 || empty ( $rowuser [0] ['ry'] ))) {
			$db->query ( 'delete from  ' . $db->getTable ( T_LIKE ) . ' where uid=' . $userinfo ['uid'] . ' and did=' . $id );
			//$db->query('update  ' . $db->getTable ( T_CONTENT) . ' set likenum=likenum-1 where did='.$id);
			echo 'delike';
		} else if ($rowuser && ($rowuser [0] ['ry'] == 2)) {
			$db->query ( 'update ' . $db->getTable ( T_LIKE ) . ' set ry=1 where uid=' . $userinfo ['uid'] . ' and did=' . $id );
			$db->query ( 'update  ' . $db->getTable ( T_CONTENT ) . ' set likenum=likenum-1 where did=' . $id );
			echo 'hate';
		} else {
			$db->query ( 'insert into ' . $db->getTable ( T_LIKE ) . ' (uid,did,ry)values(' . $userinfo ['uid'] . ',' . $id . ',2)' );
			$db->query ( 'update  ' . $db->getTable ( T_CONTENT ) . ' set likenum=likenum+1 where did=' . $id );
			echo 'like';
		}
	
	}
	
	//不喜欢
	function delike() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$db = APP::ADP ( 'db' );
		$rowuser = $db->query ( 'select * from ' . $db->getTable ( T_LIKE ) . ' where  uid=' . $userinfo ['uid'] . ' and did=' . $id );
		if ($rowuser) {
			$db->query ( 'delete from  ' . $db->getTable ( T_LIKE ) . ' where uid=' . $userinfo ['uid'] . ' and did=' . $id );
			$db->query ( 'update  ' . $db->getTable ( T_CONTENT ) . ' set likenum=likenum-1 where did=' . $id );
		
		} else {
		
		}
		echo $id;
	
	}
	//显示评论
	function showcomment() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$db = APP::ADP ( 'db' );
		
		$results = $db->query ( 'select * ,x.uid as uid,z.name as zname  from ' . $db->getTable ( T_COMMENTS ) . ' x left join ' . $db->getTable ( T_USERS ) . ' z on x.reuid=z.uid  where  x.did=' . $id . ' order by x.cid desc limit 15 ' );
		$results = APP::F ( 'content_filter', $results );
		$html = '';
		foreach ( $results as $key => $value ) {
			$html .= '<p><span class="fb_u"><b><img src=';
			if (file_exists ( 'avatar/i_upload/' . $value ['uid'] . '_small.jpg' )) {
				$html .= BASE_URL . 'avatar/i_upload/' . $value ['uid'] . '_small.jpg';
			} else {
				$html .= BASE_URL . 'css/bgimg/default_avatar_64.gif';
			}
			$html .= ' width =20px height=20px alt="df" /></b> <a  style="color:#307DCA;margin-left:4px;" href="index.php?m=ta&uid=' . $value ['uid'] . '">' . $value ['uname'] . '</a>  :' . ($value ['zname'] ? '(回复:<a href=index.php?m=ta&uid=' . $value ['reuid'] . '>' . $value ['zname'] . '</a>)' : '') . '' . $value ['cdata'] . ($value ['uid'] ? '  <a   href=javascript:postcomment2(' . $value ['uid'] . ',"' . $value ['uname'] . '")><img src=' . BASE_URL . 'css/newimage/images/hf.png /></a>' : '');
			
			$html .= '</span>';
		}
		
		echo $html;
	}
	
	function showmessage() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$db = APP::ADP ( 'db' );
		$rows = $db->query ( 'select * from ' . $db->getTable ( T_CONTENT ) . ' where  did=' . $id );
		$uid = $rows [0] ['uid'];
		$results = $db->query ( 'select * from ' . $db->getTable ( T_MESSAGE ) . ' where  (uid=' . $uid . ' and touid=' . $userinfo ['uid'] . ') or (uid=' . $userinfo ['uid'] . ' and touid=' . $uid . ') order by mid desc limit 15 ' );
		$results = APP::F ( 'content_filter', $results );
		$html = '';
		foreach ( $results as $key => $value ) {
			$html .= '<p><span class="fb_u"><b><img src=';
			if (file_exists ( 'avatar/i_upload/' . $value ['uid'] . '_small.jpg' )) {
				$html .= BASE_URL . 'avatar/i_upload/' . $value ['uid'] . '_small.jpg';
			} else {
				$html .= BASE_URL . 'css/bgimg/default_avatar_64.gif';
			}
			$html .= ' width =20px height=20px alt="df" /></b> <a  style="color:#307DCA;margin-left:4px;" href="index.php?m=ta&uid=' . $value ['uid'] . '">' . $value ['uname'] . '</a>  :<span class="cmt-main">' . $value ['msg'] . '  ';
			
			$html .= '</span>';
		
		}
		echo $html;
	}
	
	function showforward() {
		$html = '<p><span class="fb_u">请填写转发的理由！</span>';
		echo $html;
	}
	
	function showforwardadd() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$com = V ( 'p:com' );
		$sercet = 0;
		$db = APP::ADP ( 'db' );
		if ($id & $com) {
			$rows = $db->query ( 'select * from ' . $db->getTable ( T_CONTENT ) . ' x left join ' . $db->getTable ( T_USERS ) . '  y on x.uid=y.uid  where  x.did=' . $id );
			$data = '<span style="font-size:18px;">转发:<a href=index.php?m=ta&uid=' . $rows [0] ['uid'] . '>' . $rows [0] ['name'] . '</a> 的   <a href=index.php?m=show&id=' . $id . '>' . $rows [0] ['title'] . '<a></span><p>';
			$db->query ( 'insert into ' . $db->getTable ( T_CONTENT ) . ' (title,types,forid,data,thedate,uid,sercet) values(\'' . mysql_escape_string ( $com ) . '\',8,' . $id . ',\'' . mysql_escape_string ( $content ) . '\',\'' . date ( 'Y-m-d H:i:s' ) . '\',' . $userinfo ['uid'] . ',' . $sercet . ')' );
			$getInsertId = $db->getInsertId ();
			$inrow = $db->query ( 'select * from ' . $db->getTable ( T_CONTENT ) . ' x left join ' . $db->getTable ( T_USERS ) . '  y on x.uid=y.uid  where  x.did=' . $getInsertId );
			if ($rows [0] ['types'] == 2) {
				$imagesall = unserialize ( $rows [0] ['data'] );
				if (is_array ( $imagesall [0] )) {
					$images = $imagesall [0];
				} else {
					$images = $imagesall;
				}
				$imagestr = BASE_URL . $images [0];
				for($i = 1; $i < count ( $images ); $i ++) {
					$imagestr .= "|" . BASE_URL . $images [$i];
				}
				if (is_array ( $imagesall [0] )) {
					$images_small = $imagesall [1];
					$images_big = $imagesall [0];
					$images_str = $imagesall [2];
					
					$datas = '';
					$datas .= "<div id='sppic_" . $inrow [0] ['did'] . "'>";
					$datas .= "<div id='spsmallpic_" . $inrow [0] ['did'] . "' class='spsmallpic'>";
					$datas .= "<ul>";
					foreach ( $images_small as $pkey => $pvalue ) {
						
						$datas .= "<li>";
						$datas .= "<img src=\"" . $pvalue . "\" onclick=\"makebig(" . $inrow [0] ['did'] . ")\"></img>";
						$datas .= "</li>";
					}
					$datas .= "</ul>";
					$datas .= "<div class=\"clear\"></div>";
					$datas .= "</div>";
					$datas .= "<div id='spbigpic_" . $inrow [0] ['did'] . "' class='spbigpic' ";
					if ('Internet Explorer' == APP::F ( 'getbrowser' )) {
						echo '';
					} else {
						$datas .= 'style="display:none"';
					}
					$datas .= ">";
					$datas .= "<ul>";
					foreach ( $images_big as $pkey => $pvalue ) {
						
						$datas .= "<li>";
						$datas .= "<img src=\"" . $pvalue . "\" onclick=\"makesmall(" . $inrow [0] ['did'] . ")\"></img>";
						$datas .= "<br></br>";
						$datas .= "<a href=\"" . $pvalue . "\" class=\"showoutimg\" rel=\"lightbox\"><img src=\"css/bgimg/look.gif\" style=\"border:0px\"></a>  " . $images_str [$pkey];
						$datas .= "<br></br>";
						$datas .= "</li>";
					}
					$datas .= "</ul>";
					$datas .= "<div class=\"clear\"></div>";
					$datas .= "</div>";
					
					$datas .= "</div>";
				} else {
					$datas = '<embed height="360" width="510" type="application/x-shockwave-flash" flashvars="bcastr_file=' . $imagestr . '&amp;bcastr_link=' . $imagestr . '&amp;bcastr_config=0x008000:fontcolor|4:fontform|0x008000:fontbgcolor|0:fonttouming|0xffffff:anjiancolor|0x008000:bottoncolor|0x000033:nowbottoncolor|5:palytime|3:picclass|1:botton|_blank:winodws" wmode="transparent" quality="high" src="' . BASE_URL . 'flash/bcastr.swf">';
				}
			} else {
				$datas = $rows [0] ['data'];
			}
			$div = '<div style="border-left:4px solid #616161;padding-left:4px;">' . $datas . '</div>';
			$content = $data . $div;
			$db->query ( 'update ' . $db->getTable ( T_CONTENT ) . ' set data=\'' . mysql_escape_string ( $content ) . '\'   where  did=' . $getInsertId );
		}
		echo 'sucess';
	}
	
	//显示未读
	function unreads() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$db = APP::ADP ( 'db' );
		$html = '';
		$unread = $db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . ' where uid=' . $userinfo ['uid'] );
		if ($unread && $unread [0] ['uncomment'] > 0) {
			$html .= '<li id="mod-newsfeedlist-link" class="my-newsfeed selected"><a target=_blank  style="padding-left:20px" href=\'index.php?m=index.comments\'>' . $unread [0] ['uncomment'] . '个新评论</a></li>';
		}
		if ($unread && $unread [0] ['unfans'] > 0) {
			$html .= '<li id="mod-newsfeedlist-link" class="my-newsfeed selected"><a  target=_blank   style="padding-left:20px"  href=\'index.php?m=index.fans\'>' . $unread [0] ['unfans'] . '个新跟班</a></li>';
		}
		
		if ($unread && $unread [0] ['unmsg'] > 0) {
			$html .= '<li id="mod-newsfeedlist-link" class="my-newsfeed selected"><a  target=_blank   style="padding-left:20px"  href=\'index.php?m=index.messages\'>' . $unread [0] ['unmsg'] . '条新留言 </a></li>';
		}
		echo $html;
	}
	
	//显示评论增加
	function showcommentadd() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$com = V ( 'p:com' );
		$com = preg_replace ( '/@(.*)+:/isU', '', $com );
		$reuid = V ( 'p:reuid' );
		$db = APP::ADP ( 'db' );
		if ($id & $com) {
			$db->query ( 'insert into ' . $db->getTable ( T_COMMENTS ) . ' (did,cdata,cdate,uid,uname,reuid) values(' . $id . ',\'' . mysql_escape_string ( $com ) . '\',\'' . date ( 'Y-m-d H:i:s' ) . '\',' . $userinfo ['uid'] . ',\'' . $userinfo ['name'] . '\',\'' . $reuid . '\')' );
			
			$unuid = $db->query ( 'select * from ' . $db->getTable ( T_CONTENT ) . '  where  did=' . $id );
			$ginfo = $db->query ( 'select * from ' . $db->getTable ( T_USERS ) . ' where uid=' . $unuid [0] ['uid'] );
			if ($ginfo [0] ['comtip'] == 1 && $unuid [0] ['uid'] != $userinfo ['uid']) {
				APP::F ( 'postmailtip', $ginfo [0] ['mail'], '评论提示：' . $userinfo ['name'] . '评论了你的文章', '<p>你的朋友(<a href=' . BASE_URL . 'index.php?m=ta&uid=' . $userinfo ['uid'] . '>' . $userinfo ['name'] . '</a>) 评论了你的文章 <<' . ($unuid [0] ['types'] == 2 ? $unuid [0] ['data'] : $unuid [0] ['title']) . ' >> 请点链接:<a href=' . BASE_URL . 'index.php>进入</a>(温馨提示：可进入控制面板关闭提示）', '新评论' );
			}
			$db->query ( 'update ' . $db->getTable ( T_CONTENT ) . ' set cnum=cnum+1 where did=' . $id );
			$un = $db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . '  where uid=' . $unuid [0] ['uid'] );
			if ($un) {
				if ($unuid [0] ['uid'] != $userinfo ['uid'])
					$db->query ( 'update ' . $db->getTable ( T_UNREAD ) . ' set uncomment=uncomment+1 where uid=' . $unuid [0] ['uid'] );
				if ($reuid && $reuid != $userinfo ['uid'])
					$db->query ( 'update ' . $db->getTable ( T_UNREAD ) . ' set uncomment=uncomment+1 where uid=' . $reuid );
			} else {
				if ($unuid [0] ['uid'] != $userinfo ['uid'])
					$db->query ( 'insert into ' . $db->getTable ( T_UNREAD ) . ' (uid,uncomment) values(' . $unuid [0] ['uid'] . ',1 )' );
				if ($reuid && $reuid != $userinfo ['uid'])
					$db->query ( 'insert into ' . $db->getTable ( T_UNREAD ) . ' (uid,uncomment) values(' . $reuid . ',1 )' );
			}
		}
		
		$results = $db->query ( 'select * ,x.uid as uid,z.name as zname  from ' . $db->getTable ( T_COMMENTS ) . ' x left join ' . $db->getTable ( T_USERS ) . ' z on x.reuid=z.uid  where  x.did=' . $id . ' order by x.cid desc limit 15 ' );
		$results = APP::F ( 'content_filter', $results );
		$html = '';
		foreach ( $results as $key => $value ) {
			$html .= '<p><span class="fb_u"><b><img src=';
			if (file_exists ( 'avatar/i_upload/' . $value ['uid'] . '_small.jpg' )) {
				$html .= BASE_URL . 'avatar/i_upload/' . $value ['uid'] . '_small.jpg';
			} else {
				$html .= BASE_URL . 'css/bgimg/default_avatar_64.gif';
			}
			$html .= ' width =20px height=20px alt="df" /></b> <a  style="color:#307DCA;margin-left:4px;" href="index.php?m=ta&uid=' . $value ['uid'] . '">' . $value ['uname'] . '</a>  :' . ($value ['zname'] ? '(回复:<a href=index.php?m=ta&uid=' . $value ['reuid'] . '>' . $value ['zname'] . '</a>)' : '') . '' . $value ['cdata'] . ($value ['uid'] ? '  <a   href=javascript:postcomment2(' . $value ['uid'] . ',"' . $value ['uname'] . '")><img src=' . BASE_URL . 'css/newimage/images/hf.png /></a>' : '');
			
			$html .= '</span>';
		}
		echo $html;
	}
	
	//显示评论增加
	function showcommentadd2() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$com = V ( 'p:com' );
		$reuid = V ( 'p:reuid' );
		
		$db = APP::ADP ( 'db' );
		if ($id & $com) {
			$db->query ( 'insert into ' . $db->getTable ( T_COMMENTS ) . ' (did,cdata,cdate,uid,uname,reuid) values(' . $id . ',\'' . mysql_escape_string ( $com ) . '\',\'' . date ( 'Y-m-d H:i:s' ) . '\',' . $userinfo ['uid'] . ',\'' . $userinfo ['name'] . '\',,\'' . $reuid . '\')' );
			
			$unuid = $db->query ( 'select * from ' . $db->getTable ( T_CONTENT ) . '  where  did=' . $id );
			$ginfo = $db->query ( 'select * from ' . $db->getTable ( T_USERS ) . ' where uid=' . $unuid [0] ['uid'] );
			if ($ginfo [0] ['comtip'] == 1 && $unuid [0] ['uid'] != $userinfo ['uid']) {
				APP::F ( 'postmailtip', $ginfo [0] ['mail'], '评论提示：' . $userinfo ['name'] . '评论了你的文章', '<p>你的朋友(<a href=' . BASE_URL . 'index.php?m=ta&uid=' . $userinfo ['uid'] . '>' . $userinfo ['name'] . '</a>) 评论了你的文章 <<' . ($unuid [0] ['types'] == 2 ? $unuid [0] ['data'] : $unuid [0] ['title']) . ' >> 请点链接:<a href=' . BASE_URL . 'index.php>进入</a>(温馨提示：可进入控制面板关闭提示）', '新评论' );
			}
			$db->query ( 'update ' . $db->getTable ( T_CONTENT ) . ' set cnum=cnum+1 where did=' . $id );
			$un = $db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . '  where uid=' . $unuid [0] ['uid'] );
			if ($un) {
				if ($unuid [0] ['uid'] != $userinfo ['uid'])
					$db->query ( 'update ' . $db->getTable ( T_UNREAD ) . ' set uncomment=uncomment+1 where uid=' . $unuid [0] ['uid'] );
				if ($reuid && $reuid != $userinfo ['uid'])
					$db->query ( 'update ' . $db->getTable ( T_UNREAD ) . ' set uncomment=uncomment+1 where uid=' . $reuid );
			} else {
				if ($unuid [0] ['uid'] != $userinfo ['uid'])
					$db->query ( 'insert into ' . $db->getTable ( T_UNREAD ) . ' (uid,uncomment) values(' . $unuid [0] ['uid'] . ',1 )' );
				if ($reuid && $reuid != $userinfo ['uid'])
					$db->query ( 'insert into ' . $db->getTable ( T_UNREAD ) . ' (uid,uncomment) values(' . $reuid . ',1 )' );
			}
		}
		
		$results = $db->query ( 'select * ,x.uid as uid,z.name as zname  from ' . $db->getTable ( T_COMMENTS ) . ' x left join ' . $db->getTable ( T_USERS ) . ' z on x.reuid=z.uid  where  x.did=' . $id . ' order by x.cid desc limit 15 ' );
		$results = APP::F ( 'content_filter', $results );
		$html = '';
		foreach ( $results as $key => $value ) {
			$html .= '<p><span class="fb_u"><b><img src=';
			if (file_exists ( 'avatar/i_upload/' . $value ['uid'] . '_small.jpg' )) {
				$html .= BASE_URL . 'avatar/i_upload/' . $value ['uid'] . '_small.jpg';
			} else {
				$html .= BASE_URL . 'css/bgimg/default_avatar_64.gif';
			}
			$html .= ' width =20px height=20px alt="df" /></b> <a  style="color:#307DCA;margin-left:4px;" href="index.php?m=ta&uid=' . $value ['uid'] . '">' . $value ['uname'] . '</a>  :' . ($value ['zname'] ? '(回复:<a href=index.php?m=ta&uid=' . $value ['reuid'] . '>' . $value ['zname'] . '</a>)' : '') . '' . $value ['cdata'] . '  <a   href=javascript:postcomment2(' . $value ['reuid'] . ',"' . $value ['uname'] . '")><img src=' . BASE_URL . 'css/newimage/images/hf.png /></a>';
			
			$html .= '</span>';
		}
		echo $html;
	}
	
	function showmessageadd() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$com = V ( 'p:com' );
		
		$db = APP::ADP ( 'db' );
		if ($id & $com) {
			$rows = $db->query ( 'select * from ' . $db->getTable ( T_CONTENT ) . ' where  did=' . $id );
			$unuid = $rows;
			$ginfo = $db->query ( 'select * from ' . $db->getTable ( T_USERS ) . ' where uid=' . $unuid [0] ['uid'] );
			if ($ginfo [0] ['msgtip'] == 1 && $unuid [0] ['uid'] != $userinfo ['uid']) {
				APP::F ( 'postmailtip', $ginfo [0] ['mail'], '留言提示：' . $userinfo ['name'] . '留言给你', '<p>你的朋友(<a href=' . BASE_URL . 'index.php?m=ta&uid=' . $userinfo ['uid'] . '>' . $userinfo ['name'] . '</a>) 留言给你 "' . $com . '"  请点链接:<a href=' . BASE_URL . 'index.php>进入</a>(温馨提示：可进入控制面板关闭提示）', '新留言' );
			}
			$uid = $rows [0] ['uid'];
			$db->query ( 'insert into ' . $db->getTable ( T_MESSAGE ) . ' (touid,msg,mdate,uid,uname) values(' . $uid . ',\'' . mysql_escape_string ( $com ) . '\',\'' . date ( 'Y-m-d H:i:s' ) . '\',' . $userinfo ['uid'] . ',\'' . $userinfo ['name'] . '\')' );
			
			$un = $db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . '  where uid=' . $uid );
			if ($un) {
				if ($unuid [0] ['uid'] != $userinfo ['uid'])
					$db->query ( 'update ' . $db->getTable ( T_UNREAD ) . ' set unmsg=unmsg+1 where uid=' . $uid );
			} else {
				if ($unuid [0] ['uid'] != $userinfo ['uid'])
					$db->query ( 'insert into ' . $db->getTable ( T_UNREAD ) . ' (uid,unmsg) values(' . $uid . ',1 )' );
			}
		}
		$results = $db->query ( 'select * from ' . $db->getTable ( T_MESSAGE ) . ' where  (uid=' . $uid . ' and touid=' . $userinfo ['uid'] . ') or (uid=' . $userinfo ['uid'] . ' and touid=' . $uid . ') order by mid desc limit 15 ' );
		$results = APP::F ( 'content_filter', $results );
		$html = '';
		foreach ( $results as $key => $value ) {
			$html .= '<p><span class="fb_u"><b><img src=';
			if (file_exists ( 'avatar/i_upload/' . $value ['uid'] . '_small.jpg' )) {
				$html .= BASE_URL . 'avatar/i_upload/' . $value ['uid'] . '_small.jpg';
			} else {
				$html .= BASE_URL . 'css/bgimg/default_avatar_64.gif';
			}
			$html .= ' width =20px height=20px alt="df" /></b> <a  style="color:#307DCA;margin-left:4px;" href="index.php?m=ta&uid=' . $value ['uid'] . '">' . $value ['uname'] . '</a>  :<span class="cmt-main">' . $value ['msg'];
		
		}
		echo $html;
	}
	
	function messageadd2() {
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'p:id' );
		$com = V ( 'p:com' );
		$uid = $id;
		$db = APP::ADP ( 'db' );
		if ($id & $com) {
			
			$db->query ( 'insert into ' . $db->getTable ( T_MESSAGE ) . ' (touid,msg,mdate,uid,uname) values(' . $uid . ',\'' . mysql_escape_string ( $com ) . '\',\'' . date ( 'Y-m-d H:i:s' ) . '\',' . $userinfo ['uid'] . ',\'' . $userinfo ['name'] . '\')' );
			
			$un = $db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . '  where uid=' . $uid );
			if ($un) {
				if ($uid != $userinfo ['uid'])
					$db->query ( 'update ' . $db->getTable ( T_UNREAD ) . ' set unmsg=unmsg+1 where uid=' . $uid );
			} else {
				if ($uid != $userinfo ['uid'])
					$db->query ( 'insert into ' . $db->getTable ( T_UNREAD ) . ' (uid,unmsg) values(' . $uid . ',1 )' );
			}
			echo 'sucesss';
		} else {
			echo 'fail';
		}
	
	}
	//提到我
	function tme() {
		TPL::display ( 'tme' );
	
	}
	
	//更换皮肤
	function face() {
		$userinfo = USER::get ( 'userinfo' );
		$name = V ( 'p:name' );
		$db = APP::ADP ( 'db' );
		$rowuser = $db->query ( 'select * from ' . $db->getTable ( T_USERS ) . ' where  uid=' . $userinfo ['uid'] );
		$row = $db->query ( 'select * from ' . $db->getTable ( T_USER_CONFIG ) . ' where  uid=' . $userinfo ['uid'] );
		$k = substr ( $name, 0, 2 );
		if ($rowuser [0] ['member'] == 1) {
			if ($row) {
				$db->query ( 'update ' . $db->getTable ( T_USER_CONFIG ) . ' set face=\'' . $name . '\' where  uid=' . $userinfo ['uid'] );
			} else {
				$db->query ( 'insert into ' . $db->getTable ( T_USER_CONFIG ) . ' (uid,name,face)values(' . $userinfo ['uid'] . ',\'' . $userinfo ['name'] . '\',\'' . $name . '\')' );
			
			}
		} else if ($k != 'm_') {
			if ($row) {
				$db->query ( 'update ' . $db->getTable ( T_USER_CONFIG ) . ' set face=\'' . $name . '\' where  uid=' . $userinfo ['uid'] );
			} else {
				$db->query ( 'insert into ' . $db->getTable ( T_USER_CONFIG ) . ' (uid,name,face)values(' . $userinfo ['uid'] . ',\'' . $userinfo ['name'] . '\',\'' . $name . '\')' );
			
			}
		}
		if (file_exists ( 'usercss/' . $userinfo ['uid'] . '.tpl' )) {
			unlink ( 'usercss/' . $userinfo ['uid'] . '.tpl' );
		}
		echo $name;
	
	}
	//忘记密码
	function forgetpassword() {
		$com = V ( 'p:com' );
		$db = APP::ADP ( 'db' );
		$rowuser = $db->query ( 'select * from ' . $db->getTable ( T_USERS ) . ' where  mail=\'' . $com . '\'' );
		if ($rowuser) {
			APP::F ( 'postmailforget', $com, $com . '邮箱的密码重置', '<b>邮箱的密码重置链接;</b><p><a href=' . BASE_URL . 'index.php?m=index.reset&uid=' . $rowuser [0] ['uid'] . '&password=' . $rowuser [0] ['password'] . '>' . BASE_URL . 'index.php?m=index.reset&uid=' . $rowuser [0] ['uid'] . '&password=' . $rowuser [0] ['password'] . '</a>', $rowuser [0] ['name'] );
			echo '发送成功,再发送一次';
		} else {
			echo '邮箱不存在，请重填邮箱再发送！';
		}
	
	}
	//重置密码
	

	function resetpassword() {
		$com = V ( 'p:com' );
		$ruid = V ( 'p:ruid' );
		$rpassword = V ( 'p:rpassword' );
		$db = APP::ADP ( 'db' );
		$rowuser = $db->query ( 'select * from ' . $db->getTable ( T_USERS ) . ' where  uid=' . $ruid . ' and password=\'' . $rpassword . '\'' );
		if ($rowuser) {
			$db->query ( 'update  ' . $db->getTable ( T_USERS ) . ' set password=\'' . md5 ( $com ) . '\' where  uid=' . $ruid . ' and password=\'' . $rpassword . '\'' );
			echo '修改成功，可返回登录';
		} else {
			echo '修改失败';
		}
	
	}
	
	function reset() {
		TPL::display ( 'reset' );
	}
	
	function mail() {
		$userinfo = USER::get ( 'userinfo' );
		$com = V ( 'p:com' );
		$allmail = V ( 'p:allmail' );
		$mallArr = explode ( ';', $allmail );
		foreach ( $mallArr as $key => $value ) {
			
			APP::F ( 'postmail', $value, '你的好友' . $userinfo ['name'] . '邀请你加入身旁网轻博客', '<b>身旁网轻博客邀请链接;</b><p>你的好朋友(<a href=' . BASE_URL . 'index.php?m=ta&uid=' . $userinfo ['uid'] . '>' . $userinfo ['name'] . '</a>) 邀请你加入身旁网关注他  请点链接:<a href=' . BASE_URL . 'index.php?m=ta.invate&uid=' . $userinfo ['uid'] . '>' . BASE_URL . 'index.php?m=ta.invate&uid=' . $userinfo ['uid'] . '</a>', $userinfo ['name'] . '的朋友' );
		
		}
		echo '发送成功,再发送一次';
	}
	
	//邀请
	function invate() {
		TPL::display ( 'invate' );
	}
	
	//忘记密码
	function forget() {
		TPL::display ( 'forget' );
	}
	
	//搜索
	function search() {
		TPL::display ( 'search' );
	}

}
?>