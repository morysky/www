<?php

include('action.php');
class keyword_mod extends action {

	function keyword_mod() {
		parent :: action();
	}

	/**
	 * 关键字列表
	 */
	function keywordList() {
		$page = (int)V('g:page', 1);
		$each = (int)V('g:each', 15);
		$offset = ($page -1) * $each;
		$item = V('r:keyword', null);

		$offset = $page - 1 >= 0 ? $page - 1: 0;
		$offset *= $each;
			$keyword='';
         if($item)$keyword=' where item like \'%'.$item.'%\' ';
	$db=APP :: ADP('db');
	    $rs=$db->query('select * from '.$db->getTable(T_DISABLE).$keyword.'  order by kw_id desc limit '. $offset.','.$each);
		TPL::assign('list',$rs);

		   $counts=$db->query('select count(*) as count from '.$db->getTable(T_DISABLE).$keyword);
	    $count=$counts[0]['count'];

		$pager = APP :: N('pager');
		$page_param = array('currentPage'=> $page, 'pageSize' => $each, 'recordCount' => $count, 'linkNumber' => 10);
		$pager->setParam($page_param);
		$pager->setVarExtends(array('keyword' => $keyword));
		TPL :: assign('pager', $pager->makePage());
		TPL::assign('offset', $offset);
		TPL :: display('admin/qingbo/keyword_list', '', 0, false);
	}

	/**
	 * 恢复被屏蔽的回复
	 */
	function del() {
		$id = V('r:id');
	   if($id){
        	$db=APP :: ADP('db');
        	$db->query('delete from  '.$db->getTable(T_DISABLE).'  where kw_id='.$id);
        	
        }
        	$result=$db->query("select item from ".$db->getTable(T_DISABLE));
			$caches=$result;
			foreach($caches as $keys => $values){
				$cache[$keys]=$values['item'];
			}
			$data=serialize($cache);
			file_put_contents('var/data/disable/disable.txt',$data);
             $this->_succ('操作已成功', array('keywordList'));

	}
	
function delall() {
	$ids = V('g:ids');
		$id_arr = explode(',', $ids);
		$db=APP :: ADP('db');
		foreach($id_arr as $key  => $value){
				
        	$db->query('delete from '.$db->getTable(T_DISABLE).'  where kw_id='.$value);
		}
			$result=$db->query("select item from ".$db->getTable(T_DISABLE));
			$caches=$result;
			foreach($caches as $keys => $values){
				$cache[$keys]=$values['item'];
			}
			$data=serialize($cache);
			file_put_contents('var/data/disable/disable.txt',$data);
             $this->_succ('操作已成功', array('keywordList'));

	}

	/**
	 * 屏蔽一微博
	 */
	function add() {
		if ($this->_isPost()) {
			$keywords = V('p:keywords', false);
			if (!$keywords || trim((string)$keywords) == '') {
				$this->_error('请填写要屏蔽的关键字', array('keywordList'));
				//return RST(2121205, '添加关键字时，参数为空');
			}
			$allitem=explode(';',$keywords);
			$db=APP :: ADP('db');
			foreach($allitem as $key => $value){
	    $db->query('insert into '.$db->getTable(T_DISABLE).'(item,admin_id,add_time)values(\''.$value.'\','.USER::aid().',\''.time().'\')');
			}
				$result=$db->query("select item from ".$db->getTable(T_DISABLE));
			$caches=$result;
			foreach($caches as $keys => $values){
				$cache[$keys]=$values['item'];
			}
			$data=serialize($cache);
			file_put_contents('var/data/disable/disable.txt',$data);
			 $this->_succ('操作已成功', array('keywordList'));
			 
		}
		TPL :: display('admin/qingbo/keyword_add', '', 0, false);
		//APP::ajaxRst(false, 2122204, '添加关键字失败');
	}
}
