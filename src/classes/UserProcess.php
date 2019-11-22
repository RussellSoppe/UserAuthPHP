<?php 

class UserProcess extends DataSecure
{

	public static function myProcess()
	{
		return true;
	}

	public static function setUser($array, $database)
	{
		// need database
		try{
			$results = $database->prepare('INSERT INTO users (first_name, last_name, user_name) VALUES (?, ?, ?)');
			$results->bindParam(1, $array['firstname']);
			$results->bindParam(2, $array['lastname']);
			$results->bindParam(3, $array['username']);
			$results->execute();
		}catch(Exception $e){
			echo "ERROR! register_new_user insert user: " . $e->getMessage() . "</br>";
		}

		if ($results->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	} 

	public static function setCreds($hash, $username, $database)
	{
		// need database
		try{
			$results = $database->prepare('INSERT INTO logins (hash, user_id, user_name) SELECT ?, user_id, user_name FROM users WHERE user_name = ?');
			$results->bindParam(1, $hash);
			$results->bindParam(2, $username);
			$results->execute();
		}catch(Exception $e){
			echo "ERROR! register_new_user insert login: " . $e->getMessage() . "</br>";
		}
		// if register success redirect to main page with login creds
		if($results->rowCount() > 0){
			return true;
		}else{
			return false;
		}
	}

	public static function getUserCreds($username, $database)
	{
		$error_message = 'Your login credentials did not match. Please re-enter your information and try again.';

		if(self::checkUserStatus($username, $database) != true){
		
			try{
				$results = $database->prepare('SELECT hash, user_id FROM logins WHERE user_name = ?');
				$results->bindParam(1, $username);
				$results->execute();
			}catch(Exception $e){
				echo "ERROR!: " . $e->getMessage() . "</br>";
			}
		}else{
			return [false, $error_message];
		}
		
		$creds = $results->fetch(PDO::FETCH_ASSOC);

		if(empty($creds)){
			
			return [false, $error_message];

		}else{
			
			return [true, $creds];
		}
	}

	public static function registerNewUser($array, $database)
	{
		// need database
		$check = self::checkRegisterFields($array);
		// need database
		if($check[0]){
			$hash = password_hash($check[1]['password'], PASSWORD_DEFAULT);

			// Check if user exists
			if(self::checkUserStatus($check[1]['username'], $database)){

				// If user does not exist insert new user to user Table
				if(self::setUser($check[1], $database)){

					// if user creation was a success add creds to login table
					 $token = self::setCreds($hash, $check[1]['username'], $database);
					 var_dump($token);
					 return [$token];
				}
			}

		}else{

			return $check;

		}
	}

	public static function loginUser($array, $database)
	{
		// need database
		$check = self::checkLoginFields($array);
		// var_dump($check);

		$error_message = 'Your login credentials did not match. Please re-enter your information and try again.';

		if($check[0]){

			// get user creds (which runs a check on user status)
			$creds = self::getUserCreds($check[1]['username'], $database);
	
			if($creds[0] && password_verify($check[1]['password'], $creds[1]['hash'])){
				// echo "Password Correct";
				return [true, $creds[1]['user_id']];
				
			}else{
				// echo "Password Fail";
				return [false, $error_message];
			}

		}else{

			return $check;

		}
	}

}