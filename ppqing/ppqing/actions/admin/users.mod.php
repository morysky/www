<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *后台admin 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
include('action.php');
class users_mod extends action {
	
	function users_mod() {
		//parent::action();
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

		//$this->checkLogin();

		
	
	}
	
	/*
    * 搜索用户
    */
	function search() {

		$nickname = urldecode(V('r:keyword', ''));
		$page = (int)V('g:page', 1);
		$each = (int)V('g:each', 15);
		$offset = ($page -1) * $each;
		$num = ($page -1) * $each;
		$keyword='';
         if($nickname)$keyword=' where name like \'%'.$nickname.'%\' ';
	    $db=APP :: ADP('db');
	    $rs=$db->query('select * from '.$db->getTable(T_USERS).$keyword.'  order by uid desc limit '. $offset.','.$each);
	    $counts=$db->query('select count(*) as count from '.$db->getTable(T_USERS).$keyword);
	    $count=$counts[0]['count'];
	    		$pager = APP :: N('pager');
		$page_param = array('currentPage'=> $page, 'pageSize' => $each, 'recordCount' => $count, 'linkNumber' => 10);
		$pager->setParam($page_param);
         
		TPL :: assign('num', $num);
		 
		TPL :: assign('pager', $pager->makePageForKeyWord('',array('keyword'=>urlencode($nickname))));
		TPL :: assign('count', $count);
		TPL :: assign('nickname', $nickname);
        TPL :: assign('list', $rs); 
     
        TPL :: display('admin/user/user_list', '', 0, false);
	}
	
	//推荐操作
	function authentication(){
				$is_v = (int)V('g:v',0);
        $id = V('g:id',0);
        $nick = urldecode(V('g:name',0));
        if($id){
        	$db=APP :: ADP('db');
        	$db->query('update '.$db->getTable(T_USERS).' set ortui='.$is_v.' where uid='.$id);
        	
        }
		       $this->_succ('操作已成功', array('search'));
	}
	
	//封禁操作
	function ban(){
				$ban = (int)V('g:ban',0);
        $id = V('g:id',0);
        $nick = urldecode(V('g:name',0));
        if($id){
        	$db=APP :: ADP('db');
        	$db->query('update '.$db->getTable(T_USERS).' set orban='.$ban.' where uid='.$id);
        	
        }
		       $this->_succ('操作已成功', array('search'));
	}
	//增加推荐次数
	function addtui(){
        $id = V('g:id',0);
        if($id){
        	$db=APP :: ADP('db');
        	$db->query('update '.$db->getTable(T_USERS).' set tui=tui+100 where uid='.$id);
        	
        }
		       $this->_succ('操作已成功', array('getReSort'));
		
	}
	//增加推荐次数
	function deltui(){
        $id = V('g:id',0);
        if($id){
        	$db=APP :: ADP('db');
        	$db->query('update '.$db->getTable(T_USERS).' set tui=tui-100 where uid='.$id);
        	
        }
		       $this->_succ('操作已成功', array('getReSort'));
		
	}
	//删除所选推荐用户
	function delAuthen(){
		$ids = V('g:ids');
		$id_arr = explode(',', $ids);
		$db=APP :: ADP('db');
		foreach($id_arr as $key  => $value){
				
        	$db->query('update '.$db->getTable(T_USERS).' set ortui=0 where uid='.$value);
		}
		$this->_succ('操作已成功', array('getReSort'));
	}
	
//删除所选封禁用户
	function delbanall(){
		$ids = V('g:ids');
		$id_arr = explode(',', $ids);
		$db=APP :: ADP('db');
		foreach($id_arr as $key  => $value){
				
        	$db->query('update '.$db->getTable(T_USERS).' set orban=0 where uid='.$value);
		}
		$this->_succ('操作已成功', array('banUser'));
	}
	/*
    * 推荐用户
    */
	function getReSort() {
		$nickname = urldecode(V('r:keyword', ''));
		$page = (int)V('g:page', 1);
		$each = (int)V('g:each', 15);
		$offset = ($page -1) * $each;
		$num = ($page -1) * $each;
		$keyword='';
            if($nickname)$keyword=' and name like \'%'.$nickname.'%\' ';
	    $db=APP :: ADP('db');
	    $rs=$db->query('select * from '.$db->getTable(T_USERS).' where ortui=1 '.$keyword.'  order by uid desc limit '. $offset.','.$each);
	    $counts=$db->query('select count(*) as count from '.$db->getTable(T_USERS).' where ortui=1 '.$keyword);
	    $count=$counts[0]['count'];
	    		$pager = APP :: N('pager');
		$page_param = array('currentPage'=> $page, 'pageSize' => $each, 'recordCount' => $count, 'linkNumber' => 10);
		$pager->setParam($page_param);

		TPL :: assign('num', $num);
		TPL :: assign('pager', $pager->makePageForKeyWord('',array('keyword'=>urlencode($nickname))));
		TPL :: assign('count', $count);
		TPL :: assign('nickname', $nickname);
        TPL :: assign('list', $rs); 
        TPL :: display('admin/user/tui_userlist', '', 0, false);
	}
	
	/*
    * 搜索封禁用户
    */
	function banUser() {
		$nickname = urldecode(V('r:keyword', ''));
		$page = (int)V('g:page', 1);
		$each = (int)V('g:each', 15);
		$offset = ($page -1) * $each;
		$num = ($page -1) * $each;
		$keyword='';
            if($nickname)$keyword=' and name like \'%'.$nickname.'%\' ';
	    $db=APP :: ADP('db');
	    $rs=$db->query('select * from '.$db->getTable(T_USERS).' where orban=1 '.$keyword.'  order by uid desc limit '. $offset.','.$each);
	    $counts=$db->query('select count(*) as count from '.$db->getTable(T_USERS).' where orban=1 '.$keyword);
	    $count=$counts[0]['count'];
	    		$pager = APP :: N('pager');
		$page_param = array('currentPage'=> $page, 'pageSize' => $each, 'recordCount' => $count, 'linkNumber' => 10);
		$pager->setParam($page_param);

		TPL :: assign('num', $num);
		TPL :: assign('pager', $pager->makePageForKeyWord('',array('keyword'=>urlencode($nickname))));
		TPL :: assign('count', $count);
		TPL :: assign('nickname', $nickname);
        TPL :: assign('list', $rs); 
        TPL :: display('admin/user/users_ban', '', 0, false);
	}
	
	

	
	
	

}
?>