<?php
namespace application\Admin\controller;
// 使用并继承\core\lib\Controller类
use core\lib\Controller;

class Index extends Controller
{
	public function test($a, $b, $c)
	{
		p($a.$b.$c);
		//p(__FUNCTION__);
		$this->display('index');
	}

	public function index()
	{
		//$this->display('index');
		//$usersModel = new \application\Admin\model\UsersModel();
		$usersModel = D('Admin', 'UsersModel');
		$usersModel->isAdmin();
		p('hi');
		header('HTTP/1.1 404 Not Found');
		return 'hi';
	}
}