<?php
namespace application\Ctf\controller;
use \application\Ctf\lib\Controller_Ctf;

Class Challenge extends Controller_Ctf
{

	public function index()
	{
		check_session_islogin();

		$this->display('challenges');
	}

	public function web()
	{
		check_session_islogin();

		$challengesModel = D('Ctf', 'ChallengesModel');
		$Challenge = $challengesModel->getByType('web');
		echo $Challenge;
		//echo json_encode('hi');
		//$this->display('challenges');
	}

	public function checkFlag()
	{
		check_session_islogin();

		$challenge_id = $_GET['challenge_id'];
		$title = $_GET['title'];
		$flag_submit = $_GET['flag_submit'];
		$title = addslashes($title);
		$flag_submit = addslashes($flag_submit);
		session_start();
		$user_id = $_SESSION['user_id'];

		//先检查选手答过这题没
		$challengesModel = D('Ctf', 'ChallengesModel');
		$usersModel = D('Ctf', 'UsersModel');
		$result = $usersModel->checkIsSolved($user_id, $challenge_id);
		if($result){
			echo '已提交过本题flag';
			exit();
		}

		//检查flag正确性
		$result = $challengesModel->checkFlagById($challenge_id, $flag_submit);
		if(!$result){
			echo 'flag提交错误哦!';
			exit();
		}

		//给选手加分
		$score_add = $challengesModel->getCscoreById($challenge_id);
		$score = $usersModel->getScoreById($user_id);
		$score += $score_add;
		if(!$usersModel->setScore($user_id, $score)){
			exit('flag提交失败');
		}

		//TODO:set solved_challenge_id
		$solved_challenge_id = $usersModel->getSolvedChallengesId_text($user_id);
		if(!empty($solved_challenge_id)){
			$solved_challenge_id .= ';' . $challenge_id;
		} else {
			$solved_challenge_id = $challenge_id;
		}
		if(!$usersModel->addSolvedChallengeId($user_id, $solved_challenge_id)){
			exit('something wrong');
		}
		echo 'flag提交正确!';
		exit();



	}


}