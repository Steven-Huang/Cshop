<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-04-06 08:55:14
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 微信关键词回复配置
 | 
 */

//定义token
define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest();
$wechatObj->responseMsg(); //回复关键词消息
// $wechatObj->valid(); //验证服务器


class wechatCallbackapiTest
{
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

    /**
     * 根据关键词回复消息
     * @return [type] [description]
     */
    public function responseMsg()
    {
		//获取关键词报文
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

		if (!empty($postStr)) {
          	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $fromUsername = $postObj->FromUserName;
            $toUsername = $postObj->ToUserName;
            $keyword = trim($postObj->Content);
            if(!$keyword){
                $keyword = trim($postObj->EventKey);
            }
            // error_log("关键词是：".$keyword."\n", 3, './keyword.log');//文件记录关键词
            $time = time();
            $textTpl = "<xml>
						<ToUserName><![CDATA[%s]]></ToUserName>
						<FromUserName><![CDATA[%s]]></FromUserName>
						<CreateTime>%s</CreateTime>
						<MsgType><![CDATA[%s]]></MsgType>
						<Content><![CDATA[%s]]></Content>
						<FuncFlag>0</FuncFlag>
						</xml>";  

             // 关键词回复                      
			if($keyword=="你好") { //文字回复
          		$msgType = "text";
                $contentStr = "欢迎关注！";
            	$resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
            	echo $resultStr;
            }else if ($keyword== "测试") { //图文消息回复
                $Title = "图文消息测试";
                $Description = "图文消息测试，点击查看详情！";
                $PicUrl = "http://565tech.com/data/upload/201511/f_7325e400e7d1ded70e95e556321f51d0.png";
                //跳转地址
                $Url = "http://565tech.com&openid=".$fromUsername;
                $this->msg_new($fromUsername, $toUsername, $Title, $Description, $PicUrl, $Url);
                exit;
            }else{ //其它关键词
                $Title = "图文消息测试";
                $Description = "图文消息测试，点击查看详情！";
                $PicUrl = "http://565tech.com/data/upload/201511/f_7325e400e7d1ded70e95e556321f51d0.png";
                //跳转地址
                $Url = "http://565tech.com&openid=".$fromUsername;
                $this->msg_new($fromUsername, $toUsername, $Title, $Description, $PicUrl, $Url);
                exit;
            }
        }else { //获取报文错误
        	echo "Error";
        	exit;
        }
    }

    /**
    * 文本消息回复
    * @param  string $fromUsername 发送openid
    * @param  string $toUsername   接收方微信号
    * @param  string $contentStr   文本内容
    * @return NULL               
    */
    public function msg_text($fromUsername, $toUsername, $contentStr){
        $textTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[text]]></MsgType>
        <Content><![CDATA[%s]]></Content>
        <FuncFlag>0</FuncFlag>
        </xml>";
        $time = time();
        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $contentStr);
        echo $resultStr;            
        exit;
    }

    /**
    * 图文消息发送
    * @param  string $fromUsername 发送 openid
    * @param  string $toUsername   接收微信号
    * @param  string $Title        标题
    * @param  string $Description  描述
    * @param  string $PicUrl       图片 URL
    * @param  string $Url          链接地址
    * @return NULL               
    */
    public function msg_new($fromUsername, $toUsername, $Title, $Description, $PicUrl, $Url){
        $newsTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <ArticleCount>1</ArticleCount>
        <Articles>
        <item>
        <Title><![CDATA[%s]]></Title> 
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>
        </Articles>
        </xml>";
        $time = time();
        $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $Title, $Description, $PicUrl, $Url);
        echo $resultStr;            
        exit;
    }

    /**
    * 多条图文消息发送
    * @param  string $fromUsername 发送 openid
    * @param  string $toUsername   接收微信号
    * @param  string $Title        标题
    * @param  string $Description  描述
    * @param  string $PicUrl       图片 URL
    * @param  string $Url          链接地址
    * @return NULL               
    */
    public function msg_news($fromUsername, $toUsername, $Title, $Description, $PicUrl, $Url, $Title2, $Description2, $PicUrl2, $Url2){
        $newsTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[news]]></MsgType>
        <ArticleCount>2</ArticleCount>
        <Articles>
        <item>
        <Title><![CDATA[%s]]></Title> 
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>
        <item>
        <Title><![CDATA[%s]]></Title> 
        <Description><![CDATA[%s]]></Description>
        <PicUrl><![CDATA[%s]]></PicUrl>
        <Url><![CDATA[%s]]></Url>
        </item>
        </Articles>
        </xml>";
        $time = time();
        $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $Title, $Description, $PicUrl, $Url, $Title2, $Description2, $PicUrl2, $Url2);
        echo $resultStr;            
        exit;
    }

}
?>
