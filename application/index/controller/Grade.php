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
		$grade->teacher = isset($grade->teacher->name) ? $grade->teacher->name : '未分配';
		$this->view->assign('grade',$grade);
		return $this->view->fetch();
	}

	//编辑逻辑
	public function gradeUpdateDo(Request $request){
		$data = $request->post();
		$res  = GradeModel::update($data);
		if($res){
			return ['code'=>1,'msg'=>'修改成功'];
		}
	}

	//添加
	public function gradeAdd(){
		return $this->view->fetch();
	}

	//添加逻辑
	public function gradeAddDo(Request $request){
		//接收数据
		$data = $request->post();
		//检验数据
		$rule = [
			'name'   => 'require|length:4,16',
			'length' => 'require',
			'price'  => 'require',
			'status'  => 'require'
		];

		$resRule = $this->validate($data,$rule);

		if($resRule !== true){
			return ['code'=>0,'msg'=>$resRule];
		}

		$res = GradeModel::create($data);
		if($res){
			return ['code'=>1,'msg'=>'添加成功'];
		}
	}

	//软删除
	public function gradeDel(Request $request){
		$id  = $request->post('id');
		GradeModel::where('id',$id)->update(['is_delete'=>1]);
		$res = GradeModel::destroy($id);
		if($res){
			return ['code'=>1,'msg'=>'删除成功'];
		} 
	}

	//批量恢复删除
	public function gradeRestart(){
		$users = GradeModel::onlyTrashed()->select();
		foreach($users as $key => $val){
			$val->is_delete = 0;
			$val->delete_time = NULL;
			$val->save();
		}
	}
}