<?php
namespace app\teacher\controller;

use think\Controller;
use think\Db;
use app\teacher\model\Teacher as TeacherModel;

class Index extends Controller
{
	public function index()
	{


        return $this->fetch();
	}

	public function login(){

			$data = input('post.');
			$user = new TeacherModel(); 
			$res = $user->where('name',$data['name'])->find();
			//dump($res);die;
			if(empty($res)){
				return $this->error('用户名不存在');
			}elseif(!$res['password'] === md5($data['password'])){
				return $this->error('密码不正确');
				}elseif(!captcha_check($data['captcha'])){
					$this->error('验证码不正确');
					}else{
						session('name',$data['name']);
						$this->success('验证成功,登陆中','User/index');
					} 
					
	}

	public function logout()
	{
	//销毁session
    session(NULL);
    //跳转页面
    $this->success('退出成功','index');
	}
	
}