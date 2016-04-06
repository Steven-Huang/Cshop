<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 09:31:37
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 用户登陆
 | 
 */

class LoginAction extends Action {
	public function index() {
		$this->display ( "Public:login" );
	}

	// 用户登录
	public function login() {
		$result = R ( "Api/Api/login", array (
				$_POST ["username"],
				$_POST ["password"] 
		) );
		
		if ($result) {
			$_SESSION ["wadmin"] = $result;
			$this->success ( "登录成功", U ( "Admin/Index/index" ) );
		} else {
			$this->error ( "登录失败", U ( "Admin/Index/index" ) );
		}
	}
	public function logout() {
		unset ( $_SESSION ["wadmin"] );
		$this->success ( '已注销登录！', U ( "Admin/Login/index" ) );
	}
}