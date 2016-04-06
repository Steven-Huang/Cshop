<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-02-25 09:12:51
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | IndexController.处理微信入口，所有微信进入封装在这个控制器
 | 
 */
class IndexAction extends WeixinAction {	
	// 主页,存储用户信息 openid，首次使用需必须绑定手机号
	public function home()
	{
		// 动态配置 slide 和广告图片

		// 存储用户信息
		if($_GET['openid']){//微信进入
			$result = M("user")->where(array('openid'=>$_GET['openid']))->find();
			if(!$result['phone']){//数据库没有用户信息
				$accessToken = $this->getAccessToken();//获取微信api凭证
				$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$accessToken."&openid=".$_GET['openid']."&lang=zh_CN";
				$userData = json_decode(file_get_contents($url));
				$user['openid'] = $userData->openid;
				$user['name'] = $userData->nickname;
				$user['sex'] = $userData->sex;
				$user['registerTime'] = time();
				$user['headImg'] = $userData->headimgurl;
				M("user")->add($user);
				$_SESSION ["user"] = $_GET['openid'];
				$this->assign("openid", $_GET['openid']);
				$this->display("binding");//存储完用户信息需要前去绑定
			}else{//用户已经存在处理
				$_SESSION ["user"] = $_GET['openid'];
				$this->assign('openid', $_SESSION ["user"]);
				$this->display();
			}		
		}else{//没有从微信直接进入
			if($_SESSION ["user"]){//检测session是否存入用户openid
				$this->display();
			}else{
				$this->display("userLogin");
			}
		}	
	}

	// 燕之居饮品页面
	public function juice()
	{
		// 店铺是否营业
		if((time() > strtotime("07:00:00"))&&(time() < strtotime("19:00:00"))){
			$open = 1;
		}else{
			$open = 0;
		}

		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		// 封装 menu 数据，替换为数据库查询结果
		$juiceMenu = M("menu")->where(array("showFlag"=>'1'))->select();
		$menuId = $_GET['menuId'];
		$flag = 0;
		for($i = 0 ,$count = count($juiceMenu); $i < $count; $i++){
			if($juiceMenu[$i]['menuId'] == $menuId){
				$juiceMenu[$i]['currentFlag'] = 1;
				$flag = 1;
			}
		}
		// 默认为热卖产品菜单
		if(!$flag){
			$menuId = 'hot';
		}

		if($menuId == 'hot'){// 热卖产品排序，取前十个
			$this->assign('hot', 1);
			// 查询销量前十数据
			$goods = M("JuiceGood")->where(array('showFlag'=>'1'))->order('sales desc')->limit(10)->select();	
			$this->assign("goods", $goods);
			$this->assign("juiceMenu", $juiceMenu);
			$this->assign("open", $open);
			$this->display();
		}else{
			// 查询目录下的数据
			$goods = M("JuiceGood")->where(array('menuId'=>$menuId, 'showFlag'=>'1'))->order('serialNumber desc')->select();	
			$this->assign("goods", $goods);
			$this->assign("juiceMenu", $juiceMenu);
			$this->assign("open", $open);
			$this->display();
		}
	}

	// 面包糕点预定页面
	public function reserve()
	{
		// 店铺是否营业
		if((time() > strtotime("07:00:00"))&&(time() < strtotime("19:00:00"))){
			$open = 1;
		}else{
			$open = 0;
		}

		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$goods = M("reserve")->where(array('showFlag'=>1,'menuFlag'=>1))->order(array('number'=>'desc', 'saleTimeFlag'=>'asc'))->select();	
		// 判断是否可以购买 buyFlag
		$timeFlag = strtotime(date("Y-m-d")) + 15*3600;//下午三点
		foreach ($goods as $key => $value) {
			// 当天卖的产品
			if($value['saleTimeFlag'] == strtotime(date("Y-m-d"))){
				if(time() > $timeFlag || $value['number'] == 0){//两点之后或库存为零
					$goods[$key]['buyFlag'] = 0;
				}else{
					$goods[$key]['buyFlag'] = 1;
				}
			}else if($value['saleTimeFlag'] == (strtotime(date("Y-m-d")) + 24*3600)){
				if(time() > $timeFlag && $value['number'] != 0){//两点之后库存不为零
					$goods[$key]['buyFlag'] = 1;
				}else{
					$goods[$key]['buyFlag'] = 0;
				}
			}else{
				$goods[$key]['buyFlag'] = 0;
			}

			$goods[$key]['saleTimeFlag'] = date("Y-m-d",$value['saleTimeFlag']);
		}
		
		$this->assign("goods", $goods);
		$this->assign("open", $open);
		$this->display();
	}

