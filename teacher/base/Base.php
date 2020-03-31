<?php
namespace app\teacher\base;

use think\Controller;

class Base extends Controller
{
	public function _initialize()
	{
		if(!session('name')){
			return $this->error('请登录','index/index');
		}
	}
}