<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

	/****************Test of Test!******************/
	public function testIfEmptyArray()
	{
		$user_array = [];

		//check if empty array is empty!
		$this->assertSame(0, count($user_array));
	}

	/****************GetUserName******************/
	/****************SetUserName******************/

	/****************GetFirstName******************/
	/****************SetFirstName******************/

	/****************GetLastName******************/
	/****************SetLastName******************/

	/****************GetFullName******************/
	/****************SetFullName******************/

	/****************Get User******************/

	public function testGetUserPreparePrepareReturnsPDOStatementObject()
	{
		$pdoMock = $this->createMock(PDO::class);
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test Prepare - returns a PDOStatement object
		$pdoMock->expects($this->once())->method('prepare')->willReturn($pdoStatementMock);

		$test = $pdoMock->prepare('SELECT * FROM users WHERE user_id = ?');

		$this->assertIsObject($test);
		$this->assertInstanceOf(PDOStatement::class, $test);
	}

	public function testGetUserBindParamReturnsTrue()
	{
		$user_id = 1;

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		$pdoStatementMock->expects($this->once())->method('bindParam')->willReturn(true);

		$test1 = $pdoStatementMock->bindParam(1, $user_id);

		$this->assertTrue($test1);

		return $test1;
	}

	/**
     * @depends testGetUserBindParamReturnsTrue
     */
	public function testGetUserExecuteReturnsTrue($bool)
	{
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test execute returns true
		$pdoStatementMock->expects($this->once())->method('execute')->willReturn($bool);

		$test = $pdoStatementMock->execute();

		$this->assertTrue($test);
	}

	public function testGetUserRowCountReturnsCountOneRowEffected(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(1);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}

}