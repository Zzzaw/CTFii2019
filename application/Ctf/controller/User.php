<?php
namespace application\Ctf\controller;
use \application\Ctf\lib\Controller_Ctf;

class User extends Controller_Ctf
{

	public function index()//显示用户资料
	{
		session_start();
		if($_SESSION['islogin']){
			$this->display('info');
		}
		
	}

	public function loginPage()
	{
		$this->display('login');
	}

	public function login()//验证loginPage传来的用户信息
	{
		session_start();

		$email = $_POST['email'];
		$password = $_POST['password'];

		$email = str_r($email);
		$password = str_r($password);

		if(empty($email) or empty($password)) {
			p('no');//TODO
			exit();
		}

		$usersModel = D('Ctf', 'UsersModel');
		
		$user_id = $usersModel->loginCheck($email, $password);
		if($user_id){
			
			session_start();
			$_SESSION['islogin'] = true;
			$_SESSION['user_id'] = $user_id;
			p($_SESSION['user_id']);
			p('login success');//TODO
			//header('location:/ctf');

		}
		else
		{
			p('login fail');//TODO
			//header('location:/ctf');
		}
			

	}

	public function registerPage()
	{
		$this->display('register');
	}

	public function register()
	{
		
		$email = $_POST['email'];
		$nickname = $_POST['nickname'];
		$password = $_POST['password'];
		$stu_number = $_POST['stu_number'];
		$name = $_POST['name'];
		
		$email = str_r($email);
		$nickname = str_r($nickname);
		$password = str_r($password);
		$stu_number = str_r($stu_number);
		$name = str_r($name);



		if(empty($email) or empty($password) or empty($stu_number) or empty($name)){
			p('no');//TODO
			exit();
		}

		

		$usersModel = D('Ctf', 'UsersModel');
		if($usersModel->registerJnu($email, $nickname, $password, $stu_number, $name)) {
			p('ok');//TODO
		} else {
			p('failed');//TODO
		}

	}

	public function logout()
	{
		session_start();
		session_unset();
		session_destroy();
		header('location:/ctf');
	}

	public function getInfo()
	{
		check_session_islogin();

		//get challenge_id=>current_points array
		$challengesModel = D('Ctf', 'ChallengesModel');
		$point_list = $challengesModel->getCscoreArray();	
		$point_list = json_decode($point_list);

		//get user
		//add user['score']
		$usersModel = D('Ctf', 'UsersModel');
		$id = $_SESSION['user_id'];
		$userInfo = $usersModel->getById($id);
		$userInfo = json_decode($userInfo);

		foreach ($userInfo->solved_challenge_id as $solved_challenge_id) {
			$userInfo->score += $point_list->$solved_challenge_id;
		}
		echo json_encode($userInfo);
	
	}


	public function getSolvedChallenges()
	{
		check_session_islogin();

		session_start();
		$user_id = $_SESSION['user_id'];
		$usersModel = D('Ctf', 'UsersModel');
		$challenges = $usersModel->getSolvedChallengesId($user_id);
		echo $challenges;
	}


}