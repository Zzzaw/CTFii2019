<?php
namespace application\Ctf\model;

use \core\lib\Model;

class ChallengesModel extends Model
{

	//get current points `challenge_id` => `current_score`
	public function getCscoreArray()
	{
		$challenges_list = array();

		$stmt = $this->db->prepare('SELECT challenge_id,current_score FROM challenges');
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		foreach ($rows as $row) {
			//p($row);
			//array_push($challenges_list, $row);
			$challenges_list[$row['challenge_id']] = $row['current_score'];
		}
		return json_encode($challenges_list);	}

	public function getByType($type)
	{
		$challenges_list = array();

		$stmt = $this->db->prepare('SELECT challenge_id,challenge_desc,current_score,attached_file,address,solved,title FROM challenges WHERE type=:type AND is_open=1');
		$stmt->bindParam(':type',$type);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		foreach ($rows as $row) {
			//p($row);
			array_push($challenges_list, $row);
		}
		return json_encode($challenges_list);

	}

	public function checkFlagById($id, $flag)
	{
		$stmt = $this->db->prepare('SELECT challenge_id FROM challenges WHERE challenge_id=:id and flag=:flag');
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':flag',$flag);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if(1 === count($rows)) {
			return true;
		}
		return false;
	}

	public function getIdByTitle($title)
	{
		$stmt = $this->db->prepare('SELECT challenge_id FROM challenges where title=:title');
		$stmt->bindParam(':title',$title);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if(1 === count($rows)) {
			return $rows[0]['challenge_id'];
		}
		return false;
	}

	//current score
	public function getCscoreById($challenge_id)
	{
		$stmt = $this->db->prepare('SELECT current_score FROM challenges where challenge_id=:challenge_id');
		$stmt->bindParam(':challenge_id',$challenge_id);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if(1 === count($rows)) {
			return $rows[0]['current_score'];
		}
		return false;
	}

	//update current_score
	public function setCscore($challenge_id, $current_score)
	{
		$stmt = $this->db->prepare('UPDATE challenges SET current_score=:current_score where challenge_id=:challenge_id');
		$stmt->bindParam(':challenge_id',$challenge_id);
		$stmt->bindParam(':current_score',$current_score);
		$stmt->execute();
		//$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();//受影响行数
		if(2 > $count) {
			return true;
		}
		return false;
	}

	//base_score
	public function getBscoreById($challenge_id)
	{
		$stmt = $this->db->prepare('SELECT base_score FROM challenges where challenge_id=:challenge_id');
		$stmt->bindParam(':challenge_id',$challenge_id);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if(1 === count($rows)) {
			return $rows[0]['base_score'];
		}
		return false;
	}

	//`solved` = `solved`+1
	public function addSolvedCount($challenge_id)
	{
		$stmt = $this->db->prepare('UPDATE challenges SET solved=solved+1 where challenge_id=:challenge_id');
		$stmt->bindParam(':challenge_id',$challenge_id);
		$stmt->execute();
		//$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		$count = $stmt->rowCount();//受影响行数
		if(1 === $count) {
			return true;
		}
		return false;

	}

	public function getSolvedCount($challenge_id)
	{
		$stmt = $this->db->prepare('SELECT solved FROM challenges where challenge_id=:challenge_id');
		$stmt->bindParam(':challenge_id',$challenge_id);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if(1 === count($rows)) {
			return $rows[0]['solved'];
		}
		return false;
	}

}