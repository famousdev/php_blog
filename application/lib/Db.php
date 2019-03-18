<?php

namespace application\lib;

use PDO;

class Db
{

	protected $db;
	
	public function __construct()
	{
		$config = require 'application/config/db_config.php';
		$this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].';charset='.$config['charset'], $config['user'], $config['password']);
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $this->db->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);	
	}
	
	public function query($sql, $params = [])
	{
		$stmt = $this->db->prepare($sql);
		if (!empty($params)) {
			foreach ($params as $key => $value) {
				if (is_int($value)) {
					$type = PDO::PARAM_INT;
				} else {
					$type = PDO::PARAM_STR;
				}
				$stmt->bindValue(':'.$key, $value, $type);
			}
		}
		$stmt->execute();
		return $stmt;
	}

	public function row($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function column($sql, $params = [])
	{
		$result = $this->query($sql, $params);
		return $result->fetchColumn();
	}

	public function lastInsertId()
	{
		return $this->db->lastInsertId();
	}

}