	// 净菜预定页面
	public function reserveVage()
	{
		// 店铺是否营业
		if((time() > strtotime("07:00:00"))&&(time() < strtotime("15:00:00"))){
			$open = 1;
		}else{
			$open = 0;
		}

		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$goods = M("reserve")->where(array('showFlag'=>1,'menuFlag'=>2))->order(array('number'=>'desc', 'saleTimeFlag'=>'asc'))->select();	
		// 判断是否可以购买 buyFlag
		$timeFlag = strtotime(date("Y-m-d")) + 15*3600;//下午两点
		foreach ($goods as $key => $value) {
			// 当天卖的产品
			if($value['saleTimeFlag'] == strtotime(date("Y-m-d"))){
				if(time() > $timeFlag || $value['number'] == 0){//两点之后或库存为零
					$goods[$key]['buyFlag'] = 0;
				}else{
					$goods[$key]['buyFlag'] = 1;
				}
			}else if($value['saleTimeFlag'] == (strtotime(date("Y-m-d")) + 24*3600)){
				if(time() > $timeFlag && $value['number'] != 0){//两点之后库存不为零
					$goods[$key]['buyFlag'] = 1;
				}else{
					$goods[$key]['buyFlag'] = 0;
				}
			}else{
				$goods[$key]['buyFlag'] = 0;
			}

			$goods[$key]['saleTimeFlag'] = date("Y-m-d",$value['saleTimeFlag']);
		}
		
		$this->assign("goods", $goods);
		$this->assign("open", $open);
		$this->display();
	}

	// 面包糕点预定页面
	public function breakfast()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$goods = M("JuiceGood")->select();	
		$this->assign("goods", $goods);
		$this->display();
	}

	// 用户中心
	public function user()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$this->display();
	}

	// 商品详情页
	public function goodDetail()
	{
		if($_GET['openid']){
			$_SESSION["user"] = $_GET['openid'];
		}
		$good = M("good")->where(array('id'=>$_GET['id']))->find();
		$this->assign("good",$good);
		$this->display();
	}

	// 针对糕点预定
    public function number()
    {
    	$keyword = $_GET['keyword'];
        if(strstr($keyword,"a")){//增加库存
    		$result = explode('a',$keyword);
            $reserve = M("reserve")->where(array('goodId'=>$result[0]))->find();
            $reserve['number'] += $result[1];
            if(M("reserve")->save($reserve)){
            	echo $reserve['name']."库存增加到".$reserve['number'];
            }else{
            	echo $reserve['name'];
            }                           	
        }else{//减少库存
    		$result = explode('m',$keyword); 
            $reserve = M("reserve")->where(array('goodId'=>$result[0]))->find();
            $reserve['number'] -= $result[1];
            if(M("reserve")->save($reserve)){
                echo $reserve['name']."库存减少到".$reserve['number']; 
            }else{
            	echo $reserve['name'];
            }
        }
    }

    // 所有要预定商品库存
    public function reserveDetail()
    {   
    	$result = "";
        $reserves = M("reserve")->order('number desc')->select();
        for($i = 0; $i < count($reserves); $i++){
            $result = $result.$reserves[$i]['goodId']."、[".$reserves[$i]['showFlag']."]".$reserves[$i]['name']."  ".$reserves[$i]['number']."份\n";
        }
        $result = $result."\n\n设置方法：\nk12a10\n（给编号12的商品增加10个）\nk12m10\n（给编号12的商品减少10个）";
        echo $result;
    }
}