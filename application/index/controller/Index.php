<?php
namespace app\index\controller;

use think\Controller;

class Index extends Base
{
    public function index()
    {
    	$this->view->assign('title','教学管理系统');
    	$this->view->assign('keywords','教学后台首页');
    	$this->view->assign('descs','教育管理系统---后台首页');
        return $this->view->fetch();
    }
}
