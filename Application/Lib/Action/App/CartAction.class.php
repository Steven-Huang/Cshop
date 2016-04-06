<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 09:42:48
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 购物车模块
 | 
 */

 class CartAction extends PayAction {
	
	// 购物车确认页面
	public function index()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$totalPrice = 0;
		$selectedGoodNumber = 0;
		$cartInfo = json_decode($_POST['cartInfo']);
		for($i = count($cartInfo)-1; $i > 0; $i--){
			if($cartInfo[$i]->goodNum){
				$goods[$i] = M("JuiceGood")->where(array('goodId'=>$cartInfo[$i]->goodId))->find();
				$goods[$i]['selectNumber'] = $cartInfo[$i]->goodNum;
				$totalPrice += (int)$goods[$i]['selectNumber']*$goods[$i]['price'];
				$selectedGoodNumber += (int)$goods[$i]['selectNumber'];
			}	
		}

		$this->assign('cartInfo', htmlspecialchars($_POST['cartInfo']));
		$this->assign('totalPrice', $totalPrice);
		$this->assign('selectedGoodNumber', $selectedGoodNumber);
		$this->assign('goods', $goods);

		// 用户信息
		$userInfo = M("user")->where(array('openid'=>$_SESSION['user']))->find();
		$this->assign('userInfo', $userInfo);
		$this->display();
	}

	// 购物车预定确认页面
	public function reserve()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$totalPrice = 0;
		$selectedGoodNumber = 0;
		$cartInfo = json_decode($_POST['cartInfo']);

		for($i = count($cartInfo)-1; $i > 0; $i--){
			if($cartInfo[$i]->goodNum){
				$goods[$i] = M("reserve")->where(array('goodId'=>$cartInfo[$i]->goodId))->find();
				$goods[$i]['selectNumber'] = $cartInfo[$i]->goodNum;
				$totalPrice += (int)$goods[$i]['selectNumber']*$goods[$i]['price'];
				$selectedGoodNumber += (int)$goods[$i]['selectNumber'];
			}	
		}

		$this->assign('cartInfo', htmlspecialchars($_POST['cartInfo']));
		$this->assign('totalPrice', $totalPrice);
		$this->assign('selectedGoodNumber', $selectedGoodNumber);
		$this->assign('goods', $goods);
		// 用户信息
		$userInfo = M("user")->where(array('openid'=>$_SESSION['user']))->find();
		$this->assign('userInfo', $userInfo);
		$this->display();
	}

	// 预定订单提交
	public function submitReserve()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		// 需要先处理未支付订单
		
		// 处理销量数据
		$cartInfo = json_decode($_POST['cartInfo']);
		for($i = count($cartInfo)-1; $i > 0; $i--){
			if($cartInfo[$i]->goodNum){
				$good = M("reserve")->where(array('goodId'=>$cartInfo[$i]->goodId))->find();
				$good['sales'] += $cartInfo[$i]->goodNum;
				$good['number'] -= $cartInfo[$i]->goodNum;
				if($good['number'] < 0){
					$this->error("您慢啦，库存不足，下单失败！", U("App/Index/home",array('openid'=>$_SESSION['user'])), 2);
					exit;
				}
				M("reserve")->save($good);
			}	
		}

		// 处理商品数量信息
		$Order['cartInfo'] = $_POST['cartInfo'];
		// $Order['selectTime'] = $_POST['selectTime'];
		$Order['distributionStyle'] = "到店自提";
		$Order['userPhone'] = $_POST['userPhone'];
		$Order['Address'] = "";
		$Order['remark'] = $_POST['remark'];
		$Order['totalPrice'] = $_POST['totalPrice'];
		$Order['goodNum'] = $_POST['goodNum'];
		$Order['userName'] = $_POST['userName'];
		$Order['openid'] = $_POST['openid'];
		$Order['orderTime'] = time();
		$Order['orderId'] = "Reserve".time().rand(1000,10000);
		$Order['orderType'] = 1;
		$result = M("Order")->add($Order);

		if($result){
			// 封装支付数据
			$time = date("Ymdhisa", $Order['orderTime']);
			$postdata=$this->EBPReq($Order['openid'], $Order['orderId'], $time, $Order['totalPrice']*100, "燕之居预定", $Order['goodNum'], "燕之居线上预定", "00", "", "");
	    	$xml = htmlspecialchars($postdata);
	    	// echo $xml;
	        $this->assign("xml", $xml);
			$this->display();
		}else{
			// $this->error("添加订单错误！");
			var_dump($Order);
		}
		
	}

	// 饮品订单提交
	public function submitOrder()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		// 需要先处理未支付订单
		
		// 处理销量数据
		$cartInfo = json_decode($_POST['cartInfo']);
		for($i = count($cartInfo)-1; $i > 0; $i--){
			if($cartInfo[$i]->goodNum){
				$good = M("JuiceGood")->where(array('goodId'=>$cartInfo[$i]->goodId))->find();
				$good['sales'] += $cartInfo[$i]->goodNum;
				$good['number'] -= $cartInfo[$i]->goodNum;
				if($good['number'] < 0){
					$this->error("没有库存，失败！", U("App/Index/home",array('openid'=>$_SESSION['user'])), 2);
					exit;
				}
				M("JuiceGood")->save($good);
			}	
		}
		// 处理商品数量信息
		$Order['cartInfo'] = $_POST['cartInfo'];
		$Order['selectTime'] = $_POST['selectTime'];
		$Order['distributionStyle'] = $_POST['distributionStyle'];
		$Order['userPhone'] = $_POST['userPhone'];
		$Order['Address'] = $_POST['Address'];
		$Order['remark'] = $_POST['remark'];
		$Order['totalPrice'] = $_POST['totalPrice'];
		$Order['goodNum'] = $_POST['goodNum'];
		$Order['userName'] = $_POST['userName'];
		$Order['openid'] = $_POST['openid'];
		$Order['orderTime'] = time();
		$Order['orderId'] = "Juice".time().rand(1000,10000);
		$result = M("Order")->add($Order);
		
		if($result){
			// 封装支付数据
			$time = date("Ymdhisa", $Order['orderTime']);
			$postdata=$this->EBPReq($Order['openid'], $Order['orderId'], $time, $Order['totalPrice']*100, "燕之居饮品", $Order['goodNum'], "燕之居饮品订单", "00", "", "");
	    	$xml = htmlspecialchars($postdata);
	    	// echo $xml;
	        $this->assign("xml", $xml);
			$this->display();
		}else{
			// $this->error("添加订单出错！");
			var_dump($Order);
		}
	}

	// 二维码生成
	public function QRcode($data){
        Vendor('phpqrcode.phpqrcode');
        $errorCorrectionLevel = 3;//容错级别 
        $matrixPointSize = 5;//生成图片大小 
        //生成二维码图片 
        $object = new \QRcode();
        $path = "./Public/QRcode/";
        $filename = $path.$data.".png";
        $object->png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);   
  	}

 }