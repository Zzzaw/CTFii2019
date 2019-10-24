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

	public function calcUserScore()
	{
		//TODO:
		//get challenge_id=>current_points array
		$challengesModel = D('Ctf', 'ChallengesModel');
		$point_list = $challengesModel->getCscoreArray();	
		$point_list = json_decode($point_list);

		//get user array
		//add user['score']
		
		$usersModel = D('Ctf', 'UsersModel');
		$user_list = $usersModel->getUserBySolved();
		$user_list = json_decode($user_list);

		foreach ($user_list as $user) {
			foreach ($user->solved_challenge_id as $solved_challenge_id) {
				$user->score += $point_list->$solved_challenge_id;
			}
		}

		$user_list = sortByScore($user_list);
		echo json_encode($user_list);
		exit();
	
	}


}