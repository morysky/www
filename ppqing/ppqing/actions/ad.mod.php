<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *index 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
class ad_mod {
	
	function ad_mod() {
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

       $msg=USER::set('msg','');

		TPL::display ( 'index' );

		
	
	}
	
   function job(){
   	  TPL::display ( 'ad/job' );
   }
   
//关于身旁网
   function about(){
   	  TPL::display ( 'ad/about' );
   }
   
//关于团队风彩
   function team(){
   	  TPL::display ( 'ad/team' );
   }
   
//关于身旁网的家
   function home(){
   	  TPL::display ( 'ad/home' );
   }
   
//联系我们
   function link(){
   	  TPL::display ( 'ad/link' );
   }
   
   
//联系我们
   function qqqun(){
   	  TPL::display ( 'ad/qqqun' );
   }
	

}
?>