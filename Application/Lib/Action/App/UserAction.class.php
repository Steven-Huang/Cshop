<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 10:48:24
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 用户模块
 | 
 */

class UserAction extends Action {
	// 用户中心
	public function index(){
		if($_GET['payback'] == 'yes'){
			// 发送订单打印通知
			$orderNo = $_GET['orderNo'];
			$url = "http://wxe.csrcbank.com/yanzhiju/index.php?g=App&m=Weixin&a=sendPrintMsg&orderId=".$orderNo;
	   	 	$result = file_get_contents($url);	
		}
 
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$openid = $_SESSION["user"];
		$user = M("user")->where(array('openid'=>$openid))->find();
		$this->assign('user', $user);
		$this->display();
	}

	// 订单中心
	public function order()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$openid = $_SESSION["user"];
		// 用户信息
		$user = M("user")->where(array('openid'=>$openid))->find();
		$this->assign('user', $user);
		// 订单列表
		$order = M("order")->where(array('openid'=>$openid))->order('id desc')->select();
		$this->assign('orders', $order);
		$this->display();
	}

	// 订单详情页面
	public function orderDetail()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$totalPrice = 0;
		$selectedGoodNumber = 0;
		$order = M("order")->where(array('id'=>$_GET['id']))->find();
		// 商品信息封装
		$cartInfo = json_decode($order['cartInfo']);
		// 判断订单种类
		$orderFlag = strstr($order['orderId'],"Juice");  
      	if($orderFlag != ""){//是饮品订单
      		for($i = count($cartInfo)-1; $i > 0; $i--){
				if($cartInfo[$i]->goodNum){
					$goods[$i] = M("JuiceGood")->where(array('goodId'=>$cartInfo[$i]->goodId))->find();
					$goods[$i]['selectNumber'] = $cartInfo[$i]->goodNum;
					$totalPrice += (int)$goods[$i]['selectNumber']*$goods[$i]['price'];
					$selectedGoodNumber += (int)$goods[$i]['selectNumber'];
				}	
			}
      	}else{
      		for($i = count($cartInfo)-1; $i > 0; $i--){
				if($cartInfo[$i]->goodNum){
					$goods[$i] = M("reserve")->where(array('goodId'=>$cartInfo[$i]->goodId))->find();
					$goods[$i]['selectNumber'] = $cartInfo[$i]->goodNum;
					$totalPrice += (int)$goods[$i]['selectNumber']*$goods[$i]['price'];
					$selectedGoodNumber += (int)$goods[$i]['selectNumber'];
				}	
			}
      	}

		$this->assign('totalPrice', $totalPrice);
		$this->assign('selectedGoodNumber', $selectedGoodNumber);
		$this->assign('goods', $goods);
		$this->assign('order', $order);

		$this->display();
	}

	// 积分记录
	public function integral()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$openid = $_SESSION["user"];
		// 用户信息
		$user = M("user")->where(array('openid'=>$openid))->find();
		$this->assign('user', $user);
		// 积分记录
		$integral = M("integral")->where(array('openid'=>$openid))->order("integralTime desc")->select();
		$this->assign('integrals', $integral);
		$this->display();
	}

	// 用户提交注册信息
	public function binDing() {
 		// 验证手机号是否被注册
 		$result = M("User")->where(array('phone'=>$_POST['phone']))->find();
 		if($result) {
 			$this->error("手机号已注册，请重试！");
 		}else {
 			$code = M("code")->where(array('phone'=>$_POST['phone']))->find();
 			if($code['code'] != $_POST['phonecode']){
 				$this->error("验证码错误，请重试！");
 			}else{
 				//增加到数据库
 				$user = M("User")->where(array('openid'=>$_POST['openid']))->find();
 				if($_POST['username']){
	 				$user["name"] = $_POST["username"];
 				}
		 		$user["phone"] = $_POST["phone"];
		 		$user["password"] = md5($_POST["password"]);
		 		$user['openid'] = $_POST["openid"];
		 		$bind = M ("User") ->save($user);
		 		// 判断是增加成功
		 		if($bind) {
		 			$this->success( "绑定成功，正在登陆···", U("App/Index/home",array('openid'=>$_POST['openid'])), 1);
		 		}else {
		 			$this->error( "绑定失败，请在微信中重试!");
		 		}
 			}	
 		}		
	}

	// 用户接单，0不接单，1接单
	public function receiveOrder()
	{
		$openid = $_GET['openid'];
		$result = M("templateuser")->where(array('openid'=>$openid))->find();
		if($result['userFlag'] == 1){
			$result['userFlag'] = 0;
			M("templateuser")->save($result);
			echo "停止接单";
		}elseif ($result['userFlag'] == 0) {
			$result['userFlag'] = 1;
			M("templateuser")->save($result);
			echo "开始接单";
		}elseif ($result['userFlag'] == 2) {
			$result['userFlag'] = 1;
			M("templateuser")->save($result);
			echo "开始接单";
		}elseif ($result['userFlag'] == 3) {
			$result['userFlag'] = 1;
			M("templateuser")->save($result);
			echo "开始接单";
		}elseif(!$result){
			$result['userFlag'] = 1;
			M("templateuser")->add($result);
			echo "开始接单";
		}
	}

	// 用户配送，2配送，3不配送
	public function sendOrder()
	{
		$openid = $_GET['openid'];
		$result = M("templateuser")->where(array('openid'=>$openid))->find();
		if($result['userFlag'] == 2){
			$result['userFlag'] = 3;
			M("templateuser")->save($result);
			echo "停止配送";
		}elseif($result['userFlag'] == 3) {
			$result['userFlag'] = 2;
			M("templateuser")->save($result);
			echo "开始配送";
		}elseif($result['userFlag'] == 1) {
			$result['userFlag'] = 2;
			M("templateuser")->save($result);
			echo "开始配送";
		}elseif($result['userFlag'] == 0) {
			$result['userFlag'] = 2;
			M("templateuser")->save($result);
			echo "开始配送";
		}elseif(!$result){
			$result['userFlag'] = 2;
			M("templateuser")->add($result);
			echo "开始配送";
		}
	}

}
