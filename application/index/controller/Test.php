<?php

namespace app\index\controller;

use think\Controller;

class Test extends Controller{

	public function index(){
		return $this->view->fetch('public/base');
	}
}