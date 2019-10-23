<?php
namespace application\Ctf\controller;
use \application\Ctf\lib\Controller_Ctf;

Class Index extends Controller_Ctf
{

	//欢迎页面
	public function index()
	{

		$this->display('index');
		
	}

	public function notice()
	{
		$this->display('notice');
	}


}