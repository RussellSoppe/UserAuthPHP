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

	/****************Get User Creds******************/

	public function testGetUserCredsPrepareReturnsPDOStatementObject()
	{
		$pdoMock = $this->createMock(PDO::class);
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test Prepare - returns a PDOStatement object
		$pdoMock->expects($this->once())->method('prepare')->willReturn($pdoStatementMock);

		$test = $pdoMock->prepare('SELECT hash, user_id FROM logins WHERE user_name = ?');

		$this->assertIsObject($test);
		$this->assertInstanceOf(PDOStatement::class, $test);
	}

	public function testGetUserCredsBindParamReturnsTrue()
	{
		$user = 'first@mail.com';

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		$pdoStatementMock->expects($this->once())->method('bindParam')->willReturn(true);

		$test1 = $pdoStatementMock->bindParam(1, $user);

		$this->assertTrue($test1);

		return $test1;
	}

	/**
     * @depends testGetUserCredsBindParamReturnsTrue
     */
	public function testGetUserCredsExecuteReturnsTrue($bool)
	{
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test execute returns true
		$pdoStatementMock->expects($this->once())->method('execute')->willReturn($bool);

		$test = $pdoStatementMock->execute();

		$this->assertTrue($test);
	}

	public function testGetUserCredsFetchReturnsAssociativeArray(){

		$array = array(
			'hash'=>'lkhdiyw)(&#$hf987294792374!)(&$@)&$)(#&$',
			'user_id'=> 3
		);

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('fetch')->willReturn($array);

		$this->assertIsArray($pdoStatementMock->fetch());		
	}

	public function testGetUserCredsFetchReturnsEmptyArray(){

		$array = array();

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('fetch')->willReturn($array);

		$this->assertEmpty($pdoStatementMock->fetch());		
	}


	/****************LoginUser******************/


	/****************UserSession******************/

}