<?php

namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;

class User extends Model{

    use SoftDelete;
	protected $pk = 'id';
	protected $table = 'user';
	protected $autoWriteTimestamp = true;
	protected $createTime = 'create_time';
	protected $updateTime = 'update_time';
	protected $deleteTime = 'delete_time';

	protected function getRoleAttr($value){
		$role = ['1'=>'超级管理员','0'=>'管理员'];
		return $role[$value];
	}

	// protected function getStatusAttr($value){
	// 	$status = ['1'=>'已启用','0'=>'已停用'];
	// 	return $status[$value];
	// }
}