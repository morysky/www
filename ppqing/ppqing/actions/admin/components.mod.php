<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *后台admin 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
include('action.php');
class components_mod extends action {
	
	function components_mod() {
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
	
	//删除内容　
	function delcontent(){
		 $id = V('g:id',0);
        if($id){
        	$db=APP :: ADP('db');
        	$db->query('delete from  '.$db->getTable(T_CONTENT).' where did='.$id);
        	$db->query('delete from  '.$db->getTable(T_TAGS_CONTENT).' where did='.$id);
        	
        }
		       $this->_succ('操作已成功', array('econtent'));
	}
	
	//删除标签　
	function deltag(){
		 $id = V('g:id',0);
        if($id){
        	$db=APP :: ADP('db');
        	$db->query('delete from  '.$db->getTable(T_TAGS).' where tarid='.$id);
        	$db->query('delete from  '.$db->getTable(T_TAGS_CONTENT).' where tarid='.$id);
        	
        }
		       $this->_succ('操作已成功', array('etags'));
	}
	
	//删除评论
	function delcomment(){
		 $id = V('g:id',0);
        if($id){
        	$db=APP :: ADP('db');
        	$db->query('delete from  '.$db->getTable(T_COMMENTS).'  where cid='.$id);
        	
        }
		       $this->_succ('操作已成功', array('ecomment'));
		
	}
/*
    * 搜索用户
    */
	function econtent() {
		$nickname = urldecode(V('p:keyword', ''));
		$page = (int)V('g:page', 1);
		$each = (int)V('g:each', 15);
		$offset = ($page -1) * $each;
		$num = ($page -1) * $each;
		$keyword='';
         if($nickname)$keyword=' where x.title like \'%'.$nickname.'%\' ';
	    $db=APP :: ADP('db');
	    $rs=$db->query('select * from '.$db->getTable(T_CONTENT).' x left join '.$db->getTable(T_USERS).' y on x.uid=y.uid '.$keyword.'  order by x.did desc limit '. $offset.','.$each);
	    $counts=$db->query('select count(*) as count from '.$db->getTable(T_CONTENT).' x left join '.$db->getTable(T_USERS).' y on x.uid=y.uid '.$keyword);
	    $count=$counts[0]['count'];
	    		$pager = APP :: N('pager');
		$page_param = array('currentPage'=> $page, 'pageSize' => $each, 'recordCount' => $count, 'linkNumber' => 10);
		$pager->setParam($page_param);

		TPL :: assign('num', $num);
		TPL :: assign('pager', $pager->makePageForKeyWord('',array('keyword'=>urlencode($nickname))));
		TPL :: assign('count', $count);
		TPL :: assign('nickname', $nickname);
        TPL :: assign('list', $rs); 
          TPL :: display('admin/components/components_list', '', 0, false);
	}
	
/*
    * 搜索标签
    */
	function etags() {
		$nickname = urldecode(V('p:keyword', ''));
		$page = (int)V('g:page', 1);
		$each = (int)V('g:each', 15);
		$offset = ($page -1) * $each;
		$num = ($page -1) * $each;
		$keyword='';
         if($nickname)$keyword=' where tarname like \'%'.$nickname.'%\' ';
	    $db=APP :: ADP('db');
	    $rs=$db->query('select * from '.$db->getTable(T_TAGS).$keyword.'  order by tarid desc limit '. $offset.','.$each);
	    $counts=$db->query('select count(*) as count from '.$db->getTable(T_TAGS).$keyword);
	    $count=$counts[0]['count'];
	    		$pager = APP :: N('pager');
		$page_param = array('currentPage'=> $page, 'pageSize' => $each, 'recordCount' => $count, 'linkNumber' => 10);
		$pager->setParam($page_param);

		TPL :: assign('num', $num);
		TPL :: assign('pager', $pager->makePageForKeyWord('',array('keyword'=>urlencode($nickname))));
		TPL :: assign('count', $count);
		TPL :: assign('nickname', $nickname);
        TPL :: assign('list', $rs); 
          TPL :: display('admin/components/components_tags', '', 0, false);
	}

	function ecomment(){
			$nickname = urldecode(V('p:keyword', ''));
		$page = (int)V('g:page', 1);
		$each = (int)V('g:each', 15);
		$offset = ($page -1) * $each;
		$num = ($page -1) * $each;
		$keyword='';
         if($nickname)$keyword=' where cdata like \'%'.$nickname.'%\' ';
	    $db=APP :: ADP('db');
	    $rs=$db->query('select * from '.$db->getTable(T_COMMENTS).$keyword.'  order by cid desc limit '. $offset.','.$each);
	    $counts=$db->query('select count(*) as count from '.$db->getTable(T_COMMENTS).$keyword);
	    $count=$counts[0]['count'];
	    		$pager = APP :: N('pager');
		$page_param = array('currentPage'=> $page, 'pageSize' => $each, 'recordCount' => $count, 'linkNumber' => 10);
		$pager->setParam($page_param);

		TPL :: assign('num', $num);
		TPL :: assign('pager', $pager->makePageForKeyWord('',array('keyword'=>urlencode($nickname))));
		TPL :: assign('count', $count);
		TPL :: assign('nickname', $nickname);
        TPL :: assign('list', $rs); 
          TPL :: display('admin/components/components_comments', '', 0, false);
		
	}
	
	

}
?>