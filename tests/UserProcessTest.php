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
	public function testSetUserPreparePrepareReturnsPDOStatementObject()
	{
		$pdoMock = $this->createMock(PDO::class);
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test Prepare - returns a PDOStatement object
		$pdoMock->expects($this->once())->method('prepare')->willReturn($pdoStatementMock);

		$test = $pdoMock->prepare('INSERT INTO users (first_name, last_name, user_name) VALUES (?, ?, ?)');

		$this->assertIsObject($test);
		$this->assertInstanceOf(PDOStatement::class, $test);
	}

	public function testSetUserBindParamReturnsTrue()
	{
		$first = 'First';
		$last = 'Last';
		$user = 'first@mail.com';

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		$pdoStatementMock->expects($this->exactly(3))->method('bindParam')->willReturn(true);

		$test1 = $pdoStatementMock->bindParam(1, $first);
		$test2 = $pdoStatementMock->bindParam(2, $last);
		$test3 = $pdoStatementMock->bindParam(3, $user);

		$this->assertTrue($test1);
		$this->assertTrue($test2);
		$this->assertTrue($test3);

		return $test3;
	}

	/**
     * @depends testSetUserBindParamReturnsTrue
     */
	public function testSetUserExecuteReturnsTrue($bool)
	{
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test execute returns true
		$pdoStatementMock->expects($this->once())->method('execute')->willReturn($bool);

		$test = $pdoStatementMock->execute();

		$this->assertTrue($test);
	}

	public function testSetUserRowCountReturnsCountOneRowEffected(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(1);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}

	public function testSetUserRowCountReturnsCountZeroRowsEffected(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(0);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}


	/****************Set Creds******************/
	public function testSetCredsPrepareReturnsPDOStatementObject()
	{
		$pdoMock = $this->createMock(PDO::class);
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test Prepare - returns a PDOStatement object
		$pdoMock->expects($this->once())->method('prepare')->willReturn($pdoStatementMock);

		$test = $pdoMock->prepare('INSERT INTO logins (hash, user_id, user_name) SELECT ?, user_id, user_name FROM users WHERE user_name = ?');

		$this->assertIsObject($test);
		$this->assertInstanceOf(PDOStatement::class, $test);
	}

	public function testSetCredsBindParamReturnsTrue()
	{
		$hash = 'o908w7avrupyeap943w70&*^$&*(6oh324no0u989vtgf0';
		$user = 'first@mail.com';

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		$pdoStatementMock->expects($this->exactly(2))->method('bindParam')->willReturn(true);

		$test1 = $pdoStatementMock->bindParam(1, $hash);
		$test2 = $pdoStatementMock->bindParam(2, $user);

		$this->assertTrue($test1);
		$this->assertTrue($test2);

		return $test2;
	}

	/**
     * @depends testSetCredsBindParamReturnsTrue
     */
	public function testSetCredsExecuteReturnsTrue($bool)
	{
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test execute returns true
		$pdoStatementMock->expects($this->once())->method('execute')->willReturn($bool);

		$test = $pdoStatementMock->execute();

		$this->assertTrue($test);
	}

	public function testSetCredsRowCountReturnsCountOneRowEffected(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(1);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}

	public function testSetCredsRowCountReturnsCountZeroRowsEffected(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(0);
		$this->assertIsInt($pdoStatementMock->rowCount());		
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