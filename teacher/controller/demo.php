<?php


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



			if ($res) {
				if ($res['password'] === md5($data['password'])) {
					session('name',$data['name']);
				}else{
					return $this->error('密码不正确');
				}
			}else{
				return $this->error('用户名不存在');
			}

			if(!captcha_check($data['captcha'])){
 				//验证失败
 				$this->error('验证码不正确');
			}else{
				$this->success('验证成功,登陆中','User/index');
			}