<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-03-02 20:53:35
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | JifenAction. 积分兑换中心。
 | 
 */

class JifenAction extends WeixinAction {

    /**
    * 展示积分中心
    * @return [type] [description]
    */
    public function index()
    {
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $goods = M("jifengoods")->where(array('flag'=>1))->select();
        $this->assign("goods",$goods);
        $this->display();
    }

    /**
    * 积分订单确认兑换页面
    * @return [type] [description]
    */
    public function order()
    {
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }

        $good = M("jifengoods")->where(array('goodId'=>$_GET['id']))->find();
        $this->assign("good",$good);

        $openid = $_SESSION["user"];
        $user = M("user")->where(array('openid'=>$openid))->find();
        $this->assign('user', $user);
        $this->display();
    }

    /**
    * 处理订单扣除积分
    * @return [type] [description]
    */
    public function doOrder()
    {
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }

        $openid = $_SESSION["user"];
        $user = M("user")->where(array('openid'=>$openid))->find();
        $good = M("jifengoods")->where(array('goodId'=>$_POST['goodId']))->find();

        $data['goodname'] = $good['name'];
        $data['integral'] = $good['price'];
        $data['time'] = time();
        $data['openid'] = $user['openid'];
        $data['phone'] = $user['phone'];
        $data['goodid'] = $good['goodId'];

        $flag = M("jifenorder")->where($data)->find();
        if($flag){
            echo "<h1>兑换成功，请勿重复提交！</h1>";
            exit;
        }

        M("jifenorder")->add($data);
        // 减少积分
        $userJifen['openid'] = $user['openid'];
        $userJifen['integral'] = "-".$good['price'];
        $userJifen['remark'] = "兑换".$good['name'];

        $resultJifen = M("integral")->add($userJifen);
        $user['integral'] = (int)$user['integral'] - (int)$good['price'];
        M("user")->save($user);

        // 发送微信通知
        $this->sendMsg($user['openid'], $userJifen['remark']);

        $this->success( "兑换成功，请等待处理！", U("App/Index/home",array('openid'=>$user['openid'])), 1);
    }

    /**
    * 发送积分订单微信通知
    * @return [type] [description]
    */
    public function sendMsg($openid,$message)
    {
        $time = date("Y-m-d H:i:s");
        $data = M("user")->where(array('openid'=>$openid))->find();
        $integral = "剩余".$data['integral']."分";
        $name = $data['name'];
        $touser = $openid;

        $remark = "谢谢惠顾，祝您使用愉快！";
        $url = "";
        // 封装测试数据
        $data=array(
            'touser' => $touser,
            'template_id' => "O6T1dyTnKl3rdktJb4YLM8WCT0P9Tuieao3BTuxpGtk",
            'url' => $url,
            'topcolor' => "#0090d6",
            'data' => array(
              'first' => array(
                      'value' => "积分兑换成功通知！",
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
                      'value' => $message,
                      'color' => "#ff0000",
                    ),
              'keyword4' => array(
                      'value' => $integral,
                      'color' => "#ff0000",
                    ),
              'keyword5' => array(
                      'value' => "暂无余额",
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
        // var_dump($responseData);
    }

}