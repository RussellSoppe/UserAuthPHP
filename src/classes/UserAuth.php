<?php 

class UserAuth
{

	public static function checkPasswordMatch($password_one, $password_two)
	{
		return $password_one == $password_two;
	}


	public static function createHash($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}


	public static function verifyCred($password, $hash)
	{
		return password_verify($password, $hash);
	}


	public static function checkUserStatus($username, $database)
	{
		// need database
		try{
			$results = $database->prepare('SELECT user_name FROM users WHERE user_name = ?');
			$results->bindParam(1, $username);
			$results->execute();
		}catch(Exception $e){
			echo "ERROR!: " . $e->getMessage() . "</br>";
		}

		if ($results->rowCount() > 0){
			return false;
		}else{
			return true;
		}
	}

}