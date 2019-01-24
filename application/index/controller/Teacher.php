<?php

namespace app\index\controller;

use app\index\model\Teacher as TeacherModel;
use app\index\model\Grade as GradeModel;
use think\Request;

class Teacher extends Base{

    //教师列表
	public function index(){
		$count = TeacherModel::count();
		$this->view->assign('count',$count);
		$teachers = TeacherModel::all();
		foreach($teachers as $key => $val){
			$teachers[$key]['grade'] = isset($val->grade->name) ? $val->grade->name : '<span style="color:red">未分配</span>';
		}
		$this->view->assign('teachers',$teachers);
		return $this->view->fetch();
	}

	//修改状态
	public function status(Request $request){
		$data = $request->post();
		$res  = TeacherModel::update($data);
		if($res){
			return ['code'=>1,'状态修改成功'];
		} 
	}

	//编辑
	public function update(Request $request){
		//班级列表
		$grades = GradeModel::all();
		$this->view->assign('grades',$grades);
		$id = $request->param('id');
		$teacher = TeacherModel::find($id);
		$this->view->assign('teacher',$teacher);
		return $this->view->fetch();
	}

	//编辑逻辑
	public function updateDo(Request $request){
		$data = $request->post();
		$res  = TeacherModel::update($data);
		if($res){
			return ['code'=>1,'msg'=>'修改成功'];
		}else{
			return ['code'=>0,'msg'=>'修改失败'];
		}
	}

	//添加
	public function add(){
		//班级列表
		$grades = GradeModel::all();
		$this->view->assign('grades',$grades);
		return $this->view->fetch();
	}

	//添加逻辑
	public function addDo(Request $request){
		$data = $request->post();
		$rule = [
			'name'  => 'require|length:3,16',
			'degree'=> 'require',
			'school'=> 'require',
			'mobile'=> 'require',
			'status'=> 'require',
			'grade_id'=>'require'
		];
		$resRule = $this->validate($data,$rule);

		if($resRule !== true){
			return ['code'=>0,'msg'=>$resRule];
		}

		$res = TeacherModel::create($data);
		if($res){
			return ['code'=>1,'msg'=>'添加成功'];
		}
	}

	//删除
	public function del(Request $request){
		$id = $request->post('id');
		$teacher = TeacherModel::find($id);
		$teacher->is_delete = 1;
		$teacher->save();
		$res = TeacherModel::destroy($id);
		if($res){
			return ['code'=>1];
		}
	}

	//批量恢复
	public function reStart(){
		$teachers = TeacherModel::onlyTrashed()->select();
		foreach($teachers as $key => $val){
			$val->is_delete = 0;
			$val->delete_time = NULL;
			$val->save();
		}
	}
}