<?php

namespace model;

abstract class DBAccess {
	
  	protected $db;

	public function __construct()
	{
		$db = new \PDO('mysql:host=localhost;dbname=projet5', 'root', '');
		$this->db = $db;
	}
}



