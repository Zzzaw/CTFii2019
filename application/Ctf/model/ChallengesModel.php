<?php
namespace application\Ctf\model;

use \core\lib\Model;

class ChallengesModel extends Model
{

	public function getAll()
	{
		$stmt = $this->db->prepare('SELECT * FROM challenges');

		$stmt->execute();
		foreach ($stmt as $row) {
			//p($row);
		}
	}

	public function getByType($type)
	{
		$challenges_list = array();

		$stmt = $this->db->prepare('SELECT * FROM challenges where type=:type');
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
		$stmt = $this->db->prepare('SELECT * FROM challenges where challenge_id=:id and flag=:flag');
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
	public function getCscoreById($id)
	{
		$stmt = $this->db->prepare('SELECT current_score FROM challenges where challenge_id=:id');
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		if(1 === count($rows)) {
			return $rows[0]['current_score'];
		}
		return false;
	}

}