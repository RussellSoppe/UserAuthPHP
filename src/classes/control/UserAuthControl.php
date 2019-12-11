<?php

class UserAuthControl
{
	public static function logout()
	{
		session_destroy();
		return "index.php";
	}
}