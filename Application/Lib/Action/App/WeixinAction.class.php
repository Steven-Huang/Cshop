<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-02-29 00:27:29
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | Weixin Action.
 | 
 */

 class WeixinAction extends Action {
    public function __construct() {
        $this->appid = "";
        $this->secret = "";
    }

    // 微信菜单跳转处理
    public function weiRedirect()
    {
        $redirectUrl = "";
        $Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid."&secret=".$this->secret."&code=".$_GET['code']."&grant_type=authorization_code";
        $result = json_decode(file_get_contents($Url));
        header("Location: ".$redirectUrl.$result->openid);
    }

    // 个性化分组设置
    public function conditionMenu()
    {
        header("content-Type: text/html; charset=utf-8"); 
        $accessToken = $this->getAccessToken();
        // 新增分组
        // $url = "https://api.weixin.qq.com/cgi-bin/groups/create?access_token=".$accessToken;
        // $data = array(
        //   'group' => array(
        //     'name' => "admin",
        //   ),
        // );
        // $result = json_decode($this->post($url, json_encode($data)));
        // $group_id = $result->group->id;
          
        $Menu = '';

        $menuUrl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$accessToken;
        $result = json_decode($this->post($menuUrl, $Menu));
        var_dump($result);
    }

    // 前台通知，只是发送打印
    public function sendPrintMsg()
    {
        $orderId = $_GET['orderId'];
        $this->printOrder($orderId);
    }

 	// 订单完成发送通知
 	public function sendMsg()
 	{
 		$orderId = $_GET['orderId'];
 		$time = $_GET['time'];
 		// 根据orderId获取其他信息
 		$data = M("order")->where(array('orderId'=>$orderId))->find();
        $userName = $data['userName'];
        $totalPrice = "￥".$data['totalPrice'];
 		$touser = $data['openid'];
 		$remark = "爱上燕之居，更多惊喜等着您！";
        $url = $url."&openid=".$touser;
 		// 封装测试数据
 		$data=array(
 				'touser' => $touser,
 				'template_id' => "",
 				'url' => $url,
 				'topcolor' => "#0090d6",
 				'data' => array(
 					'first' => array(
 									'value' => "您已成功支付，感谢您的惠购！",
 									'color' => "#0090d6",
 								),
 					'keyword1' => array(
 									'value' => $userName,
 									'color' => "#ff0000",
 								),
 					'keyword2' => array(
 									'value' => $orderId,
 									'color' => "#ff0000",
 								),
          'keyword3' => array(
                  'value' => $totalPrice,
                  'color' => "#ff0000",
                ),
          'keyword4' => array(
                  'value' => "点击查看详情",
                  'color' => "#ff0000",
                ),
 					'remark' => array(
 									'value' => $remark,
 									'color' => "#0090d6",
 								),
 					)
 			);

 		$accessToken = $this->getAccessToken();
 		$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
 		$responseData = $this->post($url, json_encode($data));
        var_dump($responseData);
        // 处理积分
        $this->addIntegral($orderId, $touser);

        // 新订单通知
        $this->newOrder($orderId);
        $this->printOrder($orderId);
        // 发送抽奖通知
        $this->sendSlyder($orderId);
 	}

    // 发送可以抽奖通知
    public function sendSlyder($orderId)
    {
        // 根据orderId获取其他信息
        $data = M("order")->where(array('orderId'=>$orderId))->find();
        $userName = $data['userName'];
        $totalPrice = $date['totalPrice'];
        $touser = $data['openid'];
        $remark = "点击即可抽奖！";
        $url = "";
        // 封装测试数据
        $data=array(
            'touser' => $touser,
            'template_id' => "",
            'url' => $url,
            'topcolor' => "#0090d6",
            'data' => array(
              'first' => array(
                      'value' => "恭喜您，获得一次抽奖的机会！",
                      'color' => "#0090d6",
                    ),
              'keyword1' => array(
                      'value' => $orderId,
                      'color' => "#ff0000",
                    ),
              'keyword2' => array(
                      'value' => $userName,
                      'color' => "#ff0000",
                    ),
              'remark' => array(
                      'value' => $remark,
                      'color' => "#0090d6",
                    ),
              )
          );

        $accessToken = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
        $responseData = $this->post($url, json_encode($data));
    }

    // 发送微信积分变更通知
    public function sendInterMsg()
    {
        $openid = $_GET['openid'];
        $time = date("Y-M-D H:i:s");
        $data = M("user")->where(array('openid'=>$openid))->find();
        $name = $data['name'];
        $integral = $date['integral'];
        $touser = $openid;
        $remark = "谢谢惠顾，祝您使用愉快！";
        $url = "";
        // 封装测试数据
        $data=array(
            'touser' => $touser,
            'template_id' => "",
            'url' => $url,
            'topcolor' => "#0090d6",
            'data' => array(
              'first' => array(
                      'value' => "积分奖励到账，请查收！",
                      'color' => "#0090d6",
                    ),
              'keyword1' => array(
                      'value' => $name,
                      'color' => "#ff0000",
                    ),
              'keyword2' => array(
                      'value' => $time,
                      'color' => "#ff0000",
                    ),
              'keyword3' => array(
                      'value' => "体验预定积分奖励",
                      'color' => "#ff0000",
                    ),
              'keyword4' => array(
                      'value' => "100",
                      'color' => "#ff0000",
                    ),
              'keyword5' => array(
                      'value' => "点击查看详情",
                      'color' => "#ff0000",
                    ),
              'remark' => array(
                      'value' => $remark,
                      'color' => "#0090d6",
                    ),
              )
          );

        $accessToken = $this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
        $responseData = $this->post($url, json_encode($data));
        var_dump($responseData);
    }

    // 群发微信通知
    public function forSendMsg()
    {
        $user = $_POST['user'];
        $content = $_POST['content'];
        $openids = M("user")->select();
        foreach ($openids as $key => $value) {
            $openid = $value['openid'];
            // $openid = "oPaYhuJLcto6pexFtoncAUXuyi_g";
            $touser = $openid;
            $remark = "点击查看详情";
            $url = $_POST['url'].$openid;
            // 封装测试数据
            $data=array(
              'touser' => $touser,
              'template_id' => "",
              'url' => $url,
              'topcolor' => "#0090d6",
              'data' => array(
                'first' => array(
                        'value' => "新功能上线通知",
                        'color' => "#0090d6",
                      ),
                'keyword1' => array(
                        'value' => $user,
                        'color' => "#ff0000",
                      ),
                'keyword2' => array(
                        'value' => $content,
                        'color' => "#ff0000",
                      ),
                'remark' => array(
                        'value' => $remark,
                        'color' => "#0090d6",
                      ),
                )
            );
            $accessToken = $this->getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
            $responseData = $this->post($url, json_encode($data));
        }
        $this->success("发送成功！");
    }

    // 打印新订单
    public function printOrder($orderId)
    {
    $array = M("order")->where(array('orderId'=>$orderId, 'payStatus'=>'1'))->find();
        if (is_array($array)) {
            if ($array['userName']) 
            {
                $message.="联系人：";
                $message.=$array['userName'];
                $message.="\n";
            }

            if ($array['userPhone'])
            {
                $message.="联系电话：";
                $message.=$array['userPhone'];
                $message.="\n";
            }

            if ($array['Address'])
            {
                $message.="地址：";
                $message.=$array['Address'];
                $message.="\n";
            } 

            $message.="下单时间：";
            $message.=date('Y-m-d H:i:s', $array['orderTime']);
            $message.="\n";

            if (isset($array['selectTime']) && $array['selectTime']) 
            {
                $message.="配送时间：";
                $message.=$array['selectTime'];
                $message.="\n";
            }

            if ($array['distributionStyle'] == "送货上门") 
            {
                $message .="送货上门：减20积分";
                $message.="\n";
            }

            if ($array['payStatus']) 
            {
                $message .= "订单状态：已付款";
                $message.="\n";
            } else {
                $message .= "订单状态：未付款";
                $message.="\n";
            }

            if (isset($array['remark']) && $array['remark']) 
            {
                $message.="备注：";
                $message.=$array['remark'];
                $message.="\n";
            } 

            $message .= "订单编号：".$array['orderId'];
            $message.="\n" ; 
            $message.="................................";
            $message.="\n" ;  

            // 购物车中商品信息
            $goodInfo = json_decode($array['cartInfo']);

            $orderFlag = strstr($orderId,"Juice");  
            if($orderFlag != ""){//是饮品订单
                for($i = 1; $i < count($goodInfo); $i++){
                      $goodId = $goodInfo[$i]->goodId;
                      // 获取商品名称
                      $good = M("JuiceGood")->where(array('goodId'=>$goodId))->find();        
                      $goodNum = $goodInfo[$i]->goodNum;
                      $message.=$i;
                      $message.=").";
                      $message.=$good['name'];
                      $message.="\t\t";
                      $message.="数量：";
                      $message.=$goodNum;
                      $message.="\n";
                }
            }else{
                for($i = 1; $i < count($goodInfo); $i++){
                    $goodId = $goodInfo[$i]->goodId;
                    // 获取商品名称
                    $good = M("reserve")->where(array('goodId'=>$goodId))->find();       
                    $goodNum = $goodInfo[$i]->goodNum;
                    $message.=$i;
                    $message.=").";
                    $message.=$good['name'];
                    $message.="\t\t";
                    $message.="数量：";
                    $message.=$goodNum;
                    $message.="\n";
                }
            }

          // for($i = 1; $i < count($goodInfo); $i++){
          //   $goodId = $goodInfo[$i]->goodId;
          //   // 获取商品名称
          //   $good = M("JuiceGood")->where(array('goodId'=>$goodId))->find();
          //   if(!$good){
          //     $good = M("reserve")->where(array('goodId'=>$goodId))->find();
          //   }        
          //   $goodNum = $goodInfo[$i]->goodNum;
          //   $message.=$i;
          //   $message.=").";
          //   $message.=$good['name'];
          //   $message.="\t\t";
          //   $message.="数量：";
          //   $message.=$goodNum;
          //   $message.="\n";
          // }

            $message.="................................"   ;
            $message.="\n" ;  

            $message.="^B2总数：";
            $message.=$array['goodNum'];
            $message.="\n";
            $message.="^B2总价：";
            $message.=$array['totalPrice'];
            $message.="元";
            $message.="\n";
            $this->printInit($message);
        }
    // $this->printInit($message);
    }

    public function printInit($content = ''){
        $DEVICE_NO = "";
        $UYIN_SERVER = "printer.showutech.com";

        $print_total = 1;
        $url = ""; //二维码地址
        $shop = "燕之居";

        $qrlength=chr(strlen($url));
        $qrcode ="\n";
        $qrcode.="^Q";
        $qrcode.=$qrlength;
        $qrcode.=$url;

        $message_com ="\n";
        $message_com.="^B2";
        $name_length=strlen($shop);
        for( $i = 0 ; $i < ((8-$name_length/3)) ; $i++ )
          $message_com.=" ";
        $message_com.=$shop;

        $message = "^N".$print_total."\n".$qrcode."\n".$message_com."\n".$content;
        $result = $this->sendPrintOrder($DEVICE_NO, 1, $message,$UYIN_SERVER);
    }
   
    public function sendPrintOrder($device_no, $order_id, $msg, $UYIN_SERVER) {
        $url = "http://$UYIN_SERVER/api/1/service/add_order/$device_no/$order_id/";
        $data = array('data' => $msg);

        $options = array(
          'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
          ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        // var_dump($result);
        // return $result;
    } 

    // 微信模板消息进入管理订单状态
    public function orderAdmin()
    {
        $totalPrice = 0;
        $selectedGoodNumber = 0;
        // 商品信息封装
        $order = M("order")->where(array('orderId'=>$_GET['orderId']))->find();
        $cartInfo = json_decode($order['cartInfo']);

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


  // 订单开始制作
  public function orderStart()
  {
    $order = M("order")->where(array('orderId'=>$_GET['orderId']))->find();
    $order['sendStatus'] = "正在制作";
    $result = M("order")->save($order);
    if($result){
      $this->success("更新成功···", U("App/Weixin/orderAdmin", array('orderId'=>$_GET['orderId'])), 1);
    }
  }

   // 订单开始制作
  public function orderFinish()
  {
    $order = M("order")->where(array('orderId'=>$_GET['orderId']))->find();
    $order['sendStatus'] = "已完成";
    $result = M("order")->save($order);
    if($result){
      // 给用户发送制作完成通知
      $this->sendOrderFinish($_GET['orderId']);
      $this->success("更新成功···", U("App/Weixin/orderAdmin", array('orderId'=>$_GET['orderId'])), 1);
    }
  }

  // 发送制作完成通知
  public function sendOrderFinish($orderId)
  {
    $data = M("order")->where(array('orderId'=>$orderId))->find();
    $touser = $data['openid'];
    $remark = "爱上燕之居，更多惊喜等着您！";
    $url = "";
    // 封装测试数据
    $time = date("Y-m-d H:i:s");
    $data=array(
        'touser' => $touser,
        'template_id' => "",
        'url' => $url,
        'topcolor' => "#0090d6",
        'data' => array(
          'first' => array(
                  'value' => "您的订单已完成，请速来领取！",
                  'color' => "#0090d6",
                ),
          'keyword1' => array(
                  'value' => $orderId,
                  'color' => "#ff0000",
                ),
          'keyword2' => array(
                  'value' => $time,
                  'color' => "#ff0000",
                ),
          'remark' => array(
                  'value' => $remark,
                  'color' => "#0090d6",
                ),
          )
      );

    $accessToken = $this->getAccessToken();
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
    $responseData = $this->post($url, json_encode($data));
  }

    // 新订单的时候微信通知并打印小票
    public function newOrder($orderId)
    {
        // 根据orderId获取其他信息
        $data = M("order")->where(array('orderId'=>$orderId))->find();
        // 取单人信息封装
        $userInfo = $data['userName'].",".$data['userPhone'];
        // 配送地址
        if($data['distributionStyle'] == "送货上门"){
          $address = $data['Address'];
        }else{
          $address = "到店自取";
        }
        // 订单信息
        $orderInfo = "预定时间：".$data['selectTime'];
        // 备注信息
        $remark = "点击查看订单信息并处理点单！";

        //处理订单状态的URL
        $url = "";

        // 查询工作人员接受通知
        $touser = M("templateuser")->where(array('userFlag'=>1))->select();
        $con = count($touser);
        for($i = 0; $i < $con; $i++){
          // 封装测试数据
          $data=array(
              'touser' => $touser[$i]['openid'],
              'template_id' => "",
              'url' => $url,
              'topcolor' => "#0090d6",
              'data' => array(
                'first' => array(
                        'value' => "您有新订单需要处理！",
                        'color' => "#0090d6",
                      ),
                'keyword1' => array(
                        'value' => $orderId,
                        'color' => "#ff0000",
                      ),
                'keyword2' => array(
                        'value' => $userInfo,
                        'color' => "#ff0000",
                      ),
                'keyword3' => array(
                        'value' => $address,
                        'color' => "#ff0000",
                      ),
                'keyword4' => array(
                        'value' => $orderInfo,
                        'color' => "#ff0000",
                      ),
                'remark' => array(
                        'value' => $remark,
                        'color' => "#0090d6",
                      ),
                )
            );

          $accessToken = $this->getAccessToken();
          $url2 = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
          $responseData = $this->post($url2, json_encode($data));
          var_dump($responseData);
        }

        // 查询配送工作人员接受通知
        $data = M("order")->where(array('orderId'=>$orderId))->find();
        if($data['distributionStyle'] == "送货上门"){
            $touser = M("templateuser")->where(array('userFlag'=>2))->select();
            $con = count($touser);
            // 配送订单通知
            for($i = 0; $i < $con; $i++){
              // 封装测试数据
              $data=array(
                  'touser' => $touser[$i]['openid'],
                  'template_id' => "",
                  'url' => $url,
                  'topcolor' => "#0090d6",
                  'data' => array(
                    'first' => array(
                            'value' => "您有新订单需要处理！",
                            'color' => "#0090d6",
                          ),
                    'keyword1' => array(
                            'value' => $orderId,
                            'color' => "#ff0000",
                          ),
                    'keyword2' => array(
                            'value' => $userInfo,
                            'color' => "#ff0000",
                          ),
                    'keyword3' => array(
                            'value' => $address,
                            'color' => "#ff0000",
                          ),
                    'keyword4' => array(
                            'value' => $orderInfo,
                            'color' => "#ff0000",
                          ),
                    'remark' => array(
                            'value' => $remark,
                            'color' => "#0090d6",
                          ),
                    )
                );

              $accessToken = $this->getAccessToken();
              $url2 = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$accessToken;
              $responseData = $this->post($url2, json_encode($data));
              var_dump($responseData);
            }
        }
    }

    // 添加积分
    public function addIntegral($orderId, $openid)
    {
        // 订单信息查询
        $order = M("order")->where(array('orderId'=>$orderId))->find();
        $integral['openid'] = $openid;
        $integral['integral'] = (int)$order['totalPrice'];
        $integral['integral'] = "+".$integral['integral'];
        $integral['remark'] = $orderId;
        $result = M("integral")->add($integral);
        // 用户积分更改
        if($result){
            // 用户信息查询
            $user = M("user")->where(array('openid'=>$openid))->find();
            $user['integral'] += (int)$order['totalPrice'];
            M("user")->save($user);
        }

        // 如果积分兑换配送
        if($order['distributionStyle'] == "送货上门"){
            $integral['openid'] = $openid;
            $integral['integral'] = "-20";
            $integral['remark'] = "配送".$orderId;
            $result = M("integral")->add($integral);

            if($result){
                // 用户信息查询
                $user = M("user")->where(array('openid'=>$openid))->find();
                $user['integral'] -= 20;
                M("user")->save($user);
            }
        } 
    }
 	
    //获取 accessToken
    public function getAccessToken()
    {
        $data = json_decode(file_get_contents("./Public/access_token.json"));
        // 超时重新获取access
        if ($data->expire_time < time()) {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->secret;
            $res = json_decode(file_get_contents($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $fp = fopen("./Public/access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $access_token = $data->access_token;
        }

        // 检查是否有效，否则重新获取access
        $checkUrl = "https://api.weixin.qq.com/cgi-bin/getcallbackip?access_token=".$access_token;
        $result = json_decode(file_get_contents($checkUrl));
        if($result->errcode == "40001"){
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->secret;
            $res = json_decode(file_get_contents($url));
            $access_token = $res->access_token;
            if ($access_token) {
                $data->expire_time = time() + 7000;
                $data->access_token = $access_token;
                $fp = fopen("./Public/access_token.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        }
        return $access_token;
    }

    //file_get_content发送post请求，数据格式json   
 	public function post($url, $data){
        // 封装数据
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/json; encoding=utf-8',
                'content' => $data
            )
        );
        // 发送请求
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;
	}
 }