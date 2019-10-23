<?php
namespace application\Admin\model;

use \core\lib\Model;

class UsersModel extends Model
{

	public function isAdmin()
	{
		$stmt = $this->db->prepare('SELECT * FROM user');

		$stmt->execute();
		foreach ($stmt as $row) {
			p($row);
		}
	}
}