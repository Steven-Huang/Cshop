<?php
/**
 * @Version:     1.0
 * @Author:      李小超
 * @DateTime:    2015-08-28 08:25:29
 * @E-Mail:      choggle2011@gmail.com
 */
 class OauthAction extends Action {
 	// 初始化
 	function index() {
		if (! $_SESSION ["user"]) {
			// if ($_GET ["uid"]) {
			// 	// 没有cookie有微信uid，获取用户信息
			// 	$uid = $_GET["uid"];
			// 	$usersresult =  R ( "Api/Api/getuser", array (
			// 		$uid
			// 	) );

			// 	if($usersresult) {
			// 		//获取用户信息成功，保存cookie，并显示首页
			// 		$_SESSION["user"] = $userresult;
			// 		$this->success("登录成功",U("App/Index/index"));
			// 	} else {
			// 		// 获取信息不成功，微信首次访问，绑定账户
			// 		$url =  U ( "App/User/bind" )."&uid=".$uid;
			// 		$this->redirect ( $url );
			// 	}
			// }else {
				// 沒有cookie和微信uid，跳转到登录页面
			$this->redirect ( "App/User/login" );
		}else {
			$this->success("登录成功", U("App/Index/index"));
		}
	}

	// 手机端访问地址，带着手机号码参数
	public function app() {

	}
	
}