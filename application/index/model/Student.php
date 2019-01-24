<?php

namespace app\index\model;

use think\Model;

use traits\model\SoftDelete;

class Student extends Model{

    use SoftDelete;
	protected $pk = 'id';
	protected $table = 'student';
	protected $autoWriteTimestamp = true;
	protected $createTime = 'create_time';
	protected $updateTime = 'update_time';
	protected $deleteTime = 'delete_time';
	protected $dateFormal = 'Y/m/d';

    //获取性别转换
    public function getSexAttr($value){
    	$sex = [0=>'女',1=>'男'];
    	return $sex[$value];
    }

    //反向关联(学生属于的班级)
	public function grade(){
		return $this->belongsTo('grade');
	}
}