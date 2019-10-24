<?php
namespace application\Ctf\model;

use \core\lib\Model;

class UsersModel extends Model
{
	public function getById($id)
	{
		$challenges_list = array();

		$stmt = $this->db->prepare('SELECT user_id,nickname,solved_challenge_id,email FROM users where user_id=:id');
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);


		if(1 === count($rows)) {
			$rows[0]['solved_challenge_id'] = explode(';', $rows[0]['solved_challenge_id']);
			return json_encode($rows[0]);
		}
		return false;
/*
		foreach ($rows as $row) {
			//p($row);
			array_push($challenges_list, $row);
		}
		return json_encode($challenges_list);
		*/
	}

	public function loginCheck($email, $password)
	{
		//$challenges_list = array();
		$stmt = $this->db->prepare('SELECT * FROM users where email=:email and password=:password');
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':password',$password);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if(1 === count($rows)) {
			return $rows[0]['user_id'];
		}
		return 0;
		
	}

	public function registerJnu($email, $nickname, $password, $stu_number, $name)
	{

		$stmt = $this->db->prepare('insert into users (email,nickname,password,stu_number,name) 
									values (:email,:nickname,:password,:stu_number,:name)');
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':nickname',$nickname);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':stu_number',$stu_number);
		$stmt->bindParam(':name',$name);
		$stmt->execute();
		$count = $stmt->rowCount();//受影响行数
		if(1 === $count) {
			return true;
		}
		return false;

	}

	//检查选手答过这题没
	public function checkIsSolved($user_id, $challenge_id)
	{

		$stmt = $this->db->prepare('SELECT solved_challenge_id FROM users where user_id=:user_id');
		$stmt->bindParam(':user_id',$user_id);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		$challenges_id_list = explode(';', $rows[0]['solved_challenge_id']);
		return in_array($challenge_id, $challenges_id_list);

		
	}



	public function setScore($user_id, $score)
	{
		$stmt = $this->db->prepare('UPDATE users SET score=:score where user_id=:user_id');
		$stmt->bindParam(':user_id',$user_id);
		$stmt->bindParam(':score',$score);
		$stmt->execute();
		$count = $stmt->rowCount();//受影响行数
		if(2 > $count) {
			return true;
		}
		return false;
	}


	public function setUpdateDate($user_id, $last_update_date)
	{
		$stmt = $this->db->prepare('UPDATE users SET last_update_date=:last_update_date where user_id=:user_id');
		$stmt->bindParam(':user_id',$user_id);
		$stmt->bindParam(':last_update_date',$last_update_date);
		$stmt->execute();
		$count = $stmt->rowCount();//受影响行数
		if(2 > $count) {
			return true;
		}
		return false;
	}

	public function getScoreById($user_id)
	{

		$stmt = $this->db->prepare('SELECT score FROM users where user_id=:user_id');
		$stmt->bindParam(':user_id',$user_id);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if(1 === count($rows)) {
			return $rows[0]['score'];
		}
		return 0;
	}



	public function addSolvedChallengeId($user_id, $solved_challenge_id)
	{
		$stmt = $this->db->prepare('UPDATE users SET solved_challenge_id=:solved_challenge_id where user_id=:user_id');
		$stmt->bindParam(':user_id',$user_id);
		$stmt->bindParam(':solved_challenge_id',$solved_challenge_id);
		$stmt->execute();
		$count = $stmt->rowCount();//受影响行数
		if(2 > $count) {
			return true;
		}
		return false;

	}

	//json
	public function getSolvedChallengesId($user_id)
	{
		$challenges_list = array();

		$stmt = $this->db->prepare('SELECT solved_challenge_id FROM users where user_id=:user_id');
		$stmt->bindParam(':user_id',$user_id);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if(1 === count($rows)) {
			$challenges_list = explode(';', $rows[0]['solved_challenge_id']);
			return json_encode($challenges_list);
		}
		return false;
		

	}

	//text
	public function getSolvedChallengesId_text($user_id)
	{
		$stmt = $this->db->prepare('SELECT solved_challenge_id FROM users where user_id=:user_id');
		$stmt->bindParam(':user_id',$user_id);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if(1 === count($rows)) {
			return $rows[0]['solved_challenge_id'];
		}
		return false;
	}



	public function getUserBySolved()
	{
		$challenges_list = array();

		$stmt = $this->db->prepare('SELECT user_id,nickname,solved_challenge_id,last_update_date FROM users WHERE solved_challenge_id IS NOT NULL');
		//$stmt->bindParam(':n',$n);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		foreach ($rows as $row) {
			//p($row);
			$row['solved_challenge_id'] = explode(';', $row['solved_challenge_id']);
			$row['last_update_date'] = explode('-', $row['last_update_date']);
			array_push($challenges_list, $row);
		}
		return json_encode($challenges_list);
	}
}
