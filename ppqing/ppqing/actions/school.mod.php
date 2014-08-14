<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *index 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class school_mod {
	
	function school_mod() {
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
			$db = APP::ADP ( 'db' );
			$row = $db->query ( 'select * from ' . $db->getTable ( T_SCHOOL ) . ' where uid=' . $userinfo['uid']  );
			if($row){
      USER::set('spschool','1');
       $msg=USER::set('msg','');

		TPL::display ( 'school' );
			}else{
				$goUrl = URL ( 'index' );
			APP::redirect ( $goUrl, 4 );
			}

		
	
	}
	


}
?>