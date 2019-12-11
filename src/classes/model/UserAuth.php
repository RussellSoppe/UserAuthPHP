<?php 

class UserAuth extends DataSecure
{

	protected static function checkUserStatus($username, $database)
	{
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

	protected static function getUserCreds($username, $database)
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

	protected static function loginUser($array, $database)
	{
		
		$check = self::checkLoginFields($array);
		
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

	public static function userSession($database)
	{

		if(isset($_POST['login'])){

			$_SESSION['user_auth'] = UserAuth::loginUser($_POST, $database);

			// $user = new UserProfile($_SESSION['user_auth'][1], $database);
			// $_SESSION['user'] = $user->getUser();
	

		}elseif(isset($_POST['register'])){

			$_SESSION['user_register'] = RegisterUser::registerNewUser($_POST, $database);
			$_SESSION['user_auth'] = UserAuth::loginUser($_POST, $database);

			// $user = new UserProfile($_SESSION['user_auth'][1], $database);

			// $_SESSION['user'] = $user->getUser();
	
		}
	}

}