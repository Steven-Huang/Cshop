<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-03-30 09:28:24
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 燕之居下单抽奖页面
 | 
 */

class SlyderAction extends Action {
	// 抽奖页面，消息模板跳转过来
	public function index()
	{
		$time = strtotime("2016-04-30") - time();
		$this->assign('time', $time);

    	$order = M("order")->where(array('orderId'=>$_GET['orderId']))->find();
		$this->assign('order', $order);
		$this->display();
	}

	/**
     * 抽奖处理函数
     * @return [type] [description]
     */
    public function run()
    {
        $proArr = array();
        //v 是中奖概率，id为奖品编号，min、max分别为最大和最小角度
        $prize_arr = array( 
            '0' => array('id'=>1,'min'=>37,'max'=>108,'prize'=>'DQ50元冰淇淋券','v'=>1), 
            '1' => array('id'=>2,'min'=>109,'max'=>180,'prize'=>'面包新语20元抵用券','v'=>5), 
            '2' => array('id'=>3,'min'=>181,'max'=>252,'prize'=>'谢谢参与','v'=>92), 
            '3' => array('id'=>4,'min'=>253,'max'=>324,'prize'=>'肯德基100元代金券','v'=>1), 
            '4' => array('id'=>5,'min'=>array(325,1),'max'=>array(360,36),'prize'=>'价值40元暖手枕','v'=>1)
        ); 
        //获取随机奖品
        foreach ($prize_arr as $v) {
            $proArr[$v['id']] = $v['v'];
        }
        $rid = $this->getRand($proArr); //根据概率获取奖项id 
        // $rid = $_POST['rid']; // 自己设置奖项
        $res = $prize_arr[$rid-1]; //中奖项 
        $min = $res['min']; 
        $max = $res['max']; 

        if($res['id']==5){ //五等奖 
            $i = mt_rand(0,1); 
            $result['angle'] = mt_rand($min[$i],$max[$i]); 
        }else{ 
            $result['angle'] = mt_rand($min,$max); //随机生成一个角度 
        } 
        $result['prize'] = $res['prize']; //奖项

        // 判断是否以抽奖
        $check = M('slyder')->where(array('orderID'=>$_POST['orderId']))->find();
        if(!$check){
        	$qrcode = $this->qrCode($_POST['orderId']);
	        if($qrcode){
	        	// 存储用户信息
		        $slyder['prize'] = $result['prize'];
		        $slyder['openid'] = $_POST['openid'];
		        $slyder['orderID'] = $_POST['orderId'];
		        $slyder['time'] = time();
		        $slyder['qrcode'] = $qrcode;
		        $slyder['flag'] = 0;
		        M('slyder')->add($slyder);
	        }
	        echo json_encode($result);
        }else{
        	$result['prize'] = '0';
			echo json_encode($result); 
        }
    }

    /**
     * 生成二维码
     * @return [type] [description]
     */
    public function qrCode($orderId)
    {
    	// 生成图片文件名
        $rand_str = str_shuffle('ABCDEFGHIGKLMNOPQRSTUVWXYZ1234567890');
        $fileName = substr($rand_str, 0, 8).".png";

        // 生成图片
        Vendor('phpqrcode.phpqrcode');
        $object = new \QRcode();
        $data = "http://wxe.csrcbank.com/yanzhiju/index.php?g=App&m=Slyder&a=delQrcode&orderId=".$orderId;
        $file = "./Public/QRcode/".$fileName;
        $object::png($data, $file, 'L', 5, 2);

        while(!file_exists($file)){
            $object::png($data, $file, 'L', 5, 2); 
        }

        return $fileName;
    }

    /**
     * 显示二维码
     * @return [type] [description]
     */
    public function showQRcode()
    {
    	$qrcodes = M('slyder')->where(array('openid'=>$_GET['openid']))->select();
    	$this->assign('qrcodes', $qrcodes);
    	$this->assign('openid', $_GET['openid']);
    	$this->display();
    }

    /**
     * 二维码核销页面
     * @return [type] [description]
     */
    public function delQrcode()
    {
    	$order = M("order")->where(array('orderId'=>$_GET['orderId']))->find();
    	$slyder = M("slyder")->where(array('orderID'=>$_GET['orderId']))->find();
    	$this->assign('order', $order);
    	$this->assign('slyder', $slyder);
    	$this->display();
    }

    /**
     * 核销二维码
     * @return [type] [description]
     */
    public function delCode()
    {
    	$slyder = M("slyder")->where(array('orderID'=>$_GET['orderId']))->find();
    	$slyder['flag'] = 1;
    	$result = M("slyder")->save($slyder);
    	if($result){
    		$this->success("核销成功！");
    	}else{
    		$this->error("核销失败！");
    	}
    }

    /**
     * 根据概率从奖池抽奖
     * @param  [type] $proArr [description]
     * @return [type]         [description]
     */
    protected function getRand($proArr) { 
        $result = ''; 
     
        //概率数组的总概率精度 
        $proSum = array_sum($proArr); 
     
        //概率数组循环 
        foreach ($proArr as $key => $proCur) { 
            $randNum = mt_rand(1, $proSum); 
            if ($randNum <= $proCur) { 
                $result = $key; 
                break; 
            } else { 
                $proSum -= $proCur; 
            } 
        } 
        unset ($proArr); 
        return $result; 
    }

}
?>