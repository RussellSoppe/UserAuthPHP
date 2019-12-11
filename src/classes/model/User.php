<?php

class User extends UserAuth
{
	// Properties/State
	private $db;
	private $db_creds = array(
		'dbuser' => 'root',
		'dbpassword' => 'root',
		'dbname' => 'userauth',
		'dburl' => 'localhost'
	);
	
	private $user_name;
	private $first_name;
	private $last_name;
	private $full_name;
	private $user_id;

	// Constructor
	public function __construct($user_id)
	{
		$this->database = new Connect();
		$this->database = $this->database->connectMySQL($this->db_creds);

		$this->user_id = $user_id;

		$this->setUserName();
		$this->setFirstName();
		$this->setLastName();
		$this->setFullName();
		
	}

	// Methods
	public function getUserName()
	{
		return $this->user_name;
	}

	private function setUserName()
	{
		try {
			$results = $this->database->prepare('SELECT user_name FROM users WHERE user_id = ?');
			$results->bindParam(1, $this->user_id);
			$results->execute();
		} catch (exception $e) {
			echo "ERROR!". __METHOD__ . ": " . $e->getMessage() . "</br>";
		}

		if($results->rowCount() > 0){

			$results = $results->fetch(PDO::FETCH_ASSOC);
			$this->user_name = $results['user_name'];
		}
	}

	public function getFirstName()
	{
		return $this->first_name;
	}

	private function setFirstName()
	{
		try {
			$results = $this->database->prepare('SELECT first_name FROM users WHERE user_id = ?');
			$results->bindParam(1, $this->user_id);
			$results->execute();
		} catch (exception $e) {
			echo "ERROR!". __METHOD__ . ": " . $e->getMessage() . "</br>";
		}

		if($results->rowCount() > 0){
			$results = $results->fetch(PDO::FETCH_ASSOC);
			$this->first_name = $results['first_name'];
		}
	}

	public function getLastName()
	{
		return $this->last_name;
	}

	private function setLastName()
	{
		try {
			$results = $this->database->prepare('SELECT last_name FROM users WHERE user_id = ?');
			$results->bindParam(1, $this->user_id);
			$results->execute();
		} catch (exception $e) {
			echo "ERROR!". __METHOD__ . ": " . $e->getMessage() . "</br>";
		}

		if($results->rowCount() > 0){
			$results = $results->fetch(PDO::FETCH_ASSOC);
			$this->last_name = $results['last_name'];
		}
	}


	public function getFullName()
	{
		return $this->full_name;
	}

	private function setFullName()
	{
		try {
			$results = $this->database->prepare('SELECT first_name, last_name FROM users WHERE user_id = ?');
			$results->bindParam(1, $this->user_id);
			$results->execute();
		} catch (exception $e) {
			echo "ERROR!". __METHOD__ . ": " . $e->getMessage() . "</br>";
		}

		if($results->rowCount() > 0){
			$this->full_name = $results->fetch(PDO::FETCH_ASSOC);
		}
	}

}