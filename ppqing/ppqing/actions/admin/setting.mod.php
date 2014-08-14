<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *后台admin 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
include('action.php');
class setting_mod extends action {
	
	function setting_mod() {
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
	function core(){
	if ($this->_isPost()) {

			$data = array(
				'bei' => htmlspecialchars(trim(V('p:site_bei', ''))),//网站备案信息代码
				'title' => htmlspecialchars(trim(V('p:site_name', ''))),//网站名称
						'Keywords' => htmlspecialchars(trim(V('p:site_keywords', ''))),//网站关键词
						'Description' => htmlspecialchars(trim(V('p:site_description', ''))),//网站描述
			
				);
				$db=APP :: ADP('db');

			foreach($data as $key=>$value) {
				$db->query('update   '.$db->getTable(T_SETTING).' set value=\''.$value.'\' where name=\''.$key.'\'');
			}
		$settings=$db->query('select * from '.$db->getTable(T_SETTING));
		foreach($settings as $key => $value){
			$setting[$value['name']]=$value['value'];
		}
		file_put_contents('var/data/setting/SPconfig.tpl',serialize($setting));
			$this->_succ('已经成功保存你的配置', array('core'));
			exit;
		}
		$this->_display ( 'setting' );
		
	}
function mail(){
if ($this->_isPost()) {

			$data = array(
				'mailhost' => htmlspecialchars(trim(V('p:mailhost', ''))),//网站备案信息代码
				'mailpost' => htmlspecialchars(trim(V('p:mailpost', ''))),//网站名称
						'mailusername' => htmlspecialchars(trim(V('p:mailusername', ''))),//网站关键词
						'mailpassword' => htmlspecialchars(trim(V('p:mailpassword', ''))),//网站描述
				'mailname' => htmlspecialchars(trim(V('p:mailname', ''))),//网站描述
				'mailnametip' => htmlspecialchars(trim(V('p:mailnametip', ''))),//网站描述
			
				);
				$db=APP :: ADP('db');

			foreach($data as $key=>$value) {
				$db->query('update   '.$db->getTable(T_SETTING).' set value=\''.$value.'\' where name=\''.$key.'\'');
			}
		$settings=$db->query('select * from '.$db->getTable(T_SETTING));
		foreach($settings as $key => $value){
			$setting[$value['name']]=$value['value'];
		}
		file_put_contents('var/data/setting/SPconfig.tpl',serialize($setting));
			$this->_succ('已经成功保存你的配置', array('mail'));
			exit;
		}
		$this->_display ( 'setting_mail' );
		
	}
function statistics(){
if ($this->_isPost()) {

			$data = array(
				'statistics' => V('p:statistics', ''),//网站备案信息代码
			
				);
				$db=APP :: ADP('db');

			foreach($data as $key=>$value) {
				$db->query('update   '.$db->getTable(T_SETTING).' set value=\''.$value.'\' where name=\''.$key.'\'');
			}
		$settings=$db->query('select * from '.$db->getTable(T_SETTING));
		foreach($settings as $key => $value){
			$setting[$value['name']]=$value['value'];
		}
		file_put_contents('var/data/setting/SPconfig.tpl',serialize($setting));
			$this->_succ('已经成功保存你的配置', array('statistics'));
			exit;
		}
		$this->_display ( 'setting_statistics' );
		
	}
	function login(){
		if ($this->_isPost()) {
		$adminuser = trim(V('p:adminuser'));
			$adminpwd = trim(V('p:adminpassword'));
			$verify_code = strtolower(V('p:verify_code'));
			if (empty($adminuser) || empty($adminpwd)) {
				exit('{"state":"401", "msg":"帐号或密码错误"}');
			}
		if(IS_USE_CAPTCHA) {
				$autocode = APP :: N('SimpleCaptcha');
				if (!$autocode->checkAuthcode($verify_code)) {
					exit('{"state":"402", "msg":"验证码错误"}');
				}
			}
			$db = APP::ADP ( 'db' );
			$user=$db->query('select * from ' . $db->getTable ( T_ADMINUSER ) . ' where adminuser=\''.$adminuser.'\' and adminpassword=\''.md5($adminpwd).'\'');
			if($user){
			$usrinfo=array('adminuser'=>$adminuser,'adminpwd'=>md5($adminpwd));
			USER::set('adminuserinfo', serialize($usrinfo));	//设置管理员权限	
			exit('{"state":"200"}');
			}else{
				exit('{"state":"401", "msg":"帐号或密码错误"}');
			}
		}else{
		$this->_display ( 'login' );
		}
	}
	
	
	function repassword(){
		if ($this->_isPost()) {
			$oldpassword = trim(V('p:oldpassword'));
			$password = trim(V('p:password'));
			$repassword = strtolower(V('p:repassword'));
			$guser=USER::get('__CLIENT_ADMIN_ROOT');
			$admininfo=unserialize($guser);
			
			$db = APP::ADP ( 'db' );
			$user=$db->query('select * from ' . $db->getTable ( T_ADMINUSER ) . ' where adminuser=\''.$admininfo['adminuser'].'\' and adminpassword=\''.md5($oldpassword).'\'');
			//print_r($oldpassword);

			if($user&&($password==$repassword)){
				$db->query('update ' . $db->getTable ( T_ADMINUSER ) . ' set adminpassword=\''.md5($password).'\' where adminuser=\''.$admininfo['adminuser'].'\' and adminpassword=\''.md5($oldpassword).'\'');
				$this->_succ('已经成功保存你的配置', array('repassword'));
			}else{
				$this->_succ('修改失败', array('repassword'));
			}
		
		}else{
			$this->_display ( 'setting_password' );
		}
		
	}
	

	
	
	

}
?>