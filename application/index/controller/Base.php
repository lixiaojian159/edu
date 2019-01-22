<?php

namespace app\index\controller;

use think\Controller;
use think\Session;

class Base extends Controller{

	protected function _initialize()
    {
    	$this->isLogin();
    }

    //检测用户是否已经登陆(其实就是检测是否存在session user_id user_name)
    public function isLogin(){
    	if(!Session::has('user_id') || !Session::has('user_name')){
    		$this->redirect('User/login');
    	}
    }

    //判断只有admin超级管理员的权限
    public function isAdminAble(){
        $name = Session::get('user_name');
        if($name != 'admin'){
            return ['code' => 0,'msg'=>'您无删除权限'];
        }
    }
}