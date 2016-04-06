<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 09:28:04
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 后台入口模块，删除了设置参数函数
 | 
 */

class IndexAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}

	//显示首页模板
	public function index() {
		$this->display ();
	}


	// 商城首页设置页面
	// public function set() {
	// 	if ($_SESSION ["wadmin"]) {
	// 	}
	// }

	// 设置主题
	// public function settheme(){
	// }

	// 设置支付宝账户信息
	// public function setalipay(){
	// }
}