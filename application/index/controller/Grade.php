<?php

namespace app\index\controller;

use app\index\model\Grade as GradeModel;
use think\Request;


class Grade extends Base{

    //班级列表
	public function gradeList(){
		$gradelists = GradeModel::all();
		foreach($gradelists as $key => $val){
			$gradelists[$key]['teacher'] = isset($val->teacher->name) ? $val->teacher->name : '<span style="color:red">未分配</span>';
		}
		$count = GradeModel::count();
		$this->view->assign('count',$count);
		$this->view->assign('gradelists',$gradelists);
		return $this->view->fetch();
	}

	//修改状态
	public function status(Request $request){
		$data = $request->post();
		$res = GradeModel::update($data);
		if($res){
			return ['code'=>1];
		}
	}

	//编辑
	public function gradeUpdate(Request $request){
		$id = $request->param('id');
		$grade = GradeModel::find($id);
		$grade->teacher = $grade->teacher->name;
		$this->view->assign('grade',$grade);
		return $this->view->fetch();
	}

	//编辑逻辑
	public function gradeUpdateDo(Request $request){
		$data = $request->post();
		dump($data);
	}
}