<?php
namespace app\teacher\validate;

use think\Validate;

class User extends Validate
{
	protected $rule = [
        'name|用户名'	 =>  'require|max:25',
        'password|密码'	 =>  'require|min:6|confirm:repassword',
        'email|邮箱'		 =>  'require|email',
    ];

    protected $message = [
    	'name.require'	=>'名称不能为空',
    	'name.max'		=>'名称最多不能超过25个字符',
    	'email'			=>'邮箱格式错误',
    	'password.min'	=>'密码个数不能少于6位',
    	'password.require'=>'密码不能为空',
		'password.confirm'	=>'两次密码不一致',
    ];
}