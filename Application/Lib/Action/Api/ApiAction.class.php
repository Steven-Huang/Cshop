<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 09:41:27
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 接口模块
 | 
 */

class ApiAction extends Action {
	// 管理员登录接口
	public function login($username, $password) {
		$where ["username"] = $username;
		$where ["password"] = md5 ( $password );
		$result = M ( "Admin" )->where ( $where )->find ();
		if ($result) {
			return $result ["username"];
		}
	}

	// 用户采用账户密码登录
 	public function userLogin($phone, $password) {
 		$where ["phone"] = $phone;
 		$where ["password"] = md5 ($password);
 		$result = M("User")->where($where)->find ();
 		if($result) {
 			return $result;
 		}
 	}

 	// 短信验证码核对
 	public function code($code, $phone) {
 		// 验证短信代码，成功返回code
 		$where['phone'] = $phone;
 		$result = M ("Code")->where($where)->find();
 		$resultcode = $result['code'];
 		if( $code != $resultcode ) {
 			$this->error("验证码错误！", U('App/User/register'));
 		}
 	}

 	// 短信验证码核对
 	public function code2($code, $phone) {
 		// 验证短信代码，成功返回code
 		$where['phone'] = $phone;
 		$result = M ("Code")->where($where)->find();
 		$resultcode = $result['code'];
 		if( $code != $resultcode ) {
 			$this->error("验证码错误！", U('App/User/forget'));
 		}
 	}

 	// 用户退出
 	public function userLogout() {
 		unset($_SEESION["user"]);
 		$this->success( '已注销登录！', U("App/Index/index"));
 	}

	// 获取网站设置信息
	public function getsetting() {
		$result = M ( "Info" )->find ();
		if ($result) {
			return $result;
		}
	}

	// 设置网站名称和公告信息
	public function setting($name, $notification) {
		$data ["id"] = 1;
		$data ["name"] = $name;
		$data ["notification"] = $notification;
		$result = M ( "Info" )->save ( $data );
		if ($result) {
			return $result;
		}
	}

	// 获取支付宝配置信息
	public function getalipay() {
		$result = M ( "Alipay" )->find ();
		if ($result) {
			return $result;
		}
	}

	// 设置支付宝支付配置信息
	public function setalipay($name, $appkey, $key) {
		$select = M("Alipay")->find();
		if ($select) {
			$data =$select;
			$data ["name"] = $name;
			$data ["appkey"] = $appkey;
			$data ["key"] = $key;
			// var_dump($data);
			$result = M ( "Alipay" )->save ( $data );
		}else{
			$data ["name"] = $name;
			$data ["appkey"] = $appkey;
			$data ["key"] = $key;
			
			$result = M ( "Alipay" )->add ( $data );
		}
		
		if ($result) {
			return $result;
		}
	}

	// 获取商品
	public function getgood() {
		//获取上架的产品
		$where = "status != '下架'";
		$result = M ( "Good" )->where($where)->select ();
		if ($result) {
			return $result;
		}
	}

	// 增加商品
	public function addgood($data) {
		//var_dump($data);
		if ($data["id"]) {
			$result = M ( "Good" )->save($data);
		}else{
			$result = M ( "Good" )->add($data);

			$result = M ( "Good" )->save($data);
		}
		//var_dump($result);
		if ($result) {
			return $result;
		}
	}

	// 删除商品
	public function delgood($id) {
		$result = M ( "Good" )->where ( array (
				"id" => $id 
		) )->delete ();
		if ($result) {
			return $result;
		}
	}

	// 下架商品
	public function xiajia($id) {
		$data["id"] = $id;
		$data["status"] = "下架";
		$result = M ("Good")->save ($data);
		if($result){
			return $result;
		}
	}

	// 获取前台主题
	public function gettheme() {
		$m = M ( "Info" );
		$result = $m->find ();
		if ($result) {
			return $result;
		}
	}

	// 删除订单信息
	public function delorder($id) {
		$where['id'] = $id;
		$data = M("Order")->where($where)->find();

		$s['good_id'] = $data['good_id'];
			$seats = explode(('、'), $data['seat_id']);
			$num = count($seats);
			for($i = 0;$i < $num; $i++){
				$s['seat'] = str_replace('排', '_', $seats[$i]);
				$s['seat'] = str_replace('座', '', $s['seat']);
				$result = M("Seat")->where($s)->delete();
				if(!$result){
					$this->error("座位删除失败！", U('Admin/Order/index'),1);
				}
			}

		$reuslt = M ( "Order" )->where ( array (
				"id" => $id 
		) )->delete ();
		if ($reuslt) {
			return $reuslt;
		}
	}

	// 获取用户信息
	public function getuser($uid) {
		$m = M ( "User" );
		$where["uid"] = $uid;
		$result = $m->where($where)->find ();
		if ($result) {
			return $result;
		}
	}

}










