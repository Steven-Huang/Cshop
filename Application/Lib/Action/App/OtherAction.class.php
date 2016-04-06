<?php
/*
 | --------------------------------------------------------------------------
 | Author: Fusky  |  E-Mail: choggle2011@gmail.com  |  2016-03-28 21:39:50
 | --------------------------------------------------------------------------
 | Copyright (c) 20014-2016 http://iperson.cn   All rights reserved.
 | --------------------------------------------------------------------------
 | 
 | 积分产品展示
 | 
 */

class OtherAction extends Action {	

	public function index()
	{
		$goods = M("other")->where(array('showFlag'=>1))->select();	
		$this->assign("goods", $goods);
		$this->display();
	}

	public function admin()
	{
		$this->display();
	}

	public function addGood()
	{
		// 封面图片处理
		if ($_FILES['img']['name'] !== '') {
			$img = $this->upload ();
			$picurl = "./Public/Uploads/".$img[0][savename];
			if($picurl){
				$good['imgUrl'] = $picurl;
			}
		}
		var_dump($good);
		var_dump($_POST);
	}

	public function upload() {
        import ( 'ORG.Net.UploadFile' );
        $upload = new UploadFile (); // 实例化上传类
        $upload->maxSize = 3145728; // 设置附件上传大小
        $upload->allowExts = array (
                'jpg',
                'gif',
                'png',
                'jpeg' 
        ); // 设置附件上传类型
        $upload->savePath = './Public/Uploads/'; // 设置附件上传目录
        if (! $upload->upload ()) { // 上传错误提示错误信息
            $this->error ( $upload->getErrorMsg () );
        } else { // 上传成功 获取上传文件信息
            $info = $upload->getUploadFileInfo ();
        }
        
        return $info;
    }

}
?>