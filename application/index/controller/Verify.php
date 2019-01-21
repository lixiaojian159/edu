<?php

namespace app\index\controller;

use think\captcha\Captcha;

class Verify{

    //生成验证码
	public function makeVerify(){
		$captcha = new Captcha();
		$captcha->useNoise = false;
		$captcha->useCurve = false;
		$captcha->length   = 4;
        return $captcha->entry();
	}

	//校验验证码
	function check_verify($code, $id = ''){
		$captcha = new Captcha();
		return $captcha->check($code, $id);
	}
}