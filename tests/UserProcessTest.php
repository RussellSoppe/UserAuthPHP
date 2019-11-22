<?php  
use PHPUnit\Framework\TestCase;

class UserProcessTest extends TestCase
{
	

	/****************Test of Test!******************/
	public function testIfEmptyArray()
	{
		$user_array = [];

		//check if empty array is empty!
		$this->assertSame(0, count($user_array));
	}

	public function testIfBoolAndTrue()
	{
		$check = UserProcess::myProcess();

		$this->assertIsBool($check);
		$this->assertTrue($check);
	}

	/****************Set User******************/
	// need sanitized and checked register array
	// need database object/connection

	// returns bool
	//returns true if sql rowCount() > 0
	//returns faslse if sql rowCount() < 0


	/****************Set Creds******************/
	// need hash
	// need username
	// need database object/connection

	//returns bool
	//returns true if sql rowCount() > 0
	//returns faslse if sql rowCount() < 0
	public function testSetCredsPrepareReturnsPDOStatementObject()
	{
		
	}


	/****************Get User Creds******************/
	// need username
	// need database object/connection

	// uses checkUserStatus to check if user exists
	// if no user exits returns array with bool false and error string

	// if user exists queries database for creds
	// creates creds associative array from pdo->fetch
	// returns array with bool true and cred array if creds is not empty
	// returns array with bool false and error string if creds are empty


	/****************Register New User******************/
	// need register array - will sanitize and check through the checkUserFields method
	// need database object/connection

	// uses checkUserFields to create new array for use as at start
	// creates hash
	// uses checkUser Status
	// uses SetUser
	// users Set Cred

	//returns bool
	//returns true from setCreds if success
	//returns array from checkUserFields if checkUserFields runs false


	/****************Login User******************/
	// needs login array
	// need database object/connection

	// creates new array, filtered and checked from checkUserFields

	// if new array[0] is true
		// creates $creds variable from getUserCreds using data from new array
		// checks creds against entered data with password_verify
		// if password verifies returns array with bool true and user id
		// else returns array with bool false and error string
	// else returns new array with bool false and error string


}