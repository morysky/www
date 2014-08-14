<?php
/*************************************************************
 * Created: 2010-4-1
 * 
 * 帐号相关操作文件
 * 
 * @author chuxuwang(chuxuwang@shenpang.cc)
 **************************************************************/

class account_mod {
	
	function index_mod() {
	
	}
	//帐号的默认操作
	function default_action() {
		USER::set ( 'user', 123 );
	}
	
	//登录页面
	function login() {
		if ($_COOKIE ['uid'] && $_COOKIE ['username'] && $_COOKIE ['name'] && $_COOKIE ['password']) {
			$userinfo = array ('uid' => $_COOKIE ['uid'], 'mail' => $_COOKIE ['username'], 'name' => $_COOKIE ['name'] );
			USER::set ( 'userinfo', $userinfo );
		} else {
			$userinfo = USER::get ( 'userinfo' );
		}
		if ($userinfo && false) {
			$goUrl = URL ( 'index' );
			//header('Location:index.php?m=index');
			APP::redirect ( $goUrl, 4 );
		} else {
			
			TPL::display ( 'login' );
		}
	}
	
	//注册页面
	function register() {
		TPL::display ( 'register' );
	}
	
	//注册用户
	function add() {
		$mail = V ( 'p:mail' );
		$name = V ( 'p:name' );
		$name = APP::F ( 'content_filter', $name );
		$password = V ( 'p:password' );
		$tuya = V ( 'p:tuya' );
		$passwordr = V ( 'p:passwordr' );
		if (! APP::F ( 'valid_email', $mail )) {
			$data = '邮箱格式错误!' . '<br>';
		} else {
			$data = '';
		}
		if ($password == $passwordr) {
		} else {
			$data .= '密码不一致!' . '<br>';
		}
		if ($name) {
		} else {
			$data .= '用户名不能为空!' . '<br>';
		}
		$db = APP::ADP ( 'db' );
		$user = $db->query ( 'select  *  from ' . $db->getTable ( T_USERS ) . ' where mail=\'' . $mail . '\' limit 1 ' );
		if ($user) {
			$data .= '邮箱已经注册过了!' . '<br>';
		}
		if ($tuya == 'iloveyou') {
		
		} else {
			$data .= '你的涂鸦码不正确' . '<br>';
		}
		if ($data == '') {
			$db->query ( 'insert into ' . $db->getTable ( T_USERS ) . '(name,password,mail) values(\'' . $name . '\',\'' . md5 ( $password ) . '\',\'' . $mail . '\') ' );
			$insertid = $db->getInsertId ();
			
			//弹出关注end
			 $db->query('insert into ' . $db->getTable(T_FOLLOWS) . '(uid,name,guid,gname)values(' . $insertid . ',\'' . $name . '\',353,\'身旁网\')');

			if (USER::get ( 'invateuid' ) && USER::get ( 'invateuid' ) != '') {
				$invateuser = $db->query ( 'select  *  from ' . $db->getTable ( T_USERS ) . ' where uid=\'' . USER::get ( 'invateuid' ) . '\' limit 1 ' );
				$db->query ( 'insert into ' . $db->getTable ( T_FOLLOWS ) . '(uid,name,guid,gname)values(' . $insertid . ',\'' . $name . '\',' . USER::get ( 'invateuid' ) . ',\'' . $invateuser [0] ['name'] . '\')' );
				USER::set ( 'invateuid', '' );
			}
			$user = $db->query ( 'select  *  from ' . $db->getTable ( T_USERS ) . ' where uid=' . $insertid . ' limit 1 ' );
			$userinfo = array ('uid' => $user [0] ['uid'], 'mail' => $mail, 'name' => $user [0] ['name'] );
			USER::set ( 'userinfo', $userinfo );
            setcookie ( "uid", $user [0] ['uid'], time () + 3600 * 24 );
			setcookie ( "username", $mail, time () + 3600 * 24 );
			setcookie ( "name", $user [0] ['name'], time () + 3600 * 24 );
			header ( 'Location:index.php?m=index.recommend' );
		}
		//TPL::assign('data', $data);
		TPL::display ( 'register' );
	}
	
	//检查用户
	function checkemail() {
		
		$mail = V ( 'p:email' );
		$db = APP::ADP ( 'db' );
		$user = $db->query ( 'select  *  from ' . $db->getTable ( T_USERS ) . ' where mail=\'' . $mail . '\' limit 1 ' );
		if ($user) {
			echo 'fail';
		} else {
			echo 'success';
		}
	
	}
	
	//用户登录 
	function loginin() {
		$mail = V ( 'p:mail' );
		$password = V ( 'p:password' );
		$remember = V ( 'p:remb' );
		$db = APP::ADP ( 'db' );
		$user = $db->query ( 'select  *  from ' . $db->getTable ( T_USERS ) . ' where mail=\'' . $mail . '\' and password=\'' . md5 ( $password ) . '\' and orban=0 limit 1 ' );
		if ($user) {
			$userinfo = array ('uid' => $user [0] ['uid'], 'mail' => $mail, 'name' => $user [0] ['name'] );
			if (! empty ( $remember )) {
				setcookie ( "uid", $user [0] ['uid'], time () + 3600 * 24 * 365 );
				setcookie ( "username", $mail, time () + 3600 * 24 * 365 );
				setcookie ( "name", $user [0] ['name'], time () + 3600 * 24 * 365 );
			} else {
				setcookie ( "uid", $user [0] ['uid'], time () + 3600 * 24 );
				setcookie ( "username", $mail, time () + 3600 * 24 );
				setcookie ( "name", $user [0] ['name'], time () + 3600 * 24 );
			}
			USER::set ( 'userinfo', $userinfo );
			header ( 'Location:index.php?m=index' );
		} else {
			$data = '邮箱或密码不正确' . '<br>';
			TPL::assign ( 'data', $data );
			TPL::display ( 'login' );
		}
	}
	
	//退出
	function logout($eUrl = false) {
		USER::resetInfo ();
		setcookie ( "uid", '', time () - 3600 * 24 );
		setcookie ( "username", '', time () - 3600 * 24 );
		setcookie ( "name", '', time () - 3600 * 24 );
		setcookie ( "password", '', time () - 3600 * 24 );
		if ($eUrl) {
			$goUrl = URL ( $eUrl );
		} else {
			$goUrl = URL ( 'account.login' );
		}
		APP::redirect ( $goUrl, 4 );
	
	}
	
	//检查是否登录 
	function gloCheckLogin() {
		
		if ($_COOKIE ['uid'] && $_COOKIE ['username'] && $_COOKIE ['name'] && $_COOKIE ['password']) {
			$userinfo = array ('uid' => $_COOKIE ['uid'], 'mail' => $_COOKIE ['username'], 'name' => $_COOKIE ['name'] );
			USER::set ( 'userinfo', $userinfo );
		
		} else {
			$userinfo = USER::get ( 'userinfo' );
		}
		//var_dump($uid);exit;
		// echo 'hihihi';
		//exit;
		//$login_way = V('-:sysConfig/login_way', 1)*1; 
		// 未登录
		if (! $userinfo) {
			$this->_goLogin ();
			exit ();
		} else {
			return true;
		}
	}
	
	/// 自动跳转 
	function _goLogin() {
		$login_way = 4;
		switch ($login_way) {
			case 2 :
			case 1 :
			case 3 :
			default :
				$goUrl = URL ( 'account.login' );
				break;
		}
		APP::redirect ( $goUrl, 4 );
	}
}
