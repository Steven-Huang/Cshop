<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-03-02 20:53:35
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | ReadAction. 处理公益书吧。
 | 
 */

class ReadAction extends WeixinAction {	
    public function __construct() {
        $this->appid = "";
        $this->secret = "";
    }
    // 显示进入主页面
    public function index()
    {
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];
        $this->assign('openid', $openid);
        $this->display();
    }

    // 捐助金额
    public function donateShow()
    {
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];
        $this->assign('openid', $openid);
        $this->display();
    }

    public function donateMoney()
    {
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];

        // 存储数据
        $donate['openid'] = $openid;
        $donate['orderId'] = "Donate".time().rand(1000,10000);
        $donate['money'] = $_GET['money']; 
        $result = M("donate")->add($donate);
        // 封装支付数据
        $time = date("Ymdhisa", time());
        $postdata=$this->EBPReq("donate", $donate['orderId'], $time, $_GET['money']*100, "燕之居预定", '1', "公益书吧捐赠", "00", "", "");

        $xml = htmlspecialchars($postdata);
        $this->assign("xml", $xml);
        $this->display();
    }

    // 扫描之后处理书籍信息
    public function findBook()
    {
        $isbn = $_GET['isbn'];
        $url = "https://api.douban.com/v2/book/isbn/:".$isbn;
        $bookData = json_decode(file_get_contents($url));

        // 图书信息获取
        $data['isbn'] = $_GET['isbn'];
        $data['author'] = $bookData->author[0];
        $data['title'] = $bookData->title;
        $data['image'] = $bookData->images->large;
        $data['pages'] = $bookData->pages;
        $data['douban'] = $bookData->alt;
        $data['description'] = $bookData->summary;
        $data['publisher'] = $bookData->publisher;
        $data['author_intro'] = $bookData->author_intro;
        $data['pubdate'] = $bookData->pubdate;
        $data['star'] = $bookData->rating->average;
        // 捐助者信息
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];
        $user = M("user")->where(array('openid'=>$openid))->find();
        $data['openid'] = $user['openid'];
        $data['donate_name'] = $user['name'];
        $data['donate_img'] = $user['headImg'];
        $data['doname_phone'] = $user['phone'];
        $data['time'] = time();
        $data['bookid'] = md5($data['douban']);

        if($data['title']){
            $checkBook = M("book")->where(array('doname_phone'=>$data['doname_phone'], 'douban'=>$data['douban']))->find();
            if($checkBook){
                $this->error("对不起，您重复添加！", U("App/Read/index", array('openid'=>$openid)), 1);
            }else{
                $result = M("book")->add($data);
                if($result){
                      $book['image'] = $data['image'];
                      $book['title'] = $data['title'];
                      $book['author'] = $data['author'];
                      $book['publisher'] = $data['publisher'];
                      $book['pubdate'] = $data['pubdate'];
                      $book['openid'] = $data['openid'];
                      $book['donate_img'] = $data['donate_img'];
                      $book['star'] = (int)$data['star'];
                      $book['bookid'] = $data['bookid'];
                      // 前去确认存放位置
                      $this->success("添加成功，感谢您的捐助！", U("App/Read/bookRegister", array('book'=>$book)), 2);
                }else{
                    $this->error("对不起，添加失败！", U("App/Read/index", array('openid'=>$openid)), 1);
                }
            }
        }else{
            $this->error("对不起，没查到书籍信息！", U("App/Read/index", array('openid'=>$openid)), 1);
        }
    }

    // 还书，和捐书一个逻辑
    // 扫描之后处理书籍信息
    public function findBookReturn()
    {
        $isbn = $_GET['isbn'];
        $url = "https://api.douban.com/v2/book/isbn/:".$isbn;
        $bookData = json_decode(file_get_contents($url));

        // 图书信息获取
        $data['isbn'] = $_GET['isbn'];
        $data['author'] = $bookData->author[0];
        $data['title'] = $bookData->title;
        $data['image'] = $bookData->images->large;
        $data['pages'] = $bookData->pages;
        $data['douban'] = $bookData->alt;
        $data['description'] = $bookData->summary;
        $data['publisher'] = $bookData->publisher;
        $data['author_intro'] = $bookData->author_intro;
        $data['pubdate'] = $bookData->pubdate;
        $data['star'] = $bookData->rating->average;
        // 捐助者信息
        if($_GET['openid']){
          $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];
        $user = M("user")->where(array('openid'=>$openid))->find();
        $data['openid'] = $user['openid'];
        $data['donate_name'] = $user['name'];
        $data['donate_img'] = $user['headImg'];
        $data['doname_phone'] = $user['phone'];
        $data['time'] = time();
        $data['bookid'] = md5($data['douban']);

        if($data['title']){
            $checkBook = M("book")->where(array('doname_phone'=>$data['doname_phone'], 'douban'=>$data['douban']))->find();
            if($checkBook){
                $this->error("书已还，请勿重复操作！", U("App/Read/index", array('openid'=>$openid)), 1);
            }else{
                $result = M("book")->add($data);
                if($result){
                    $book['image'] = $data['image'];
                    $book['title'] = $data['title'];
                    $book['author'] = $data['author'];
                    $book['publisher'] = $data['publisher'];
                    $book['pubdate'] = $data['pubdate'];
                    $book['openid'] = $data['openid'];
                    $book['donate_img'] = $data['donate_img'];
                    $book['star'] = (int)$data['star'];
                    $book['bookid'] = $data['bookid'];
                    // 前去确认存放位置
                    $this->success("还书成功，感谢您！", U("App/Read/bookRegister", array('book'=>$book)), 2);
                }else{
                    $this->error("对不起，还书失败！", U("App/Read/index", array('openid'=>$openid)), 1);
                }
            }
        }else{
            $this->error("对不起，没查到书籍信息！", U("App/Read/index", array('openid'=>$openid)), 1);
        }
    }

    public function bookRegister()
    {
        $book = $_GET['book'];
        $this->assign('book', $book);
        $this->display();
    }

    public function submitPosition()
    {
        $book = M("book")->where(array('bookid'=>$_POST['bookid']))->find();
        $book['position'] = $_POST['position1'].$_POST['position2'];
        $result = M("book")->save($book);
        if($result){
            $this->success("添加成功！", U("App/Read/index", array('openid'=>$result['openid'])), 1);
        }
    }

    // 捐书扫描二维码
	public function scanCode()
	{
        // jsapi 签名信息
	   	$signPackage = $this->getSignPackage();
        $this->assign('signPackage',$signPackage);
        // 用户信息
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];
        $this->assign('openid', $openid);
        $this->display();
	}

    // 借阅扫描二维码
    public function scanCodeRead()
    {
        // jsapi 签名信息
        $signPackage = $this->getSignPackage();
        $this->assign('signPackage',$signPackage);
        // 用户信息
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];
        $this->assign('openid', $openid);
        $this->display();
    }

    // 还书，和捐书一个逻辑
    public function scanCodeReturn()
    {
        // jsapi 签名信息
        $signPackage = $this->getSignPackage();
        $this->assign('signPackage',$signPackage);
        // 用户信息
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];
        $this->assign('openid', $openid);
        $this->display();
    }

    // 扫描登记借阅
    public function findBookRead()
    {
        $isbn = $_GET['isbn'];
        // 捐助者信息
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];
        $user = M("user")->where(array('openid'=>$openid))->find();
        // 借书信息更新
        $book = M("book")->where(array('isbn'=>$_GET['isbn'], 'readingFlag'=>0))->find();
        $book['readingFlag'] = 1;
        $book['readingName'] = $user['name'];
        $book['readingPhone'] = $user['phone'];

        $result = M("book")->save($book);
        if($result){
            $this->success("借阅成功，您可以带走书！", U("App/Read/index", array('openid'=>$openid)), 3);
        }else{
            $this->error("借阅失败，请重试！", U("App/Read/index", array('openid'=>$openid)), 3);
        }
    }

    public function search()
    {
        if($_POST['openid']){
            $_SESSION["user"] = $_POST['openid'];
        }
        $openid = $_SESSION["user"];

        $url = "https://api.douban.com/v2/book/search?q=".$_POST['q'];
        $bookData = json_decode(file_get_contents($url));

        for($i = 0; $i < $bookData->count; $i++){
            $book[$i]['title'] = $bookData->books[$i]->title;
            $book[$i]['image'] = $bookData->books[$i]->image;
            $book[$i]['publisher'] = $bookData->books[$i]->publisher;
            $book[$i]['pubdate'] = $bookData->books[$i]->pubdate;
            $book[$i]['author'] = $bookData->books[$i]->author[0];
            $book[$i]['star'] = (int)$bookData->books[$i]->rating->average;
            $book[$i]['isbn'] = $bookData->books[$i]->isbn13;
            if(!$book[$i]['isbn']){
                $book[$i]['isbn'] = $bookData->books[$i]->isbn10;
            }
        }
        $this->assign('openid', $openid);
        $this->assign('books', $book);
        $this->display();
    }

    public function registerNewBook()
    {
        if($_GET['openid']){
            $_SESSION["user"] = $_GET['openid'];
        }
        $openid = $_SESSION["user"];

        $isbn = $_GET['isbn'];
        $result = M('book')->where(array('isbn'=>$isbn))->find();
        if($result){
            echo "<h1>您想看的书在".$result['position'].",请前往取书并登记！</h1>";
        }else{
            $data['openid'] = $openid;
            $data['isbn'] = $isbn;
            $data['num'] = 1;
            $data['time'] = time();
            $result = M("newbook")->add($data);
            if($result){
                $this->error("暂无此书，已为您登记想看",U("App/Read/index",array('openid'=>$openid)),3);
            }
        }
    }

    // 封装 jsapi 验证数据
    public function getSignPackage() 
    {
        $jsapiTicket = $this->getJsApiTicket();
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $timestamp = time();
        $nonceStr = $this->createNonceStr();
        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);
        $signPackage = array(
          "appId"     => "wx8edd74157b8682ee",
          "nonceStr"  => $nonceStr,
          "timestamp" => $timestamp,
          "url"       => $url,
          "signature" => $signature,
          "rawString" => $string
        );
            return $signPackage; 
    }

    // 创建签名
    private function createNonceStr($length = 16) 
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    // 获取 jsapiTicket
    private function getJsApiTicket() 
    {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode(file_get_contents("./Public/jsapi_ticket.json"));
        if ($data->expire_time < time()) {
            $accessToken = $this->getAccessToken();
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode($this->httpGet($url));
            $ticket = $res->ticket;
            if ($ticket) {
                $data->expire_time = time() + 7000;
                $data->jsapi_ticket = $ticket;
                $fp = fopen("./Public/jsapi_ticket.json", "w");
                fwrite($fp, json_encode($data));
                fclose($fp);
            }
        } else {
            $ticket = $data->jsapi_ticket;
        }
        return $ticket;
    }

    // 封装 get 请求
    private function httpGet($url) 
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
	
}