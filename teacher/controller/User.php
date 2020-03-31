<?php
namespace app\teacher\controller;

use app\teacher\base\Base;
use think\Db;
use app\teacher\model\Teacher as TeacherModel;
use app\teacher\validate\User as UserValidate;


class User extends Base
{

	public function index()
	{

		$user = new TeacherModel();
		$value = $user->paginate(4,true);
        $page = $value->render();
    	$this->assign('list',$value);
        $this->assign('page',$page);
        return $this->fetch();
	}

	public function add()
	{
		
		return $this->fetch('add');
	}

	public function insert()
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

    public function edit()
    {
    	$id = input('id');
    	$user = TeacherModel::get($id);
    	$this->assign('user',$user);
    	return $this->fetch('edit');
    }

    public function update()
    {
    	$data = input('post.');
    	$id   = input('id');
    	$val = new UserValidate();
	 	$result = $val->check($data);
	 	if(!$result){
	 		$this->error($val->getError());
	 		exit;
	 	}
	 	$user = new TeacherModel();
	 	$res  =  $user->allowField(true)->save($data,['id'=>$id]);
	 	if($res){
	 		$this->success('修改成功','index');
	 	}else{
	 		$this->error('修改失败');
	 	}
    }

    public function delete()
    {
    	$id = input('id');
    	$res = TeacherModel::destroy($id);
    	if($res){
    		$this->success('删除成功');
    	}else{
    		$this->success('删除失败');
    	}
    }

    public function query()
    {
    	$name = input('name');
    	$sex  = input('sex');
    	$where= [];
    	if(!empty($name)){
    		$where['name'] = $name;
    	}
    	if(!empty($sex)){
    		$where['sex'] = $sex;
    	}
    	$value = Db::table('teacher')->where($where)->select();
        $this -> assign("list",$value);
    	return $this->fetch('query');
    }
}