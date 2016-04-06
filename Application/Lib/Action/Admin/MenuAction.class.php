<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 09:32:08
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 目录模块
 | 
 */

class MenuAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}

	// 显示目录分类
	public function index() {
		$juiceMenu = M("menu")->select();
		$this->assign('menu', $juiceMenu);
		$this->display ();
	}

	// 添加目录分类
	public function addMenu() {
		$menu['name'] = $_POST['menuName'];
		$menu['showFlag'] = 1;
		$result = M("menu")->add($menu);
		if($result){
			$this->success("目录添加成功！");
		}else{
			$this->error("目录添加失败！");
		}
	}

	// 下架目录
	public function downMenu() {
		$good = M("menu")->where(array("menuId"=>$_GET['id']))->find();
		$good["showFlag"] = 0;
		$result = M ("menu")->save($good);
		if($result){
			$this->success ( "隐藏成功！" );
		}else{
			$this->error ("隐藏失败！");
		}
	}

	// 上架目录
	public function upMenu() {
		$good = M("menu")->where(array("menuId"=>$_GET['id']))->find();
		$good["showFlag"] = 1;
		$result = M ("menu")->save($good);
		if($result){
			$this->success ( "显示成功！" );
		}else{
			$this->error ("显示失败！");
		}
	}
}