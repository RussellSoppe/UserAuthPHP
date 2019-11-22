<?php

class DataSecure extends UserAuth
{

	public static function filterUserData($array)
	{

		$user_array = [];

		foreach($array as $key=>$item){
			
			if($key == 'username'){
				$data = strtolower(trim(filter_var($item, FILTER_SANITIZE_EMAIL)));
				$user_array[$key] = $data;
			}else{
				$data = trim(filter_var($item, FILTER_SANITIZE_STRING));
				$user_array[$key] = $data;
			}
		}
		return $user_array; 
	}

	
	public static function checkHasHoneyPot($string)
	{
		$pot = !empty($string);
		return $pot;
	}


	public static function checkHasEmptyFields($array, $exception = "")
	{

		foreach($array as $key=>$item)
		{
			if($key != $exception && $item == ""){
				return true;
			}
		}

		return false;
	}

	public static function checkRegisterFields($array)
	{
		$array = self::filterUserData($array);

		if(self::checkHasHoneyPot($array['address'])){
			return [false, "Bad Form Input"];

		}elseif(self::checkHasEmptyFields($array, 'address')){
			return [false, "All fields required, please fill in all fields." ];

		}elseif(!self::checkPasswordMatch($array['password'], $array['re-password'])){
			return [false, "Passwords entered do not match, please try again."];
		}else{
			return [true, $array];
		}
	}

	public static function checkLoginFields($array)
	{
		$array = self::filterUserData($array);

		if(self::checkHasHoneyPot($array['address'])){
			return [false, "Bad Form Input"];

		}elseif(self::checkHasEmptyFields($array, 'address')){
			return [false, "All fields required, please fill in all fields." ];
		}else{
			return [true, $array];
		}
	}

}