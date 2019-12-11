<?php  
use PHPUnit\Framework\TestCase;

class UserProcessTest extends TestCase
{

	private $register_array = array(
		"firstname"=> "First",
		"lastname"=> "Last",
		"username"=> "cool@cool.com",
		"password"=> "1234", 
		"re-password"=> "1234",
		"address"=> ""
	);

	/****************InsertNewUser******************/
	public function testInsertNewUserPrepareReturnsPDOStatementObject()
	{
		$pdoMock = $this->createMock(PDO::class);
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test Prepare - returns a PDOStatement object
		$pdoMock->expects($this->once())->method('prepare')->willReturn($pdoStatementMock);

		$test = $pdoMock->prepare('INSERT INTO users (first_name, last_name, user_name) VALUES (?, ?, ?)');

		$this->assertIsObject($test);
		$this->assertInstanceOf(PDOStatement::class, $test);
	}

	public function testInsertNewUserBindParamReturnsTrue()
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
     * @depends testInsertNewUserBindParamReturnsTrue
     */
	public function testInsertNewUserExecuteReturnsTrue($bool)
	{
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test execute returns true
		$pdoStatementMock->expects($this->once())->method('execute')->willReturn($bool);

		$test = $pdoStatementMock->execute();

		$this->assertTrue($test);
	}

	public function testInsertNewUserRowCountReturnsCountOneRowEffected(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(1);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}

	public function testInsertNewUserRowCountReturnsCountZeroRowsEffected(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(0);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}


	/****************InsertUserCreds******************/
	public function testInsertUserCredsPrepareReturnsPDOStatementObject()
	{
		$pdoMock = $this->createMock(PDO::class);
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test Prepare - returns a PDOStatement object
		$pdoMock->expects($this->once())->method('prepare')->willReturn($pdoStatementMock);

		$test = $pdoMock->prepare('INSERT INTO logins (hash, user_id, user_name) SELECT ?, user_id, user_name FROM users WHERE user_name = ?');

		$this->assertIsObject($test);
		$this->assertInstanceOf(PDOStatement::class, $test);
	}

	public function testInsertUserCredsBindParamReturnsTrue()
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
     * @depends testInsertUserCredsBindParamReturnsTrue
     */
	public function testInsertUserCredsExecuteReturnsTrue($bool)
	{
		$pdoStatementMock = $this->createMock(PDOStatement::class);

		// Test execute returns true
		$pdoStatementMock->expects($this->once())->method('execute')->willReturn($bool);

		$test = $pdoStatementMock->execute();

		$this->assertTrue($test);
	}

	public function testInsertUserCredsRowCountReturnsCountOneRowEffected(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(1);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}

	public function testInsertUserCredsRowCountReturnsCountZeroRowsEffected(){

		$pdoStatementMock = $this->createMock(PDOStatement::class);

		//Test rowCount returns int
 		$pdoStatementMock->expects($this->once())->method('rowCount')->willReturn(0);
		$this->assertIsInt($pdoStatementMock->rowCount());		
	}

	

	/****************Register New User******************/


	// need register array - will sanitize and check through the checkUserFields method
	// need database object/connection

	// run the function with different data sets to check output

	// true, true, true
	// true, true, false
	// true, false
	// false

	// uses checkRegisterFields to create sanitized array for use at start
	// creates hash
	// uses checkUser Status
	// uses SetUser
	// users Set Cred

	//returns bool
	//returns true from setCreds if success
	//returns array from checkUserFields if checkUserFields runs false


	


}