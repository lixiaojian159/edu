<?php

namespace app\index\controller;

use app\index\model\Student as StudentModel;
use app\index\model\Grade as GradeModel;

use think\Request;

class Student extends Base{

    //学生列表
	public function index(){
		$count = StudentModel::count();
		$this->view->assign('count',$count);
		$students = StudentModel::paginate(2);
		foreach($students as $key => $val){
			$students[$key]->grade = isset($val->grade->name) ? $val->grade->name : '<span style="color:red">未分配</span>';
		}
		$this->view->assign('students',$students);
		return $this->view->fetch();
	}

	//状态
	public function status(Request $request){
		$data = $request->post();
		$res  = StudentModel::update($data);
		if($res){
			return ['code'=>1,'msg'=>'修改状态成功'];
		}else{
			return ['code'=>0,'mag'=>'修改状态失败'];
		}
	}

	//编辑
	public function update(Request $request){
		$id = $request->param('id');
		$student = StudentModel::find($id);
		$this->view->assign('student',$student);
		$grades = GradeModel::all();
		$this->view->assign('grades',$grades);
		return $this->view->fetch();
	}

	//编辑逻辑
	public function updateDo(Request $request){
		$data = $request->post();
		$res  = StudentModel::update($data);
		if($res){
			return ['code'=>1,'msg'=>'学生信息修改成功'];
		}else{
			return ['code'=>0,'msg'=>'学生信息修改失败'];
		}
	}

	//添加
	public function add(){
		$grades = GradeModel::all();
		$this->view->assign('grades',$grades);
		return $this->view->fetch();
	}

	//添加逻辑
	public function addDo(Request $request){
		$data = $request->post();
		$res  = StudentModel::create($data);
		if($res){
			return ['code'=>1,'msg'=>'学生信息添加成功'];
		} else{
			return ['code'=>0,'msg'=>'学生信息添加失败'];
		}
	}

	//软删除
	public function del(Request $request){
		$id  = $request->param('id');
		$student = StudentModel::find($id);
		$student->is_delete = 1;
		$student->save();
		$res = StudentModel::destroy($id);
		if($res){
			return ['code'=>1];
		} 
	}

	//批量学生恢复
	public function reStart(){
		$students = StudentModel::onlyTrashed()->select();
		foreach($students as $key => $val){
			$val->is_delete = 0;
			$val->delete_time = NULL;
			$val->save();
		}
	}

}