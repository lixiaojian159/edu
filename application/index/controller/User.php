<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Session;

use app\index\model\User as UserModel;

class User extends Base{

	public function login(){
		return $this->view->fetch();
	}

	//验证用户登录
	public function checkLogin(Request $request){
		//接收数据
		$data = $request->param();
		//校验数据
		$rule = [
			'name'     => 'require|min:4|max:20',
			'password' => 'require|min:5|max:32',
			'verify'   => 'require|length:4'
		];

		$resVerify = $this->validate($data,$rule);
		if($resVerify !== true){
			return ['code' => 0 , 'msg'=>$resVerify];
		}

		//校验验证码
		$verify = new Verify();
		if(!$verify->check_verify($data['verify'])){
			return ['code' => 0 , '验证码错误'];
		}

		//校验用户是否存在
		$user = UserModel::where('name',$data['name'])->find();
		if(!$user){
			return ['code' => 0 , 'msg' => '用户名或者密码错误'];
		}

		if(md5($data['password']) != $user['password']){
			return ['code' => 0 , 'msg' => '用户名或者密码错误'];
		}

		//验证成功,生成session
		Session::set('user_id',$user['id']);
		Session::set('user_name',$user['name']);
		return ['code' => 1 ,'msg' => '登录成功', 'url' => url('index/Index/index')];
	}
}