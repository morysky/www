<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *index 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class group_mod
{

	function group_mod()
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
		$gid= V('g:gid');
		$db=APP :: ADP('db');
		$ginfo=$db->query('select * from '.$db->getTable(T_GROUP_CONFIG).' where gid='.$gid);
		if($ginfo&&$gid){
			$tauid=$ginfo[0]['uid'];
			TPL::assign('SPgid', $gid);
		TPL::display('group');
		}else{
			  $goUrl = URL('index');
			//header('Location:index.php?m=index');
			APP::redirect($goUrl, 4);
		}

	}
	
	//关注他
	function follow(){
		$userinfo=USER::get('userinfo');
		$gid= V('g:gid');
		$db=APP :: ADP('db');
		$count=$db->query('select count(*) as count from '.$db->getTable(T_GROUP_USERS).' where uid='.$userinfo['uid']);
		$gconfig=$db->query('select * from '.$db->getTable(T_GROUP_CONFIG).' where  gid='.$gid);
		$row=$db->query('select * from '.$db->getTable(T_GROUP_USERS).' where uid='.$userinfo['uid'].' and gid='.$gid);
		$rowf=$db->query('select count(*) as count from '.$db->getTable(T_GROUP_USERS).' where  gid='.$gid);
		if(!$row&&$count[0]['count']<3&&$rowf[0]['count']<$gconfig[0]['maxnum']){
		$db->query('insert into '.$db->getTable(T_GROUP_USERS).'(uid,gid,admin) values('.$userinfo['uid'].',\''.$gid.'\',0)');
		}
		  $goUrl = URL('index');
			//header('Location:index.php?m=index');
			APP::redirect($goUrl, 4);
		
	}
	
		//取消关注
	function delfollow(){
		$userinfo=USER::get('userinfo');
	$gid= V('g:gid');
		$db=APP :: ADP('db');

		$row=$db->query('select * from '.$db->getTable(T_GROUP_USERS).' where uid='.$userinfo['uid'].' and gid='.$gid);
		if($row){
		$db->query('delete from '.$db->getTable(T_GROUP_USERS).' where uid='.$userinfo['uid'].' and gid='.$gid);
		}
		  $goUrl = URL('index');
			//header('Location:index.php?m=index');
			APP::redirect($goUrl, 4);
		
	}
	
	function postdid(){
	$did= V('p:did');	
	$gid= V('p:gid');
		$db=APP :: ADP('db');

		$row=$db->query('select * from '.$db->getTable(T_GROUP_CONTENT).' where did='.$did.' and gid='.$gid);
		if($row){
		$db->query('delete from '.$db->getTable(T_GROUP_CONTENT).' where did='.$did.' and gid='.$gid);
		}else{
			$db->query('insert into '.$db->getTable(T_GROUP_CONTENT).'(did,gid)values('.$did.','.$gid.')');
			echo 'successs';
		}
		
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