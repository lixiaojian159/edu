<?php

namespace app\index\controller;

use think\Controller;

use app\index\model\Teacher;

class Test extends Controller{

	public function index(){
		return $this->view->fetch('public/base');
	}

	public function guanlian(){
		$teachers = Teacher::all();
		return $teachers[0]->grade->name;
	}
}