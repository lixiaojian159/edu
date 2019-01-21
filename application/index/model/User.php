<?php

namespace app\index\model;

use think\Model;

class User extends Model{

	protected $pk = 'id';
	protected $table = 'user';
	protected $autoWriteTimestamp = true;
	protected $createTime = 'create_time';
	protected $updateTime = 'update_time';
}