<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 09:32:35
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 订单管理模块
 | 
 */

class OrderAction extends PublicAction {
	function _initialize() {
		parent::_initialize ();
	}

	// 订单列表
	public function index() {
		import ( 'ORG.Util.Page' );
		$m = D ( "Order" );
		
		$count = $m->count (); // 查询满足要求的总记录数
		$Page = new Page ( $count, 10 ); // 实例化分页类 传入总记录数和每页显示的记录数
		$Page -> setConfig('header', '条记录');
        $Page -> setConfig('theme', '<li><a>%totalRow% %header%</a></li> <li>%upPage%</li> <li>%downPage%</li> <li>%first%</li>  <li>%prePage%</li>  <li>%linkPage%</li>  <li>%nextPage%</li> <li>%end%</li> ');//(对thinkphp自带分页的格式进行自定义)
		$show = $Page->show (); // 分页显示输出
		
		$result = $m->limit ( $Page->firstRow . ',' . $Page->listRows )->order("id desc")->relation(true)->select ();
		$this->assign ( "result", $result );
		$this->assign ( "page", $show ); // 赋值分页输出
		$this->display ();
	}

	// 删除订单
	public function del(){
		$result = R ( "Api/Api/delorder", array (
				$_GET ['id'],
		) );
		$this->success ( "操作成功" );
	}

	// 退款，根据自己使用的支付渠道重写
	public function refuard(){
		
	}

	/**
	* 发送HTTP请求方法
	* @param  string $url    请求URL
	* @param  array  $transData 请求参数
	* @param  string $method 请求方法GET/POST
	* @return array  $data   响应数据
	*/
	function http($url, $transData, $method = 'GET', $header = array(), $multi = false){
		$opts = array(
		        CURLOPT_TIMEOUT        => 30,
		        CURLOPT_RETURNTRANSFER => 1,
		        CURLOPT_SSL_VERIFYPEER => false,
		        CURLOPT_SSL_VERIFYHOST => false,
		        CURLOPT_HTTPHEADER     => $header
		);
		/* 根据请求类型设置特定参数 */
		switch(strtoupper($method)){
		    case 'GET':
		        $opts[CURLOPT_URL] = $url . '?' . http_build_query($transData);
		        break;
		    case 'POST':
		        //判断是否传输文件
		        //$transData = $multi ? $transData : http_build_query($transData);
		        $opts[CURLOPT_URL] = $url;
		        $opts[CURLOPT_POST] = 1;
		        $opts[CURLOPT_POSTFIELDS] = $transData;
		        break;
		    default:
		        throw new Exception('不支持的请求方式！');
		}
		/* 初始化并执行curl请求 */
		$ch = curl_init();
		curl_setopt_array($ch, $opts);
		$data  = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);
		if($error) throw new Exception('请求发生错误：' . $error);
		return  $data;
	}

}