<?php

namespace app\index\controller;

use app\index\controller\Base;
use app\index\model\User;
use think\Session;
use think\Request;

class Admin extends Base{

    //管理员列表
	public function adminList(){
		$this->view->assign('title','管理员管理');
		$this->view->assign('keywords','教学管理系统,管理员管理');
		$this->view->assign('descs','教学管理系统---管理员管理');
		//总条数
		$count = User::count();
		$this->view->assign('count',$count);
		$userLocal = Session::get('user_info');
		if($userLocal['name'] == 'admin'){
			$userLists = User::all();
		}else{
			$userLists = User::all(['name'=>$userLocal['name']]);
		}
		$this->view->assign('userLists',$userLists);
		return $this->view->fetch();
	}

	//状态修改
	public function status(Request $request){
		$id = $request->post('id');
		$status = $request->post('status');
		$res = User::where('id',$id)->update(['status'=>$status]);
		if($res){
			return ['code'=>1];
		}
	}

	//删除
	public function del(Request $request){
		//检测是否是admin账号,否则无删除权限
		$this->isAdminAble();
		$id  = $request->post('id');
		$userDel = User::find($id);
		if($userDel['name'] == 'admin'){
			return ['code'=>0,'msg'=>'admin超级管理员不能被删除'];
		}
		$userDel->is_delete = 1;
		$userDel->save();
		$res = User::destroy($id);
		if($res){
			return ['code'=>1];
		} 
	}

	//编辑
	public function update(Request $request){
		$id = $request->param('id');
		$user = User::find($id);
		$this->view->assign('user',$user);
		return $this->view->fetch();
	}

	//编辑逻辑
	public function updateDo(Request $request){
		$data = $request->post();
		if($data['password'] != $data['password2']){
			return ['code'=>0,'msg'=>'两次密码不一致'];
		}
		unset($data['password2']);
		$data['password'] =md5($data['password']);
		$res = User::update($data);
		if($res){
			return ['code'=>1];
		}
	}

	//添加
	public function adminAdd(){
		return $this->view->fetch();
	}

	//添加逻辑
	public function addDo(Request $request){
		//接收数据
		$data = $request->post();
		//检测数据
		$rule = [
			'name'  => 'require|max:10|min:4|unique:user',
			'email' => 'require|unique:user',
			'password' => 'require|max:20|min:5|confirm',
			'status' => 'require',
			'role' => 'require'
		];
		$resRule = $this->validate($data,$rule);
		if($resRule !== true){
			return ['code'=>0,'msg'=>$resRule];
		}

        unset($data['password_confirm']);
        $data['password'] = md5($data['password']);
		$res  = User::create($data);
		if($res){
			return ['code'=>1,'msg'=>'添加成功'];
		}else{
			return ['code'=>0,'msg'=>'添加失败'];
		}
	}

	//检测用户名是否重复
	public function checkName(Request $request){
		$name = $request->post('name');
		$res  = User::get(['name'=>$name]);
		if($res){
			return ['code'=>0,'msg'=>'用户名已存在'];
		}else{
			return ['code'=>1,'msg'=>'用户名可以使用'];
		}
	}

	//检测用户邮箱是否重复
	public function checkEmail(Request $request){
		$email = $request->post('email');
		$res   = User::get(['email'=>$email]);
		if($res){
			return ['code'=>0,'msg'=>'邮箱已存在'];
		}else{
			return ['code'=>1,'msg'=>'邮箱可以使用'];
		}
	}

	//批量恢复
	public function ReStart(){
		$users = User::onlyTrashed()->select();
		$data = [];
		foreach($users as $key => $val){
			$val->delete_time = null;
			$val->is_delete   = 0;
			$res = $val->save();
			$data[$key] = $res;
		}
		dump($data);
	}
}