<?php
namespace app\teacher\controller;

use think\Controller;
// use app\teacher\validate\User as UserValidate;
use app\teacher\model\Teacher as TeacherModel;

class Register extends Controller
{
	public function register()
	{
		return $this->fetch('user/add');
	}

	public function doRegister()
	{
		$data = input('post.');
	 	// $val = new UserValidate();
	 	// $result = $val->check($data);
	 	// if(!$result){
	 	// 	$this->error($val->getError());
	 	// 	exit;
	 	// }
		$user = new TeacherModel($data);
		// dump($user);die;
    	$res = $user->where('name',input('name'))->count();
		if($res > 0){
				$this->error('管理员已存在');
		}else{
			$ret = $user->allowField(true)->save();
			if($ret){
				$this->success('新增成功');
			}else{
				$this->error('新增失败');
			}
		}
	}
}