<?php

include('action.php');
class friendlink_mod extends action {

	function friendlink_mod() {
		parent :: action();
	}

	/**
	 * 友情链接列表
	 */
	function flist() {
		$page = (int)V('g:page', 1);
		$each = (int)V('g:each', 15);
		$offset = ($page -1) * $each;
		$item = V('r:keyword', null);

		$offset = $page - 1 >= 0 ? $page - 1: 0;
		$offset *= $each;
			$keyword='';
         if($item)$keyword=' where name like \'%'.$item.'%\' ';
	$db=APP :: ADP('db');
	    $rs=$db->query('select * from '.$db->getTable(T_FRIENDLINK).$keyword.'  order by fid desc limit '. $offset.','.$each);
		TPL::assign('list',$rs);

		   $counts=$db->query('select count(*) as count from '.$db->getTable(T_FRIENDLINK).$keyword);
	    $count=$counts[0]['count'];

		$pager = APP :: N('pager');
		$page_param = array('currentPage'=> $page, 'pageSize' => $each, 'recordCount' => $count, 'linkNumber' => 10);
		$pager->setParam($page_param);
		$pager->setVarExtends(array('keyword' => $keyword));
		TPL :: assign('pager', $pager->makePage());
		TPL::assign('offset', $offset);
		TPL :: display('admin/qingbo/friendlink_list', '', 0, false);
	}

	/**
	 * 恢复被屏蔽的回复
	 */
	function del() {
		$id = V('r:id');
	   if($id){
        	$db=APP :: ADP('db');
        	$db->query('delete from  '.$db->getTable(T_FRIENDLINK).'  where fid='.$id);
        	
        }
             $this->_succ('操作已成功', array('flist'));

	}
	
function delall() {
	$ids = V('g:ids');
		$id_arr = explode(',', $ids);
		$db=APP :: ADP('db');
		foreach($id_arr as $key  => $value){
				
        	$db->query('delete from '.$db->getTable(T_FRIENDLINK).'  where fid='.$value);
		}
             $this->_succ('操作已成功', array('flist'));

	}

	/**
	 * 增加友情链接
	 */
	function add() {
		if ($this->_isPost()) {
			$name = V('p:name', false);
			$url = V('p:url', false);
			$logo = V('p:logo', false);
			$types = V('p:types', false);
			$sortid = V('p:sortid', false);
			if (!$name||!$url || trim((string)$name) == '') {
				$this->_error('请填写网站名字', array('add'));
				//return RST(2121205, '添加关键字时，参数为空');
			}
			$logopic=file_get_contents($logo);
			$mp=explode('.',$logo);
			file_put_contents('ad/linkpic/'.md5($logo).".".end($mp),$logopic);
			$logo='ad/linkpic/'.md5($logo).".".end($mp);

			$db=APP :: ADP('db');
	    $db->query('insert into '.$db->getTable(T_FRIENDLINK).'(name,url,logo,types,sortid)values(\''.$name.'\',\''.$url.'\',\''.$logo.'\',\''.$types.'\',\''.$sortid.'\')');

			 $this->_succ('操作已成功', array('flist'));
			 
		}
		TPL :: display('admin/qingbo/friendlink_add', '', 0, false);
		//APP::ajaxRst(false, 2122204, '添加关键字失败');
	}
}
