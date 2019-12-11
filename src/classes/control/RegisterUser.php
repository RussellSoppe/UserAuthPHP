<?php 

class RegisterUser extends UserAuth
{

	public static function insertNewUser($array, $database)
	{
		try{
			$results = $database->prepare('INSERT INTO users (first_name, last_name, user_name) VALUES (?, ?, ?)');
			$results->bindParam(1, $array['firstname']);
			$results->bindParam(2, $array['lastname']);
			$results->bindParam(3, $array['username']);
			$results->execute();
		}catch(Exception $e){
			echo "ERROR! set_user RegisterUser: " . $e->getMessage() . "</br>";
		}

		if ($results->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	} 

	public static function insertUserCreds($hash, $username, $database)
	{
		try{
			$results = $database->prepare('INSERT INTO logins (hash, user_id, user_name) SELECT ?, user_id, user_name FROM users WHERE user_name = ?');
			$results->bindParam(1, $hash);
			$results->bindParam(2, $username);
			$results->execute();
		}catch(Exception $e){
			echo "ERROR! setCreds RegisterUser: " . $e->getMessage() . "</br>";
		}
		// if register success redirect to main page with login creds
		if($results->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	public static function registerNewUser($array, $database)
	{
		
		$check = self::checkRegisterFields($array);
		
		if($check[0]){

			// Check if user exists
			$user_check = self::checkUserStatus($check[1]['username'], $database);
			
			if($user_check){

				// If user does not exist insert new user to db
				if(self::insertNewUser($check[1], $database)){

					// create hash
					$hash = password_hash($check[1]['password'], PASSWORD_DEFAULT);
					// if user creation was a success add creds to db
					$token = self::insertUserCreds($hash, $check[1]['username'], $database);
					 
					return [$token];
				}

			}else{
				// if user already exists, 
				return [$user_check, 'Credentials do not match or username already exists, please check your username/email and try again.'];

			}

		}else{

			return $check;

		}
	}


}