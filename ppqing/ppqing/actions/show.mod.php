<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *index 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class show_mod {
	
	function show_mod() {
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
		$userinfo = USER::get ( 'userinfo' );
		$id = V ( 'g:id' );
		TPL::display ( 'show' );
	
	}
	
	function text() {
		TPL::display ( 'text' );
	}
	
	//发布内容
	function add() {
		$userinfo = USER::get ( 'userinfo' );
		$content = V ( 'p:content' );
		$content = APP::F ( 'sava', $content );
		if ($content) {
			$db = APP::ADP ( 'db' );
			$db->query ( 'insert into ' . $db->getTable ( T_CONTENT ) . ' (data,thedate,uid) values(\'' . $content . '\',\'' . date ( 'Y-m-d H:i:s' ) . '\',' . $userinfo ['uid'] . ')' );
			$goUrl = URL ( 'index' );
			//header('Location:index.php?m=index');
			APP::redirect ( $goUrl, 4 );
		} else {
			$goUrl = URL ( 'index' );
			//header('Location:index.php?m=index');
			APP::redirect ( $goUrl, 4 );
		
		}
	}

}
?>