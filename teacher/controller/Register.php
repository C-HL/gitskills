<?php
namespace app\teacher\controller;

use think\Controller;
use think\Db;
use app\teacher\validate\User as UserValidate;
use app\teacher\model\Teacher as TeacherModel;

class Register extends Controller
{
	public function register()
	{
		return $this->fetch();
	}

	public function doRegister()
	{
		$data = input('post.');
		$val = new UserValidate();
		$result = $val->check($data);
		if(!$result){
			$this->error($val->getError());
			exit;
		}
		$user = new TeacherModel($data);
		// dump($user);die;
    	$res = $user->where('name',input('name'))->count();
		if($res > 0){
				$this->error('用户已存在');
		}else{
			$ret = $user->allowField(true)->save();
			if($ret){
				$this->success('注册成功','index/index');
			}else{
				$this->error('注册失败');
			}
		}
	}
}