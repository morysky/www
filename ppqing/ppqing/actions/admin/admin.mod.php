<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 *后台admin 控制类
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/
include ('action.php');
class admin_mod extends action {
	
	function admin_mod() {
		parent::action ();
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
		$this->_display ( 'index' );
	
	}
	function index() {
		$this->_display ( 'index' );
	
	}
	function login() {
		if ($this->_isPost ()) {
			$adminuser = trim ( V ( 'p:adminuser' ) );
			$adminpwd = trim ( V ( 'p:adminpassword' ) );
			$verify_code = strtolower ( V ( 'p:verify_code' ) );
			if (empty ( $adminuser ) || empty ( $adminpwd )) {
				exit ( '{"state":"401", "msg":"帐号或密码错误"}' );
			}
			if (IS_USE_CAPTCHA) {
				$autocode = APP::N ( 'SimpleCaptcha' );
				if (! $autocode->checkAuthcode ( $verify_code )) {
					exit ( '{"state":"402", "msg":"验证码错误"}' );
				}
			}
			$db = APP::ADP ( 'db' );
			$user = $db->query ( 'select * from ' . $db->getTable ( T_ADMINUSER ) . ' where adminuser=\'' . $adminuser . '\' and adminpassword=\'' . md5 ( $adminpwd ) . '\'' );
			if ($user) {
				$usrinfo = array ('adminuser' => $adminuser, 'adminpwd' => md5 ( $adminpwd ) );
				//USER::set('adminuserinfo', serialize($usrinfo));	//设置管理员权限	
				USER::set ( '__CLIENT_ADMIN_ROOT', serialize ( $usrinfo ) ); //设置管理员权限
				USER::aid ( $user [0] ['aid'] );
				exit ( '{"state":"200"}' );
				//APP :: redirect(URL('admin/admin.index', 'admin.php'), 3);
			} else {
				exit ( '{"state":"401", "msg":"帐号或密码错误"}' );
			}
		} else {
			TPL::assign ( 'admin_root', $this->_getUserInfo ( '__CLIENT_ADMIN_ROOT' ) );
			TPL::assign ( 'real_name', $this->_getUserInfo ( 'screen_name' ) );
			TPL::assign ( 'admin_id', $this->_getUid () );
			//echo 'sdfs';
			$this->_display ( 'login' );
		}
	
	}
	
	//重置密码
	function repassword() {
		$this->_display ( 'setting_password' );
	}
	
	/**
	 * 退出登录
	 */
	function logout() {
		USER::aid ( '' );
		USER::set ( '__CLIENT_ADMIN_ROOT', '' );
		//USER::resetInfo();
		APP::redirect ( 'admin/admin.login', 2 );
	}

}
?>