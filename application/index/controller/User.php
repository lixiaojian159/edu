<?php

namespace app\index\controller;

use think\Controller;

class User extends Controller{

	public function login(){
		return $this->view->fetch();
	}
}