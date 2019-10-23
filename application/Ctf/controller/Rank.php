<?php
namespace application\Ctf\controller;
use \application\Ctf\lib\Controller_Ctf;

Class Rank extends Controller_Ctf
{

	//欢迎页面
	public function index()
	{

		$this->display('index');
		
	}

	public function getTopN()
	{
		$usersModel = D('Ctf', 'UsersModel');
		$topN = $usersModel->getTopN(4);
		echo $topN;
	}



}