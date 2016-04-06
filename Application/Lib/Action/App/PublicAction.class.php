<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 10:49:47
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 公用函数
 | 
 */

 class PublicAction extends Action 
 {
      // 二维码图片
      public function index($data){
            Vendor('phpqrcode.phpqrcode');
            $errorCorrectionLevel = 3;//容错级别 
            $matrixPointSize = 5;//生成图片大小 
            //生成二维码图片 
            //echo $_SERVER['REQUEST_URI'];
            $object = new \QRcode();
            $path = "./Public/QRcode/";
            $filename = $path.$data.".png";
            $object->png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);   
      }

      // 短信验证码
      public function smsbao($uid, $code) {
            // 将code存入数据库
            $user['phone'] = $uid;
            $dbcode = M ("Code")->where($user)->find();
            if($dbcode) {
                  $dbcode['code'] = $code;
                  $data = M ("Code")->save($dbcode);
                  if(! $data) {
                        $this->error("网络故障，请重试！", U("App/User/register"));
                  }
            }else {
                  $data['phone'] = $uid;
                  $data['code'] = $code;
                  $result = M ("Code")->add($data);
                  if(!$result) {
                        $this->error("网络故障，请重试！", U("App/User/register"));
                  }
            }

            $statusStr = array(
            "0" => "短信发送成功",
            "-1" => "参数不全",
            "-2" => "服务器空间不支持,请确认支持curl或者fsocket，联系您的空间商解决或者更换空间！",
            "30" => "密码错误",
            "40" => "账号不存在",
            "41" => "余额不足",
            "42" => "帐户已过期",
            "43" => "IP地址限制",
            "50" => "内容含有敏感词"
            );    
            $smsapi = "http://www.smsbao.com/"; //短信网关
            $user = ""; //短信平台帐号
            $pass = md5(""); //短信平台密码
            $content="验证码".$code.",有效时间3分钟。";//要发送的短信内容
            $phone = $uid;
            $sendurl = $smsapi."sms?u=".$user."&p=".$pass."&m=".$phone."&c=".urlencode($content);
            $result =file_get_contents($sendurl) ;
            
      }
 }
            