<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 09:27:06
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 商品管理
 | 
 */

class GoodAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}

	// 显示商品信息
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = M ( "JuiceGood" );
		
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
        $Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');
        //(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
		$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();

		// 商品菜单分类
		$juiceMenu = M("menu")->where(array('showFlag'=>'1'))->select();

		$this->assign ( "menu", $juiceMenu );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "goods", $result );
		$this->display ();
	}

	// 显示糕点信息
	public function reserve() {
		import ( 'ORG.Util.Page' );
		$m = M ( "reserve" );
		
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
        $Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');
        //(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
		$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();

		$this->assign ( "menu", $juiceMenu );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "goods", $result );
		$this->display ();
	}

	//显示积分礼品信息
	public function integral()
	{
		import ( 'ORG.Util.Page' );
		$m = M ( "jifengoods" );
		
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 12 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
        $Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');
        //(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
		$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->select ();

		$this->assign ( "menu", $juiceMenu );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->assign ( "goods", $result );
		$this->display ();
	}

	public function addjifengoods()
	{
		$good['name'] = $_POST['goodName'];
		$good['price'] = $_POST['goodPrice'];
		$good['memberPrice'] = $_POST['goodPrice'];
		$good['activeFlagId'] = $_POST['goodActive'];
		$good['showFlag'] = $_POST['goodStatus'];
		$good['number'] = $_POST['goodNum'];
		// 菜单处理
		$good['menuId'] = $_POST['goodMenu'];
		$menu = M("menu")->where(array('menuId'=>$_POST['goodMenu']))->find();
		$good['menuName'] = $menu['name'];
		$good['startScore'] = '9';
		$good['unit'] = $_POST['goodUnit'];
		$good['description'] = $_POST['description'];
		$good['serialNumber'] = $_POST['goodSort'];
		$good['addTime'] = time();
		$good['sales'] = 0;
		// 封面图片处理
		if ($_FILES ['goodImg'] ['name'] !== '') {
			$img = $this->upload ();
			$picurl = "./Public/Uploads/".$img[0][savename];
			$good['imgUrl'] = $picurl;
		}else {
			$this->error ( "未上传图片！" );
		}

		$result = M("jifengoods")->add($good);
		if($result){
			$this->success("添加成功！");
		}else{
			$this->error("添加失败！");
		}
	}

	public function deljifengood()
	{
		$result = M("jifengoods")->where(array("goodId"=>$_GET['id']))->delete();
		if($result){
			$this->success ( "删除商品成功！" );
		}else{
			$this->error ("删除商品失败！");
		}
	}

	//添加商品信息
	public function addGood()
	{
		$good['name'] = $_POST['goodName'];
		$good['price'] = $_POST['goodPrice'];
		$good['memberPrice'] = $_POST['goodPrice'];
		$good['activeFlagId'] = $_POST['goodActive'];
		$good['showFlag'] = $_POST['goodStatus'];
		$good['number'] = $_POST['goodNum'];
		// 菜单处理
		$good['menuId'] = $_POST['goodMenu'];
		$menu = M("menu")->where(array('menuId'=>$_POST['goodMenu']))->find();
		$good['menuName'] = $menu['name'];
		$good['startScore'] = '9';
		$good['unit'] = $_POST['goodUnit'];
		$good['description'] = $_POST['description'];
		$good['serialNumber'] = $_POST['goodSort'];
		$good['addTime'] = time();
		$good['sales'] = 0;
		// 封面图片处理
		if ($_FILES ['goodImg'] ['name'] !== '') {
			$img = $this->upload ();
			$picurl = "./Public/Uploads/".$img[0][savename];
			$good['imgUrl'] = $picurl;
		}else {
			$this->error ( "未上传图片！" );
		}

		$result = M("JuiceGood")->add($good);
		if($result){
			$this->success("添加成功！");
		}else{
			$this->error("添加失败！");
		}
	}

	//添加糕点信息
	public function addReserve()
	{
		$good['name'] = $_POST['goodName'];
		$good['price'] = $_POST['goodPrice'];
		$good['memberPrice'] = $_POST['goodPrice'];
		$good['activeFlagId'] = 0;
		$good['menuFlag'] = $_POST['menuFlag'];
		$good['number'] = $_POST['goodNum'];
		$good['unit'] = $_POST['goodUnit'];
		$good['description'] = $_POST['description'];
		$good['saleTimeFlag'] = $_POST['saleTimeFlag'];
		$good['serialNumber'] = $_POST['goodSort'];
		$good['addTime'] = time();
		$good['sales'] = 0;
		// 封面图片处理
		if ($_FILES ['goodImg'] ['name'] !== '') {
			$img = $this->upload ();
			$picurl = "./Public/Uploads/".$img[0][savename];
			$good['imgUrl'] = $picurl;
		}else {
			$this->error ( "未上传图片！" );
		}

		$result = M("reserve")->add($good);
		if($result){
			$this->success("添加成功！");
		}else{
			$this->error("添加失败！");
		}
	}

	// 删除商品
	public function delGood() {
		$result = M("JuiceGood")->where(array("goodId"=>$_GET['id']))->delete();
		if($result){
			$this->success ( "删除商品成功！" );
		}else{
			$this->error ("删除商品失败！");
		}
	}

	// 删除预定
	public function delReserve() {
		$result = M("reserve")->where(array("goodId"=>$_GET['id']))->delete();
		if($result){
			$this->success ( "删除商品成功！" );
		}else{
			$this->error ("删除商品失败！");
		}
	}

	// 修改reserve
	public function changeDetail()
	{
		$result = M("reserve")->where(array("goodId"=>$_GET['id']))->find();
		$this->assign ( "menu", $juiceMenu );
		$this->assign ( "good", $result );
		$this->display ();
	}

	// 修改预定商品
	public function changeReserve()
	{
		$reserve = M("reserve")->where(array('goodId'=>$_POST['id']))->find();
		
		$reserve['name'] = $_POST['goodName'];
		$reserve['price'] = $_POST['goodPrice'];
		$reserve['memberPrice'] = $_POST['goodPrice'];
		$reserve['menuFlag'] = $_POST['menuFlag'];
		$reserve['activeFlagId'] = 0;
		$reserve['number'] = $_POST['goodNum'];
		$reserve['unit'] = $_POST['goodUnit'];
		$reserve['description'] = $_POST['description'];
		$reserve['saleTimeFlag'] = strtotime($_POST['saleTimeFlag']);
		$reserve['serialNumber'] = $_POST['goodSort'];
		$reserve['addTime'] = time();
		// 封面图片处理
		if ($_FILES ['goodImg'] ['name'] !== '') {
			$img = $this->upload ();
			$picurl = "./Public/Uploads/".$img[0][savename];
			if($picurl){
				$reserve['imgUrl'] = $picurl;
			}
		}

		$result = M("reserve")->save($reserve);
		if($result){
			$this->success("修改成功！", U('Admin/Good/reserve'),1);
		}else{
			$this->error("修改失败！");
		}
	}

	// 下架商品
	public function downGood() {
		$good = M("JuiceGood")->where(array("goodId"=>$_GET['id']))->find();
		$good["showFlag"] = 0;
		$result = M ("JuiceGood")->save($good);
		if($result){
			$this->success ( "下架商品成功！" );
		}else{
			$this->error ("下架商品失败！");
		}
	}

	// 上架商品
	public function upGood() {
		$good = M("JuiceGood")->where(array("goodId"=>$_GET['id']))->find();
		$good["showFlag"] = 1;
		$result = M ("JuiceGood")->save($good);
		if($result){
			$this->success ( "上架商品成功！" );
		}else{
			$this->error ("上架商品失败！");
		}
	}

	// 下架预定
	public function downReserve() {
		$good = M("reserve")->where(array("goodId"=>$_GET['id']))->find();
		$good["showFlag"] = 0;
		$result = M ("reserve")->save($good);
		if($result){
			$this->success ( "下架商品成功！" );
		}else{
			$this->error ("下架商品失败！");
		}
	}

	// 上架预定
	public function upReserve() {
		$good = M("reserve")->where(array("goodId"=>$_GET['id']))->find();
		$good["showFlag"] = 1;
		$result = M ("reserve")->save($good);
		if($result){
			$this->success ( "上架商品成功！" );
		}else{
			$this->error ("上架商品失败！");
		}
	}
}