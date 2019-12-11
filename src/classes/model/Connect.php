<?php 	

class Connect
{

	public function connectMySQL($db_creds)
	{
		try {
				
			$database = new PDO('mysql:host=' . $db_creds['dburl'] .';dbname=' . $db_creds['dbname'], $db_creds['dbuser'], $db_creds['dbpassword']);

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