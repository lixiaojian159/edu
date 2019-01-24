<?php

namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;

class Teacher extends Model{

    use SoftDelete;
	protected $pk = 'id';
	protected $table = 'teacher';
	protected $autoWriteTimeStamp = true;
	protected $createTime = 'create_time';
	protected $updateTime = 'update_time';
	protected $dataFormal = 'Y/m/d';

    //定义反向关联(教师管理的班级)
	public function grade(){
		return $this->belongsTo('grade');
	}
}