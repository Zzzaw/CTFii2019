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
			//exit();
		}

		//检查flag正确性
		$result = $challengesModel->checkFlagById($challenge_id, $flag_submit);
		if(!$result){
			echo 'flag提交错误哦!';
			exit();
		}

		//set solved_challenge_id
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


		//add challenge's `solved`
		if(!$challengesModel->addSolvedCount($challenge_id)){
			exit('something wrong');
		}

		//update challenge's current_points
		$base_score = $challengesModel->getBscoreById($challenge_id);
		$solved_count = $challengesModel->getSolvedCount($challenge_id);
		$current_points = $this->get_current_points(30, 500, $solved_count);
		if(!$challengesModel->setCscore($challenge_id, $current_points)){
			exit('something wrong');
		}


		//set last_update_date
		$date = get_Date();
		//echo $date;
		if(!$usersModel->setUpdateDate($user_id, $date)){
			exit('something wrong');
		}
	}

	//update current_score
	public function get_current_points($min_points, $max_points, $solves)
	{
		$current_points = intval(round($min_points + ($max_points - $min_points)/(1 + pow((max(0, $solves - 1)/11.92201), 1.206069))));
		return $current_points;
	}



}