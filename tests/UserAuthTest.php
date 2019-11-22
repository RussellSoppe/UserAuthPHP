<?php
use PHPUnit\Framework\TestCase;

class UserAuthTest extends TestCase
{
	
	private $password = '1234$Yes!';
	private $password_match = '1234$Yes!';
	private $password_no_match = '1234$No!';


	/****************Test of Test!******************/
	public function testIfEmptyArray()
	{
		$user_array = [];

		//check if empty array is empty!
		$this->assertSame(0, count($user_array));
	}

	/****************Check Password Match******************/

	// Check if passwords match or don't match (2) tests
	public function testCheckPasswordMatchBoolAndTrue()
	{
		$check_match = UserAuth::checkPasswordMatch($this->password, $this->password_match);

		$this->assertIsBool($check_match);
		$this->assertTrue($check_match);
	}

	public function testCheckPasswordMatchBoolAndFalse()
	{
		$check_not_match = UserAuth::checkPasswordMatch($this->password, $this->password_no_match);

		$this->assertIsBool($check_not_match);
		$this->assertFalse($check_not_match);
	}
	
	/****************Create Hash******************/
	public function testCreateHashIfHashIsString()
	{
		$check = UserAuth::createHash($this->password);

		$this->assertIsString($check);

		return $check;
	}


	/****************Check Hash Match******************/

	/**
     * @depends testCreateHashIfHashIsString
     */
	public function testVerifyCredPasswordHashMatchTrue($hash)
	{
		
		$check = UserAuth::verifyCred($this->password, $hash);

		$this->assertIsBool($check);
		$this->assertTrue($check);
	}

	/**
     * @depends testCreateHashIfHashIsString
     */
	public function testVerifyCredPasswordHashMatchFalse($hash)
	{
		
		$check = UserAuth::verifyCred($this->password_no_match, $hash);

		$this->assertIsBool($check);
		$this->assertFalse($check);
	}

	
	/****************Check User Status******************/

	public function testCheckUserStatusPrepareReturnsPDOStatementObject(){

		$username = 'username@mail.com';

		$pdoMock = $this->createMock(PDO::class);
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test Prepare - returns a PDOStatement object
		$pdoMock->expects($this->once())->method('prepare')->willReturn($pdoStatementMock);

		$test = $pdoMock->prepare('SELECT user_name FROM users WHERE user_name = ?');

		$this->assertIsObject($test);

		$this->assertInstanceOf(PDOStatement::class, $test);

	}

	public function testCheckUserStatusBindParamReturnsTrue(){

		$username = 'username@mail.com';

		$pdoStatementMock = $this->createMock(PDOStatement::class);


		// Test bindParam returns true
		$pdoStatementMock->expects($this->once())->method('bindParam')->willReturn(true);

		$test = $pdoStatementMock->bindParam(1, $username);

		$this->assertTrue($test);

		return $test;
	}

	/**
     * @depends testCheckUserStatusBindParamReturnsTrue
     */
	public function testCheckUserStatusExecuteReturnsTrue($bool){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test execute returns true
		$pdoStatementMock->expects($this->once())->method('execute')->willReturn($bool);

		$test = $pdoStatementMock->execute();

		$this->assertTrue($test);	
	}

	public function testCheckUserStatusRowCountReturnsCountOneUserFound(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(1);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}

	public function testCheckUserStatusRowCountReturnsCountZeroUserNotFound(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(0);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}

}