<?php

namespace app\index\controller;

use think\Controller;

use app\index\model\Teacher;

use app\index\model\Grade;

use app\index\model\Student;

class Test extends Controller{

	public function index(){
		return $this->view->fetch('public/base');
	}

	public function guanlian(){
		$teachers = Teacher::all();
		return $teachers[0]->grade->name;
	}

	public function test(){
		$grade = Grade::find(1);
		$students = $grade->students;
		foreach($students as $key => $val){
			dump($val['name']);
		}
	}
}