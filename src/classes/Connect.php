<?php 	

class Connect
{

	public function connectMySQL($dburl, $dbname, $dbuser, $dbpassword)
	{
		try {
				
			$database = new PDO('mysql:host=' . $dburl .';dbname=' . $dbname, $dbuser, $dbpassword);

			$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $database;

		} catch (Exception $e) {
				
			return "Error: " . __METHOD__ . $e->getMessage();
		}
			
	}

	public function connectSQLite($dbfilepath)
	{
		try {
				
			$database = new PDO("sqlite:" . $dbfilepath);
			$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $database;

		} catch (Exception $e) {
				
			return "Error: " . __METHOD__ . $e->getMessage();
		
		}
			
	}
}