<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *index 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class ta_mod
{

	function ta_mod()
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
		$guid= V('g:uid');
		$db=APP :: ADP('db');
		if(is_numeric($guid)){
		$ginfo=$db->query('select * from '.$db->getTable(T_USERS).' where uid='.$guid);
		}else{
			$ginfo=$db->query('select * from '.$db->getTable(T_USERS).' where   domname=\''.$guid.'\'');
		}
		if($ginfo&&$guid){
			$tauid=$ginfo[0]['uid'];
			TPL::assign('SPuid', $tauid);
			
		TPL::display('ta');
		}else{
			  $goUrl = URL('index');
			//header('Location:index.php?m=index');
			APP::redirect($goUrl, 4);
		}

	}
	
	//tarighttop 个人模板右边顶部
	function tarighttop(){
		TPL::display('include/tarighttop');
	}
	
	//关注他
	function follow(){
		$userinfo=USER::get('userinfo');
		$guid= V('g:uid');
		$db=APP :: ADP('db');
		$ginfo=$db->query('select * from '.$db->getTable(T_USERS).' where uid='.$guid);
		$gname=$ginfo[0]['name'];
		$row=$db->query('select * from '.$db->getTable(T_FOLLOWS).' where uid='.$userinfo['uid'].' and guid='.$guid);
		if(!$row){
		$db->query('insert into '.$db->getTable(T_FOLLOWS).'(uid,name,guid,gname) values('.$userinfo['uid'].',\''.$userinfo['name'].'\','.$guid.',\''.$gname.'\')');
		if($ginfo[0]['foltip']==1){APP::F('postmailtip',$ginfo[0]['mail'],'欣赏提示：'. $userinfo['name'].'欣赏了你','<p>你的朋友(<a href='.BASE_URL.'index.php?m=ta&uid='.$userinfo['uid'].'>'.$userinfo['name'].'</a>) 很欣赏你的轻博客  请点链接:<a href='.BASE_URL.'index.php>进入</a>','新欣赏');}
		
		$un=$db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . '  where uid='.$guid);
			if($un){
				$db->query ( 'update ' . $db->getTable ( T_UNREAD ) . ' set unfans=unfans+1 where uid='.$guid);
			}else{
				$db->query ( 'insert into ' . $db->getTable ( T_UNREAD ) . ' (uid,unfans) values('.$guid.',1 )' );
			}
		}
		  $goUrl = URL('index');
			//header('Location:index.php?m=index');
			APP::redirect($goUrl, 4);
		
	}
	
	//关注他
	function ajaxfollow(){
		$userinfo=USER::get('userinfo');
		$guid= V('p:uid');
		$db=APP :: ADP('db');
		$ginfo=$db->query('select * from '.$db->getTable(T_USERS).' where uid='.$guid);
		$gname=$ginfo[0]['name'];
		$row=$db->query('select * from '.$db->getTable(T_FOLLOWS).' where uid='.$userinfo['uid'].' and guid='.$guid);
		if(!$row){
		$db->query('insert into '.$db->getTable(T_FOLLOWS).'(uid,name,guid,gname) values('.$userinfo['uid'].',\''.$userinfo['name'].'\','.$guid.',\''.$gname.'\')');
		if($ginfo[0]['foltip']==1){APP::F('postmailtip',$ginfo[0]['mail'],'欣赏提示：'. $userinfo['name'].'欣赏了你','<p>你的朋友(<a href='.BASE_URL.'index.php?m=ta&uid='.$userinfo['uid'].'>'.$userinfo['name'].'</a>) 很欣赏你的轻博客  请点链接:<a href='.BASE_URL.'index.php>进入</a>','新欣赏');}
		
		$un=$db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . '  where uid='.$guid);
			if($un){
				$db->query ( 'update ' . $db->getTable ( T_UNREAD ) . ' set unfans=unfans+1 where uid='.$guid);
			}else{
				$db->query ( 'insert into ' . $db->getTable ( T_UNREAD ) . ' (uid,unfans) values('.$guid.',1 )' );
			}
		}
		  //$goUrl = URL('index');
			//header('Location:index.php?m=index');
			//APP::redirect($goUrl, 4);
		
	}
	
	//关注他
	function ajaxfollow2(){
		$userinfo=USER::get('userinfo');
		$guid= V('p:uid');
		$db=APP :: ADP('db');
		$ginfo=$db->query('select * from '.$db->getTable(T_USERS).' where uid='.$guid);
		$gname=$ginfo[0]['name'];
		$row=$db->query('select * from '.$db->getTable(T_FOLLOWS).' where uid='.$userinfo['uid'].' and guid='.$guid);
		if(!$row){
		$db->query('insert into '.$db->getTable(T_FOLLOWS).'(uid,name,guid,gname) values('.$userinfo['uid'].',\''.$userinfo['name'].'\','.$guid.',\''.$gname.'\')');
	
		
		$un=$db->query ( 'select * from ' . $db->getTable ( T_UNREAD ) . '  where uid='.$guid);
			if($un){
				$db->query ( 'update ' . $db->getTable ( T_UNREAD ) . ' set unfans=unfans+1 where uid='.$guid);
			}else{
				$db->query ( 'insert into ' . $db->getTable ( T_UNREAD ) . ' (uid,unfans) values('.$guid.',1 )' );
			}
		}
		  //$goUrl = URL('index');
			//header('Location:index.php?m=index');
			//APP::redirect($goUrl, 4);
		
	}
	
		//取消关注
	function delfollow(){
		$userinfo=USER::get('userinfo');
		$guid= V('g:uid');
		$db=APP :: ADP('db');
		$ginfo=$db->query('select * from '.$db->getTable(T_USERS).' where uid='.$guid);
		$gname=$ginfo[0]['name'];
		$row=$db->query('select * from '.$db->getTable(T_FOLLOWS).' where uid='.$userinfo['uid'].' and guid='.$guid);
		if($row){
		$db->query('delete from '.$db->getTable(T_FOLLOWS).' where uid='.$userinfo['uid'].' and guid='.$guid);
		}
		  $goUrl = URL('index');
			//header('Location:index.php?m=index');
			APP::redirect($goUrl, 4);
		
	}
	
