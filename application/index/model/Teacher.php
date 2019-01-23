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

	public function grade(){
		return $this->hasOne('grade');
	}
}