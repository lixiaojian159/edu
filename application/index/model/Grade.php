<?php

namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;

class Grade extends Model{

    use SoftDelete;
	protected $pk = 'id';
	protected $table = 'grade';
	protected $autoWriteTimestamp = true;
	protected $createTime = 'create_time';
	protected $updateTime = 'update_time';
	protected $deleteTime = 'delete_time';
	protected $dateFormat = 'Y/m/d';
 
    //一对一关联(教师 班主任)
	public function teacher(){
		return $this->hasOne('teacher');
	}

	//一对多关联(学生)
	public function students(){
		return $this->hasMany('student');
	}
}