//取消关注
	function ajaxdelfollow(){
		$userinfo=USER::get('userinfo');
		$guid= V('p:uid');
		$db=APP :: ADP('db');
		$ginfo=$db->query('select * from '.$db->getTable(T_USERS).' where uid='.$guid);
		$gname=$ginfo[0]['name'];
		$row=$db->query('select * from '.$db->getTable(T_FOLLOWS).' where uid='.$userinfo['uid'].' and guid='.$guid);
		if($row){
		$db->query('delete from '.$db->getTable(T_FOLLOWS).' where uid='.$userinfo['uid'].' and guid='.$guid);
		}
		  $goUrl = URL('index');
			//header('Location:index.php?m=index');
			//APP::redirect($goUrl, 4);
		
	}
	
//取消关注
	function ajaxdelfollow2(){
		$userinfo=USER::get('userinfo');
		$guid= V('p:uid');
		$db=APP :: ADP('db');
		$ginfo=$db->query('select * from '.$db->getTable(T_USERS).' where uid='.$guid);
		$gname=$ginfo[0]['name'];
		$row=$db->query('select * from '.$db->getTable(T_FOLLOWS).' where uid='.$userinfo['uid'].' and guid='.$guid);
		if($row){
		$db->query('delete from '.$db->getTable(T_FOLLOWS).' where uid='.$userinfo['uid'].' and guid='.$guid);
		}
		  $goUrl = URL('index');
			//header('Location:index.php?m=index');
			//APP::redirect($goUrl, 4);
		
	}
	
	
	//发布内容
	function add(){
		$userinfo=USER::get('userinfo');
		$content= V('p:content');
		$content=APP::F('sava',$content);
		if($content){
			$db=APP :: ADP('db');
		    $db->query('insert into '.$db->getTable(T_CONTENT).' (data,thedate,uid) values(\''.$content.'\',\''.date('Y-m-d H:i:s').'\','.$userinfo['uid'].')');
		    $goUrl = URL('index');
			//header('Location:index.php?m=index');
			APP::redirect($goUrl, 4);
		}else{
			  $goUrl = URL('index');
			//header('Location:index.php?m=index');
			APP::redirect($goUrl, 4);
			
		}
	}
	
	//他的关注
	function tafollow(){
		TPL::display('tafollow');
		
	}
	
	//邀请
	  function invate(){
	  	$vuid= V('g:uid');
	  	if($vuid){
	  		USER::set('invateuid',$vuid);
	  		 $goUrl = URL('account.register');
	  		APP::redirect($goUrl, 4);
	  	}
	  }
	
}
?>